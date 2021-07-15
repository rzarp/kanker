<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientProgress extends Model
{
    protected $fillable = [
        'patient_id', 'description', 'progress'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
