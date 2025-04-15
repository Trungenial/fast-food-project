<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
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
                    ->view('emails.order_placed');
    }
}

