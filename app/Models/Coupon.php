<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupon';

    public $fillable = [
        'coupon_code',
        'coupon_discount',
        'coupon_price',
        'status',
    ];

}
