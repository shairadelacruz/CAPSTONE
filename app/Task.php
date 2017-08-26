<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at', 'deadline'];

    protected $fillable = [
        'deadline', 'name', 'description', 'status', 'user_id', 'client_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function log()
    {
        return $this->belongsToMany('App\Log');
    }

}
