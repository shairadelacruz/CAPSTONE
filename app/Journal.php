<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    //

    use SoftDeletes;

    //For Audit Trail

    use RecordsActivity;

    //protected static $recordEvents = ['created'];

    protected $dates = ['deleted_at', 'date'];

    protected $fillable = [
    	'transaction_no', 'description', 'date', 'client_id', 'debit', 'credit'
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
