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

    public function clients(){

        return $this->belongsToMany('App\Client');
    }
}
