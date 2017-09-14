<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Team extends Model
{
    //
    use SoftDeletes;

    use RecordsActivity;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'team_leader', 'name', 'user_id'
    ];

    public function users(){

        return $this->belongsToMany('App\User');
    }

    public function user(){

        return $this->belongsTo('App\User', 'team_leader');
    }

}
