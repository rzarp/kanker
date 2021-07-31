<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Patient extends Model
{
    protected $fillable = [
        'dokter_id',

        'name',
        'medical_number_record',
        'ktp',
        'gender',
        'birth_place',
        'birth_date',
        'address',

        'length_of_stay',
        'stadium_type',
        'tumor_size',
        'treatment_type',
        'status',
        'icu_indikator',
        'icu_los',
        'vent_hour',

        'probability'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User', 'dokter_id', 'id');
    }

    public function patient_progress()
    {
        return $this->hasMany('App\PatientProgress');
    }

    public static function countByStadiumType()
    {
        return Patient::selectRaw('stadium_type, count(stadium_type) as count')
            ->groupBy('stadium_type')
            ->get();
    }

    public static function countByGender()
    {
        return Patient::selectRaw('gender, count(gender) as count')
            ->groupBy('gender')
            ->get();
    }

    public static function countByTreatmentType()
    {
        return Patient::selectRaw('treatment_type, count(treatment_type) as count')
            ->groupBy('treatment_type')
            ->get();
    }

    public static function countByStatus()
    {
        return Patient::selectRaw('status, count(status) as count')
            ->groupBy('status')
            ->get();
    }

    public static function countByTumorSize($year)
    {
        return Patient::selectRaw('tumor_size, count(tumor_size) as count')
            ->whereRaw("date_format(created_at, '%Y') = {$year}")
            ->groupBy('tumor_size')
            ->get();
    }

    public static function getDataMonthly($year, $month)
    {
        return DB::select(DB::raw(
            "select
                ( select count(stadium_type) from patients where stadium_type = 'Dini' and date_format(created_at, '%Y-%c') = '{$year}-{$month}' ) as stadium_dini,
                ( select count(stadium_type) from patients where stadium_type = 'Lanjut' and date_format(created_at, '%Y-%c') = '{$year}-{$month}' ) as stadium_lanjut,
                ( select count(treatment_type) from patients where treatment_type = 'RADIOTERAPI' and date_format(created_at, '%Y-%c') = '{$year}-{$month}' ) as pengobaatan_radioterapi,
                ( select count(treatment_type) from patients where treatment_type = 'KEMOTERAPI' and date_format(created_at, '%Y-%c') = '{$year}-{$month}' ) as pengobatan_komoterapi,
                ( select count(status) from patients where status = 'HIDUP' and date_format(created_at, '%Y-%c') = '{$year}-{$month}' ) as pasien_hidup,
                ( select count(status) from patients where status = 'MENINGGAL' and date_format(created_at, '%Y-%c') = '{$year}-{$month}' ) as pasien_meninggal,
                ( select count(status) from patients where gender = 'Laki-laki' and date_format(created_at, '%Y-%c') = '{$year}-{$month}' ) as pasien_laki,
                ( select count(status) from patients where gender = 'Perempuan' and date_format(created_at, '%Y-%c') = '{$year}-{$month}' ) as pasien_perempuan,
                ( select count(status) from patients where icu_indikator = 1 and date_format(created_at, '%Y-%c') = '{$year}-{$month}' ) as masuk_ruang_icu,
                ( select count(icu_los) from patients where date_format(created_at, '%Y-%c') = '{$year}-{$month}' and icu_los > 0 and icu_los = 7 ) as 7_hari_icu,
                ( select count(vent_hour) from patients where date_format(created_at, '%Y-%c') = '{$year}-{$month}' and vent_hour > 0 and vent_hour = 24 ) as 24_jam_ventilator
            "
        ))[0];
    }

    public static function monthlyStatus($year)
    {
        $months = array(
            '1' => 'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        );

        $result = [];

        foreach (range(1, 12) as $month) {
            $data = get_object_vars(self::getDataMonthly($year, $month));

            foreach ($data as $key => $value) {
                $explodeName = explode('_', $key);

                $name = '';
                foreach ($explodeName as $keys => $v) {
                    $name .= ' ' . ucfirst($v);
                }

                $result[$key]['name'] = $name;
                $result[$key]['data'][] = $value;
            }
        }

        return [
            'category' => $months,
            'data' => array_values($result)
        ];
    }

    public static function probabilityData($year)
    {
        $data = DB::select(DB::raw(
            "select
                ( select count(stadium_type) from patients where stadium_type = 'Dini' and date_format(created_at, '%Y') = '{$year}' ) as stadium_dini,
                ( select count(stadium_type) from patients where stadium_type = 'Lanjut' and date_format(created_at, '%Y') = '{$year}' ) as stadium_lanjut,
                ( select count(treatment_type) from patients where treatment_type = 'RADIOTERAPI' and date_format(created_at, '%Y') = '{$year}' ) as pengobaatan_radioterapi,
                ( select count(treatment_type) from patients where treatment_type = 'KEMOTERAPI' and date_format(created_at, '%Y') = '{$year}' ) as pengobatan_komoterapi,
                ( select count(status) from patients where status = 'HIDUP' and date_format(created_at, '%Y') = '{$year}' ) as pasien_hidup,
                ( select count(status) from patients where status = 'MENINGGAL' and date_format(created_at, '%Y') = '{$year}' ) as pasien_meninggal,
                ( select count(status) from patients where gender = 'Laki-laki' and date_format(created_at, '%Y') = '{$year}' ) as pasien_laki,
                ( select count(status) from patients where gender = 'Perempuan' and date_format(created_at, '%Y') = '{$year}' ) as pasien_perempuan,
                ( select count(status) from patients where icu_indikator = 1 and date_format(created_at, '%Y') = '{$year}' ) as masuk_ruang_icu,
                ( select count(icu_los) from patients where date_format(created_at, '%Y') = '{$year}' and icu_los > 0 and icu_los = 7 ) as 7_hari_icu,
                ( select count(vent_hour) from patients where date_format(created_at, '%Y') = '{$year}' and vent_hour > 0 and vent_hour = 24 ) as 24_jam_ventilator
            "
        ))[0];

        $result = [];
        foreach (get_object_vars($data) as $key => $value) {
            $explodeName = explode('_', $key);
            $name = '';
            foreach ($explodeName as $keys => $v) {
                $name .= ' ' . ucfirst($v);
            }

            $result[$key]['name'] = $name;
            $result[$key]['y'] = $value;
        }

        return array_values($result);
    }

    public static function averageProbability($year)
    {
        return Patient::selectRaw('(sum(probability) / count(probability)) as probability')
            ->whereRaw("date_format(created_at, '%Y') = {$year}")
            ->first();
    }
}
