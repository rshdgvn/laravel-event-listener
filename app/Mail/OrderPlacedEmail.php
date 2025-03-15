<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacedEmail extends Mailable 
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $order;
     
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('You Have Placed an Order')
                    ->view('emails.order')
                    ->with([
                        'item' => $this->order->item,
                        'name' => $this->order->user->name,
                        'quantity' => $this->order->quantity,
                        'date' => $this->order->created_at,
                    ]);
    }
}
