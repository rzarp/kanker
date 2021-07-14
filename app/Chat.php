<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function from()
    {
        return $this->belongsTo('App\User');
    }

    public function to()
    {
        return $this->belongsTo('App\User');
    }
}
