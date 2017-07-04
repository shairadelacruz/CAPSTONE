<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [

    	'name', 'first_name', 'middle_name', 'last_name', 'email', 'address1', 'address2', 'phone', 'mobile'
    ];

    public function client(){

        return $this->belongsTo('App\Client');
    }
}
