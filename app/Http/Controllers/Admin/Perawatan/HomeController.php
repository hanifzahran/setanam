<?php

namespace App\Http\Controllers\Admin\Perawatan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $order = Order::with('order_details', 'users', 'order_details.products')->where('orders.status_perawatan', '!=', null)->where('orders.status_pembayaran', 3)->get();
        return view('admin.perawatan.index', compact('order',));
    }

    public function detail($id)
    {
        $order = Order::with('users', 'order_details', 'order_details.products', 'histories')->where('orders.status_pembayaran', 3)->where('id', $id)->where('orders.status_pembayaran', 3)->first();
        return view('admin.perawatan.detail', compact('order'));
    }

}
