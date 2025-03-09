<?php

namespace App\Http\Controllers;

use App\Models\Order;
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

        return redirect(route('order.index'));
    }

    public function admin()
    {
        $orders = Order::all();

        return view('admin', compact('orders'));
    }
}
