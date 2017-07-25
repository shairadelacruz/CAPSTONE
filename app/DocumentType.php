<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    //
   public function logs()
    {
        return $this->hasMany('App\Log');
    }
}
