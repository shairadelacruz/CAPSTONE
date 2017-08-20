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

}
