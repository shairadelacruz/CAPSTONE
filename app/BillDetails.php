<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillDetails extends Model
{
    //

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'client_coa_id', 'item_id', 'vat_id', 'vat_amount', 'description', 'qty','price','total'
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
