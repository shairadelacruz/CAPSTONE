<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coa extends Model
{
    //
    use SoftDeletes;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'coacategory_id', 'description', 'amount'
    ];

    public function coacategory(){

        return $this->belongsTo('App\Coacategory');
    }

    public function coaamounts()
    {

        return $this->hasMany('App\Coaamount');
    }

    public function item(){

        return $this->hasMany('App\Item');
    }

    public function bill_details(){

        return $this->hasMany('App\BillDetails');
    }

    public function invoice_details()
    {
        return $this->hasMany(InvoiceDetail::class);
    }

    public function clients(){

        return $this->belongsToMany('App\Client');
    }

    public function journals_details(){

        return $this->hasMany('App\JournalDetails', 'client_coa_id');
    }
}
