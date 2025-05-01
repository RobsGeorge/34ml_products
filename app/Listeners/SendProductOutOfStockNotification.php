<?php

namespace App\Listeners;

use App\Events\ProductOutOfStock;
use App\Notifications\ProductOutOfStockNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendProductOutOfStockNotification implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(ProductOutOfStock $event): void
    {
        // Notify admin
        Notification::route('mail', 'admin@34ml.com')
            ->notify(new ProductOutOfStockNotification($event->product));
    }
}