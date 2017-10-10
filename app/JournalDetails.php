<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JournalDetails extends Model
{
    //

    protected $fillable = [
    	'reference_no', 'descriptions', 'debit', 'credit', 'vat_amount', 'vat_id', 'coa_id', 'vendor_id','customer_id', 'journal_id'
    ];

    public function journal(){

        return $this->belongsTo(Journal::class);
    }

    public function getTotalPriceAttribute() {

    	return $this->quantity * $this->price;
	}

    public function coa()
    {
        return $this->belongsTo(Coa::class);
    }

    public function vat()
    {
        return $this->belongsTo(Vat::class);
    }

    public function log()
    {
        return $this->belongsTo('App\Log', 'reference_no');
    }

}
