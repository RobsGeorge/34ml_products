<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    
    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Variant::class);
    }

    public function defaultVariant(): BelongsTo
    {
        return $this->belongsTo(Variant::class, 'default_variant_id');
    }
}
