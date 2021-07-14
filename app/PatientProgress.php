<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientProgress extends Model
{
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
