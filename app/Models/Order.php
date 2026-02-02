<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'order_number',
        'customer_id',
        'user_id',
        'order_date',
        'status_order',
        'payment_status',
        'total_price',
        'paid_amount',
    ];
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
    public function order_item(){
        return $this->hasMany(OrderItem::class);
    }
    public function payment(){
        return $this->hasMany(Payment::class);
    }
    public function receivable(){
        return $this->hasMany(Receivable::class);
    }
    
}
