<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'order_detail';

    public $fillable = [
        'order_id',
        'product_id',
        'product_att_id',
        'sku',
        'product_name',
        'product_img',
        'price',
        'size',
        'qty',
        'color',
    ];
}
