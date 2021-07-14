<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User');
    }

    public function patient_progress()
    {
        return $this->hasMany('App\PatientProgress');
    }
}
