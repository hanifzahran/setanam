<?php

namespace App\Http\Controllers\Admin\Beranda;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function dataTransaksi(){
        return $transaksi = Order::orderBy('updated_at', 'DESC')->get();
    }

    public function dataCustomer(){
        return User::select('*')->where('role', 0)->get();
    }

    public function detailTransaksi()
    {
        $now = Carbon::now();
        $bulan = $now->monthName . " " . $now->year;
        $pemasukan = Order::where('status_pembayaran', 3)->whereMonth('created_at', $now->month)->sum('total');
        $pending = Order::where('status_pembayaran', '!=', 3)->whereMonth('created_at', $now->month)->sum('total');
        $totalUser = User::select('*')->where('role', 0)->whereMonth('created_at', $now->month)->count();

        return view('admin.beranda.data_transaksi', compact(
            'bulan',
            'pemasukan',
            'pending',
            'totalUser',
        ));
    }
}
