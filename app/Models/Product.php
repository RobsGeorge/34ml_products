<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'is_in_stock',
        'average_rating',
        'default_variant_id'
    ];
    protected $casts = [
        'is_in_stock' => 'boolean',
        'average_rating' => 'double',
    ];
    
}
