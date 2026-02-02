<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductMaterial extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'product_id',
        'material_id',
        'quantity_needed',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function material(){
        return $this->belongsTo(Material::class);
    }
}
