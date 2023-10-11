<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

class ProductImage extends Model
{
    use HasFactory;

    protected $table = 'products_image';

    protected $fillable = [
        'product_id',
        'product_attr_id',
        'image',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function productAttr()
    {
        return $this->belongsTo(ProductAttr::class, 'product_attr_id', 'id');
    }

    public function getImageAttribute($value)
    {
        // return URL::to('/images/product/' . $value);
        return asset('/images/product/' . $value);
    }
}
