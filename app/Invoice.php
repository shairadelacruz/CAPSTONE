<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    //
    use SoftDeletes;

    use RecordsActivity;

    protected $dates = ['deleted_at', 'invoice_date', 'due_date'];


    protected $fillable = [
        'reference_no', 'invoice_date', 'due_date', 'client_id', 'customer_id', 'balance', 'amount'
    ];

    public function logs()
    {
        return $this->belongsTo('App\Log');
    }

    public function client(){

        return $this->belongsTo('App\Client');
    }

    public function customer(){

        return $this->belongsTo('App\Customer');
    }

    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function journal(){

        return $this->hasMany(Journal::class);
    }
}
