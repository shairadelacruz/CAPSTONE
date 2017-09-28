<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{

    use SoftDeletes;

    use RecordsActivity;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){

        return $this->belongsToMany(Role::class);
    }

    public function assignRole(/*Role*/ $role){

        return $this->roles()->save(

            Role::whereName($role)->firstOrFail()
        );
    }

    public function hasRole($role){

        if(is_string($role)){

            return $this->roles->contains('name', $role);
        }

        return $role->intersect($this->roles)->count();
    }

    public function isAdmin(){

        if($this->roles->first()->name == "administrator" && $this->is_active == 1){

            return true;
        }

        return false;
    }

    public function isManager(){

        if($this->roles->first()->name == "manager" && $this->is_active == 1){

            return true;
        }

        return false;
    }

    public function isUser(){

        if($this->roles->first()->name == "user" && $this->is_active == 1){

            return true;
        }

        return false;
    }

    public function isAssigned($id){

        if($this->clients->find($id)){

            return true;
        }

        return false;
    }

    public function isTeamMember($id){

        if($this->teams->find($id)){

            return true;
        }

        return false;
    }


    public function clients(){

        return $this->belongsToMany('App\Client');
    }

    public function assignClient(/*Role*/ $client){

        return $this->clients()->save(

            Client::whereName($client)->firstOrFail()
        );
    }

    public function teams()
    {
        return $this->belongsToMany('App\Team');
    }

    public function team()
    {
        return $this->hasMany('App\Team','team_leader');
    }

    public function logs(){

        return $this->hasMany('App\Log');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function activities(){

        return $this->hasMany('App\Activity');
    }
}
