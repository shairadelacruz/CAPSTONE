<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    //
    use SoftDeletes;

    use RecordsActivity;

    protected $dates = ['deleted_at'];

    protected $fillable = [

    	'name', 'first_name', 'middle_name', 'last_name', 'email', 'address', 'phone', 'mobile', 'client_id'
    ];

    public function client(){

        return $this->belongsTo('App\Client');
    }

    public function bills(){

        return $this->hasMany('App\Bill');
    }

    public function journal(){

        return $this->hasMany('App\Journal');
    }

}
