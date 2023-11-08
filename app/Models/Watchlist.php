<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlist extends Model
{
    use HasFactory;

    protected $table = "watch_list";

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productAtt()
    {
        return $this->belongsTo(ProductAttr::class, 'pro_att_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
