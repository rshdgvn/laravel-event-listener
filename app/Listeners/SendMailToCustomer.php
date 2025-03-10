<?php

namespace App\Listeners;

use App\Events\OrderPLaced;
use App\Mail\OrderPLaced as MailOrderPLaced;
use App\Mail\OrderPlacedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailToCustomer
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPLaced $event): void
    {
        $order = $event->order;

        Mail::to($order->user->email)->send(new OrderPlacedEmail($order));
    }
}
