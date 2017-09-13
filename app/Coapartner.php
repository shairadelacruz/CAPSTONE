<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coapartner extends Model
{
    //
    protected $table = 'coas';

    public function client(){

        return $this->belongsTo('App\Client');
    }

    public function coa(){

    	return $this->belongsToMany('App\Coa', 'coapartners', 'partnercoa_id', 'coa_id');
	}
}
