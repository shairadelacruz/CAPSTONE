<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    //

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [

    	'company_name', 'legal_name', 'address', 'financial_year', 'contact_name', 'email', 'phone', 'mobile'

    ];


    public function isAdmin(){

        if($this->role->name == "administrator" && $this->is_active == 1){

            return true;
        }

        return false;
    }

    public function users(){

        return $this->belongsToMany('App\User');
    }

    public function assignAdmin(/*$user*/){


        return $this->users()->save(

            //User::where($user)->firstOrFail()
            User::findOrFail(1)

        );
    }

    public function assignUser($user){

        return $this->users()->save(

            User::whereName($user)->firstOrFail()
        );
    }

    public function coaamounts()
    {

        return $this->hasMany('App\Coaamount');
    }

    public function coas()
    {

        return $this->belongsToMany('App\Coa');
    }


    public function log()
    {
        return $this->hasMany('App\Log');
    }

    public function task()
    {
        return $this->hasMany('App\Task');
    }

    public function business(){

        return $this->belongsTo('App\Business');
    }

    public function journal(){

        return $this->hasMany('App\Journal');
    }

    public function vendor(){

        return $this->hasMany('App\Vendor');
    }
    public function customer()
    {
        return $this->hasMany('App\Customer');
    }

    public function item(){

        return $this->hasMany('App\Item');
    }

    public function invoice()
    {
        return $this->hasMany('App\Invoice');
    }

    public function bill()
    {
        return $this->hasMany('App\Bill');
    }
}
