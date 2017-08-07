<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [

    	'name', 'price', 'description', 'coa_id', 'vat_id', 'client_id'
    ];

    public function client(){

        return $this->belongsTo('App\Client');
    }

    public function coa(){

        return $this->belongsTo('App\Coa');
    }

    public function invoiceInfo()
    {
        return $this->hasMany('App\Invoice_Info');
    }

    public function billInfo()
    {
        return $this->hasMany('App\Bill_Info');
    }
}
