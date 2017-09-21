<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Closing extends Model
{
    //

    use RecordsActivity;

    protected $fillable = [

    	'client_id', 'status'
    ];

    public function client(){

        return $this->belongsTo('App\Client');
    }
}
