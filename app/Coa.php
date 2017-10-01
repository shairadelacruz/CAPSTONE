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

    //GET DEBIT PARTNER

    public function debitPartner($client_id){

        if($this->coapartner->contains('client_id', $client_id)){
            
            if($this->coapartner->contains('type', 0)){
                $coapartnerid = $this->coapartner->where('type',0)->first()->id;
                $partner = Coapartner::find($coapartnerid);
                return $partner->coas->name;
            }
            
        }
        return false;
    }

        //GET CREDIT PARTNER

    public function creditPartner($client_id){
            
        if($this->coapartner->contains('client_id', $client_id)){
            
            if($this->coapartner->contains('type', 1)){
                $coapartnerid = $this->coapartner->where('type',1)->first()->id;
                $partner = Coapartner::find($coapartnerid);
                return $partner->coas->name;
            }
            
        }
        return false;
    }

        public function debitPartnerId($client_id){

        if($this->coapartner->contains('client_id', $client_id)){
            
            if($this->coapartner->contains('type', 0)){
                $coapartnerid = $this->coapartner->where('type',0)->first()->id;
                $partner = Coapartner::find($coapartnerid);
                return $partner->coas->id;
            }
            
        }
        return false;
    }

        //GET CREDIT PARTNER

    public function creditPartnerId($client_id){
            
        if($this->coapartner->contains('client_id', $client_id)){
            
            if($this->coapartner->contains('type', 1)){
                $coapartnerid = $this->coapartner->where('type',1)->first()->id;
                $partner = Coapartner::find($coapartnerid);
                return $partner->coas->id;
            }
            
        }
        return false;
    }


    public function coacategory(){

        return $this->belongsTo('App\Coacategory');
    }

    /*public function coapartner(){
        
        return $this->belongsToMany('App\Coapartner', 'coapartners','coa_id', 'partnercoa_id');
    }*/
    public function coapartner(){

        return $this->hasMany('App\Coapartner', 'coa_id');
    }

    public function coapartners(){

        return $this->hasMany('App\Coapartner', 'partnercoa_id');
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
