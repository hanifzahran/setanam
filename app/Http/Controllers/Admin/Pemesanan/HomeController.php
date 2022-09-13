<?php

namespace App\Http\Controllers\Admin\Pemesanan;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $menunggu = Order::with('users', 'order_details' , 'order_details.products')->where('orders.status_pembayaran', 3) ->where('orders.status_pengiriman', '!=', 2)->count();

        return view('admin.pemesanan.index', compact('menunggu'));
    }

    public function dataPesanan()
    {
        $order = Order::with('users', 'order_details' , 'order_details.products')->get();
        return $order;
    }

    public function pengiriman(){
        $user = Auth::user();
        $order = Order::with('users', 'order_details' , 'order_details.products')->where('orders.status_pembayaran', 3)->get();
        return view('admin.pemesanan.daftar_pengiriman', compact('order', 'user'));
    }

    public function konfirmasi(Order $order){
        $order->update([
            'status_pengiriman' => 1
        ]);
        return back();
    }
}
