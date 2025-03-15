<?php

namespace App\Http\Controllers;

use App\Events\OrderPLaced;
use App\Models\Log;
use App\Models\Order;
use App\Notifications\OrderAction;
use App\Notifications\OrderNotification;
use App\Notifications\SendNotificationToUser;
use App\Notifications\SendWelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $id = Auth::id();

        $orders = Order::where('user_id', $id)->get();

        return view('customer', compact('orders'));
    }


    public function create()
    {
        return view('create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'item' => ['required', 'string'],
            'quantity' => ['required', 'integer']
        ]);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->item = $validated['item'];
        $order->quantity = $validated['quantity'];
        $order->save();

        $user = $order->user;

        $user->notify(new OrderAction('You have placed an order Item:' . $order->item . ' Quantity: ' . $order->quantity));

        return redirect(route('customer.index'));
    }

    public function edit(Order $order)
    {
        return view('edit', ['order' => $order]);
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'item' => ['required', 'string'],
            'quantity' => ['required', 'integer']
        ]);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->item = $validated['item'];
        $order->quantity = $validated['quantity'];
        $order->update();

        $order->user->notify(new OrderAction('You have edited an order Item:' . $order->item . ' Quantity: ' . $order->quantity));

        return redirect(route('customer.index'));
    }

    public function destroy(Order $order)
    {
        $order->delete();

        $user = Auth::user();

        $user->notify(new OrderAction('WALA KA NG ' . $order->item . ' !!!!'));

        return redirect(route('customer.index'));
    }
}
