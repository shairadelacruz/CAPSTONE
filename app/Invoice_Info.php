<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice_Info extends Model
{
    //
   	public function invoice()
    {
        return $this->belongsTo('App\Invoice');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }

    public function vat()
    {
        return $this->belongsTo('App\Vat');
    }

    /*public function clientCoa()
    {
        return $this->belongsTo('App\Coa');
    }*/
}
