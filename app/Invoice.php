<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'invoice_no', 'invoice_date', 'due_date', 'title', 'client_id', 'customer_id', 'sub_total', 'grand_total'
    ];

    public function logs()
    {
        return $this->belongsTo('App\Log');
    }

    public function clients()
    {
        return $this->belongsTo('App\Client');
    }

    public function customers()
    {
        return $this->belongsTo('App\Customer');
    }

    public function products()
    {
        return $this->hasMany(InvoiceDetail::class);
    }
}
