<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coa extends Model
{
    //
    use SoftDeletes;

    use RecordsActivity;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'coacategory_id', 'description', 'is_generic'
    ];

    public function coacategory(){

        return $this->belongsTo('App\Coacategory');
    }

    public function coapartner(){
        
        return $this->belongsToMany('App\Coapartner', 'coapartners','coa_id', 'partnercoa_id');
    }

    public function item(){

        return $this->hasMany('App\Item');
    }
    
    public function journals_details(){

        return $this->hasMany(JournalDetails::class);
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


}
