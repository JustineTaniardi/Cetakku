<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'order_id',
        'invoice_number',
        'file_path',
    ];
    
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
