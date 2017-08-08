<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Team extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user(){

        return $this->hasMany('App\User');
    }

    public function user(){

        return $this->belongsTo('App\User');
    }

}
