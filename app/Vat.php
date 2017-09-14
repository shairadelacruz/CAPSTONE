<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vat extends Model
{
    //
	use SoftDeletes;

    use RecordsActivity;

	protected $dates = ['deleted_at'];

    protected $fillable = [

    	'vat_code', 'rate', 'description'

    ];

    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function bill_details(){

        return $this->hasMany('App\BillDetails');
    }

    public function journals_details(){

        return $this->hasMany(JournalDetails::class);
    }

}
