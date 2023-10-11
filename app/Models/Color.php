<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
    use HasFactory;

    protected $table = 'color';

    public $fillable = [
        'color',
        'color_name',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function colorName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
        );
    }
}
