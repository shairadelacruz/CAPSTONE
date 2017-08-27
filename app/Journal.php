<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model
{
    //

    use SoftDeletes;

    protected $dates = ['deleted_at', 'date'];

    protected $fillable = [
    	'transaction_no', 'description', 'date', 'client_id'
    ];


    public function journal_details(){

        return $this->hasMany(JournalDetails::class);
    }

    public function client(){

        return $this->belongsTo(Client::class);
    }


}
