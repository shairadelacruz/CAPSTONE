<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coacategory extends Model
{
    //
    public function coas()
    {
        return $this->hasMany('App\Coa');
    }
}
