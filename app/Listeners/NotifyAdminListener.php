<?php

namespace App\Listeners;

use App\Events\OrderPLaced;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Session;

class NotifyAdminListener
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
  
        $name = $order->user->name;
        $item = $order->item;
        $date = $order->created_at->format('F j, Y, g:i a');

        Log::create([
            'message' => "$name placed an order on $date, Item: $item",
        ]);
    }
}