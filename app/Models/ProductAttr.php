<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttr extends Model
{
    use HasFactory;

    protected $table = 'products_attr';

    protected $fillable = [
        'product_id',
        'sku',
        'image',
        'color_id',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productAttrImg()
    {
        return $this->hasMany(ProductImage::class, 'product_attr_id', 'id');
    }

    public function productAttrMultiSize()
    {
        return $this->hasMany(ProductAttrMultiSize::class, 'product_attr_id', 'id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('/images/product/' . $value);
        }
        return NULL;
    }
}
