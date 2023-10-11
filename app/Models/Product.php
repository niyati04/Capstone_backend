<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'casual_wear',
        'design_by',
        'description',
        'is_tranding',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function productAttr()
    {
        return $this->hasMany(ProductAttr::class, 'product_id');
    }

    // public function getCategoryIdAttribute($value)
    // {
    //     $category = Category::where('id', $value)->first();
    //     return $category;
    // }
}
