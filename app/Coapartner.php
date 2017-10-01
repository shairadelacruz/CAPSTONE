<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coapartner extends Model
{
    //
    protected $fillable = [
        'client_id', 'coa_id', 'partnercoa_id', 'type'
    ];

    public function client(){

        return $this->belongsTo('App\Client');
    }

    public function coa(){

    	return $this->belongsTo('App\Coa', 'coa_id');
	}

    public function coas(){

    	return $this->belongsTo('App\Coa', 'partnercoa_id');
	}
}
