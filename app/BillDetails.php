<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BillDetails extends Model
{
    //

    protected $fillable = [
        'bill_id','coa_id', 'item_id', 'vat_id', 'vat_amount', 'descriptions', 'qty','price','total'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
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
