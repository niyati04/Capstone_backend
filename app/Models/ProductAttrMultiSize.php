<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttrMultiSize extends Model
{
    use HasFactory;

    protected $table = 'product_attr_multi_size';

    protected $fillable = [
        'product_id',
        'product_attr_id',
        'qty',
        'size',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
