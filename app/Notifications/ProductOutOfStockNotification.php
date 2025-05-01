<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProductOutOfStockNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Product Out of Stock: ' . $this->product->title)
            ->line('The product "' . $this->product->title . '" is now out of stock.')
            ->line('Product ID: ' . $this->product->id)
            ->action('View Product', url('/admin/products/' . $this->product->id))
            ->line('Thanks');
    }
}