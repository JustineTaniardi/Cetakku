<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'category_id',
        'unit_id',
        'price',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function order_item(){
        return $this->hasMany(OrderItem::class);
    }
    public function product_material(){
        return $this->hasMany(ProductMaterial::class);
    }
    
}
