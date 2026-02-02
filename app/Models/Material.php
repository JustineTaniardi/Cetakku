<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'unit_id',
        'qty',
    ];
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function product_material(){
        return $this->hasMany(ProductMaterial::class);
    }
    public function supplier_material(){
        return $this->hasMany(SupplierMaterial::class);
    }
}
