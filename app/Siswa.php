<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
