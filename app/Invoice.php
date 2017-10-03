<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //

    use RecordsActivity;

    protected $dates = ['invoice_date', 'due_date'];


    protected $fillable = [
        'reference_no', 'invoice_date', 'due_date', 'client_id', 'customer_id', 'balance', 'amount', 'transaction_no'
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
