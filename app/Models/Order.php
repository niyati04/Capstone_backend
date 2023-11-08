<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    public $fillable = [
        'user_id',
        'email',
        'mobile',
        'first_name',
        'last_name',
        'address',
        'country',
        'state',
        'city',
        'zip',
        'coupon_code',
        'coupon_value',
        'total_amount',
        'currency',
        'order_status',
        'payment_status',
        'receipt_id',
        'razorpay_payment_id',
        'razorpay_order_id',
        'razorpay_signature',
    ];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
