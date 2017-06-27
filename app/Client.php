<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $fillable = [

    	'company_name', 'legal_name', 'address', 'financial_year'

    ];


    public function isAdmin(){

        if($this->role->name == "administrator" && $this->is_active == 1){

            return true;
        }

        return false;
    }
}
