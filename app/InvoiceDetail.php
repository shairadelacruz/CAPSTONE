<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    //
    protected $fillable = [
        'client_coa_id', 'item_id', 'vat_id', 'vat_amount', 'description', 'qty','price','total'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
