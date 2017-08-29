<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetail extends Model
{
    //

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'coa_id', 'item_id', 'vat_id', 'vat_amount', 'description', 'qty','price','total', 'invoice_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
