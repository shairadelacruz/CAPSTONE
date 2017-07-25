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

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function clients()
    {
        return $this->belongsTo('App\Client');
    }

    public function documentTypes()
    {
        return $this->belongsTo('App\DocumentType');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function journal_infos()
    {
        return $this->hasMany('App\Journal_Info');
    }

    public function bills()
    {
        return $this->hasMany('App\Bill');
    }

    public function invoices()
    {
        return $this->hasMany('App\Invoice');
    }
}
