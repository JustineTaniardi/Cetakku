<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debt extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'supplier_id',
        'amount',
        'due_date',
        'status'
    ];
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
}

