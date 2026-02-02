<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierMaterial extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'supplier_id',
        'material_id',
        'buy_price',
    ];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function material(){
        return $this->belongsTo(Material::class);
    }
}
