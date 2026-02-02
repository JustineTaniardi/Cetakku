<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'order_item_id',
        'status',
        'note',
    ];
    public function order_item(){
        return $this->belongsTo(OrderItem::class);
    }
}
