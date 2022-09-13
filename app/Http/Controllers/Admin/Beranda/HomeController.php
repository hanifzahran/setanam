<?php

namespace App\Http\Controllers\Admin\Beranda;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $bulan = $now->monthName . " " . $now->year;
        $totalUser = User::select('*')->where('role', 0)->whereMonth('created_at', $now->month)->count();
        $totalTransaksi = Order::select('*')->whereMonth('created_at', $now->month)->count();
        $product = Product::all();
        $pemasukan = Order::sum('total');
        return view('admin.beranda.index', compact('bulan', 'totalUser', 'product', 'totalTransaksi', 'pemasukan'));
    }
}
