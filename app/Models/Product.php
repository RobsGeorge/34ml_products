<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Events\ProductOutOfStock;

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

    // A Method to set the default variant (lowest price)
    public function setDefaultVariant(): void
    {
        $cheapestVariant = $this->variants()
            ->orderBy('price')
            ->first();

        if ($cheapestVariant) {
            $this->default_variant_id = $cheapestVariant->id;
            $this->save();
        }
    }

    // A Method to check and update the product's stock status
    public function updateStockStatus(): void
    {
        $hasInStockVariants = $this->variants()->where('is_in_stock', true)->exists();
        
        if ($this->is_in_stock && !$hasInStockVariants) {
            $this->is_in_stock = false;
            $this->save();
            
            // Fire the ProductOutOfStock event
            event(new ProductOutOfStock($this));
        }
    }
}
