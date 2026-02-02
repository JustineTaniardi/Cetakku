<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receivable extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'order_id',
        'customer_id',
        'amount',
        'due_date',
        'status',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
