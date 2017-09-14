<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentType extends Model
{
    //

	use SoftDeletes;

    use RecordsActivity;

	protected $dates = ['deleted_at'];

    protected $fillable = [
        'name'
    ];


   public function logs()
    {
        return $this->hasMany('App\Log');
    }
}
