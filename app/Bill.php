<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Bill extends Model
{
    //

    use RecordsActivity;

    protected $dates = ['bill_date', 'due_date'];

    protected $fillable = [
        'reference_no', 'bill_date', 'due_date', 'client_id', 'vendor_id', 'balance', 'amount', 'transaction_no'
    ];

    public function logs()
    {
        return $this->belongsTo('App\Log');
    }

    public function clients()
    {
        return $this->belongsTo('App\Client');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function bill_detail()
    {
        return $this->hasMany(BillDetails::class);
    }

    public function journal(){

        return $this->hasOne(Journal::class);
    }
}
