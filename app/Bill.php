<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at', 'bill_date', 'due_date'];

    protected $fillable = [
        'reference_no', 'bill_date', 'due_date', 'client_id', 'vendor_id', 'balance', 'amount'
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
}
