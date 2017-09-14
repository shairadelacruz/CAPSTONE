<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //

	protected $dates = ['created_at'];

    protected $fillable = [
    	'subject_id', 'subject_type', 'name', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subject()
    {
    	return $this->morphTo();
    }


}
