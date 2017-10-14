<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    //


    //For Audit Trail

    use RecordsActivity;

    //protected static $recordEvents = ['created'];

    protected $dates = ['date'];

    protected $fillable = [
    	'transaction_no', 'description', 'date', 'client_id', 'bill_id', 'invoice_id', 'debit_total', 'credit_total', 'type'
    ];

    public function journal_details(){

        return $this->hasMany(JournalDetails::class);
    }

    public function client(){

        return $this->belongsTo(Client::class);
    }

    public function invoice(){

        return $this->belongsTo(Invoice::class);
    }

    public function bill(){

        return $this->belongsTo(Bill::class);
    }


}
