<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'title', 
        'option1', 
        'option2', 
        'price', 
        'stock', 
        'is_in_stock'
    ];

    protected $casts = [
        'price' => 'double',
        'stock' => 'integer',
        'is_in_stock' => 'boolean',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
