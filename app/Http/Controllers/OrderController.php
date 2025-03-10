<?php

namespace App\Http\Controllers;

use App\Events\OrderPLaced;
use App\Models\Log;
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

        event(new OrderPLaced($order));

        return redirect(route('customer.index'));
    }


    public function admin()
    {
        $logs = Log::latest()->get();

        return view('admin', compact('logs'));
    }


    public function view()
    {
        $orders = Order::with('user')->get();

        return view('view', compact('orders'));
    }


    public function dashboard()
    {
        if (Auth::user()->role == 'admin')
        {
            return redirect(route('admin'));
        }
        else if (Auth::user()-> role == 'customer')
        {
            return redirect(route('customer.index'));
        }
    }
}
