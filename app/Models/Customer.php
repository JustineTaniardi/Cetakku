<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "name",
        "phone_number",
        "address",
    ];  

    public function order(){
        return $this->hasMany(Order::class);
    }
    
    public function receivable(){
        return $this->hasMany(Receivable::class);
    }
}
