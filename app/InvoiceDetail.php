<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    //
    
    protected $fillable = [
        'coa_id', 'item_id', 'vat_id', 'vat_amount', 'descriptions', 'qty','price','total', 'invoice_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function coa()
    {
        return $this->belongsTo(Coa::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function vat()
    {
        return $this->belongsTo(Vat::class);
    }

}
