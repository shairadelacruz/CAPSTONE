<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coaamount extends Model
{
    //
	use SoftDeletes;

	//protected $dates = ['deleted_at'];

    protected $fillable = [
        'client_id', 'coa_id', 'amount'
    ];

    public function clients()
    {
        return $this->belongsTo('App\Client');
    }
    public function coas()
    {
        return $this->belongsTo('App\Coa');
    }
}
