<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vat extends Model
{
    //
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [

    	'vat_code', 'rate', 'description'

    ];

    public function invoice_details(){

        return $this->hasMany('App\InvoiceDetails');
    }

    public function bill_details(){

        return $this->hasMany('App\BillDetails');
    }

}
