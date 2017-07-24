<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
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

    public function Log()
    {
        return $this->belongsTo('App\Log');
    }

}
