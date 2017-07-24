<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    //
use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        
    ];

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Client()
    {
        return $this->belongsTo('App\Client');
    }

    public function Task()
    {
        return $this->hasMany('App\Task');
    }

    public function Journal_Info()
    {
        return $this->hasMany('App\Journal_Info');
    }

    public function Bill()
    {
        return $this->hasMany('App\Bill');
    }

    public function Invoice()
    {
        return $this->hasMany('App\Invoice');
    }
}
