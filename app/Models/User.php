<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
    ];

    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function order(){
        return $this->hasMany(Order::class);
    }

}
