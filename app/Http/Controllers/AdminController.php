<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
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

    public function notifications()
    {
        $notifications = Auth::user()->notifications;

        return view('notifications', compact('notifications'));
    }
}
