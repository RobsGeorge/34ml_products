<?php

namespace App\Observers;

use App\Models\Variant;

class VariantObserver
{
    /**
     * Handle the Variant "created" event.
     */
    public function created(Variant $variant): void
    {
        //
    }

    /**
     * Handle the Variant "updated" event.
     */
    public function updated(Variant $variant): void
    {
        //
    }

    /**
     * Handle the Variant "deleted" event.
     */
    public function deleted(Variant $variant): void
    {
        //
    }

    /**
     * Handle the Variant "restored" event.
     */
    public function restored(Variant $variant): void
    {
        //
    }

    /**
     * Handle the Variant "force deleted" event.
     */
    public function forceDeleted(Variant $variant): void
    {
        //
    }

    public function saved(Variant $variant): void
    {
        // First we update variant's "is_in_stock" based on stock value
        if ($variant->stock <= 0 && $variant->is_in_stock) {
            $variant->is_in_stock = false;
            $variant->saveQuietly();
        }

        // Then, we update the parent product's stock status
        $variant->product->updateStockStatus();
    }
}
