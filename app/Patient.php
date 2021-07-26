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

    public static function countByTumorSize()
    {
        return Patient::selectRaw('tumor_size, count(tumor_size) as count')
            ->groupBy('tumor_size')
            ->get();
    }

    public static function monthlyStatus($year)
    {
        $data = DB::select(DB::raw(
            "
            select
                DATE_FORMAT(created_at, '%M') as month,
                status,
                count(status) as count
            from
                patients
            where
                date_format(created_at, '%Y') = '{$year}'
            group by
                month, status
            "
        ));

        $temp = [];
        foreach ($data as $key => $value) {
            $temp[$value->month][$value->status] = $value->count;
        }

        $months = array(
            'January',
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
        $default = [
            'MENINGGAL' => 0,
            'HIDUP' => 0
        ];

        foreach ($months as $key => $value) {
            $result[$value] = $temp[$value] ?? $default;
        }

        return [
            'category' => $months,
            'data' => array_values($result)
        ];
    }
}
