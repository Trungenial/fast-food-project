<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMailNoLogin extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $items;

    
    public function __construct($order, $items)
    {
        $this->order = $order;
        $this->items = $items;
    }

    public function build()
    {
        return $this->subject('Xác nhận đơn hàng #' . $this->order->id)
                    ->view('emails.order_placed_no_login'); 
    }
}