<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function materials()
    {
        return $this->hasMany('App\Material');
    }
}
