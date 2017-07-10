<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal_Info extends Model
{
    //

    public function Journal(){

        return $this->belongsToMany('App\Journal');
    }

    public function Vat()
    {
        return $this->hasOne('App\Vat');
    }

    public function Vendor()
    {
        return $this->hasOne('App\Vendor');
    }

    public function Customer()
    {
        return $this->hasOne('App\Customer');
    }
}
