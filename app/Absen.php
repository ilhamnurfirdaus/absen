<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absen extends Model
{
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
