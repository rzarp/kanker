<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'user_id',
        'dokter_id',
        'medical_number_record',
        'ktp',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'symptoms',
        'disease',
        'stadium',

        'date_in',
        'date_out'
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
