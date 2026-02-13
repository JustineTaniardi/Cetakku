<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'abbreviation',
        'value',
    ];

    public function material(){
        return $this->hasMany(Material::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }
}
