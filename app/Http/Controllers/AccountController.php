<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $profile = Auth::user();

        return view('customer.akun.pengaturan_akun', compact('profile'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function pemesanan()
    {
        $order = Order::with('order_details', 'order_details.products')->where('user_id', Auth::user()->id)->get();
        return view('customer.akun.pemesanan', compact('order'));
    }

    public function detailPemesanan($id)
    {
        $hari = 0;
        $order = Order::with('histories', 'order_details', 'order_details.products')->where('id', $id)->first();
        $hitung = count($order->histories);
        $checkKonfirmasi = History::where('order_id', $id)->get();
        $val = 0;
        foreach ($order->order_details as $detail) {
            if ($detail->durasi_sewa > 0) {
                $val = $detail->durasi_sewa;
            }
        }
        if ($val > 0) {
            $data_lama = Carbon::make($order->created_at);
            $data_lama_lagi = $data_lama->addDays($val);
            $data_sekarang = Carbon::now();
            $banding = $data_lama_lagi->diff($data_sekarang)->days;
            if($banding == 0){
                $order->update([
                    'status_peminjaman' => 2
                ]);
            }
        }

        return view('customer.product.progress_pemesanan', compact('order', 'hitung', 'checkKonfirmasi'));
    }

    public function konfirmasi($id, $od, $ed)
    {
        return view('customer.product.konfirmasi_perawatan', compact('id', 'od', 'ed'));
    }

    public function konfirmasiLagi(Request $request)
    {
        if ($request->id == $request->od) {
            $order = Order::find($request->ed);
            $order->update([
                'status_perawatan' => 2
            ]);
        }

        $histori = History::find($request->id);
        $histori->update([
            'status' => 1,
            'catatan' => $request->catatan
        ]);

        return redirect('/product/progress-pemesanan/' . $request->ed);
    }


    public function terimaBarang($id)
    {
        $order = Order::find($id);
        $order->update([
            'status_pengiriman' => 2
        ]);
        return back();
    }

    public function pengembalianTanaman($id)
    {
        $order = Order::find($id);
        return view('customer.product.data_pengembalian', compact('order'));
    }
}
