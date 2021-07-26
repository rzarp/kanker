<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
