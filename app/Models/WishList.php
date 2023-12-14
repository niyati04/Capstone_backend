<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
    use HasFactory;

    protected $table = "wishlist";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productAtt()
    {
        return $this->belongsTo(ProductAttr::class, 'product_attr_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
