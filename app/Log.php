<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    //
    use SoftDeletes;

    use RecordsActivity;

    protected $dates = ['deleted_at', 'date_received'];

    protected $fillable = [
        'reference_no', 'date_received', 'received_from', 'document_path', 'user_id', 'client_id', 'document_type_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function document_type()
    {
        return $this->belongsTo('App\DocumentType');
    }

    public function task()
    {
        return $this->belongsToMany('App\Task');
    }

    public function journal_details(){

        return $this->hasMany('App\JournalDetails');
    }

    public function bill()
    {
        return $this->hasMany('App\Bill');
    }

    public function invoice()
    {
        return $this->hasMany('App\Invoice');
    }
}
