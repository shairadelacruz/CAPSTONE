<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //
    use SoftDeletes;

    use RecordsActivity;

    protected $dates = ['deleted_at'];

    protected $fillable = [

    	'name', 'first_name', 'middle_name', 'last_name', 'email', 'address1', 'address2', 'phone', 'mobile', 'client_id'
    ];

    public function client(){

        return $this->belongsTo('App\Client');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}
