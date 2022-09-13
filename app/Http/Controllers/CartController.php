<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\History;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $carts = Cart::with('product')->get();
        return view('customer.product.keranjang', compact('carts'));
    }

    public function store(Request $request)
    {
        Cart::create($request->all());
    }

    public function bayar(Request $request)
    {
        $user = Auth::user();
        $data = array();
        for ($i = 0; $i < count($request->product_id); $i++) {
            $data[] = [
                'id' => $i + 1,
                'price' => $request->harga[$i],
                'quantity' => $request->jumlah[$i],
                'name' => $request->nama[$i]
            ];
        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env("MIDTRANS_SERVER_KEY");
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->total_semua,
            ),
            'item_details' => $data,
            'customer_details' => array(
                'first_name' => $user->fullname,
                'last_name' => '',
                'email' => $user->email,
                'phone' => '',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $semua = $request->total_semua;
        return view('customer.product.pembayaran', compact('snapToken', 'data', 'semua', 'user', 'request'));

    }

    public function selesai(Request $request)
    {
        $json = json_decode($request->json_callback);
        $status = 0;
        $status_pengiriman = null;
        $status_peminjaman = null;
        $status_perawatan = null;
        $kode_pembayaran = null;
        $kode_midtrans = 0;
        $payment_type = null;
        $bank = null;
        $va_numbers = null;

        if ($json->transaction_status == "settlement") {
            $status = 3;
        }

        $jml = 0;
        $durasi = 0;


        foreach ($request->product_id as $kode) {
            $produk = Product::find($kode);
            if ($produk->kategori == "Layanan") {
                $status_perawatan = 1;
            }

            if ($produk->kategori == "Tanaman") {
                $status_peminjaman = 1;
                $status_pengiriman= 1;
            }

            if ($produk->kategori == "Item perawatan") {
                $status_pengiriman= 1;
            }
        }

        if (isset($json->payment_code)) {
            $kode_pembayaran = $json->payment_code;
        }

        if ($json->order_id) {
            $kode_midtrans = $json->order_id;
        }
        $data = [
            'user_id' => Auth::user()->id,
            'total' => $request->total_semua,
            'status_pembayaran' => $status,
            'status_pengiriman' => $status_pengiriman,
            'status_peminjaman' => $status_peminjaman,
            'status_perawatan' => $status_perawatan,
            'payment_type' => $payment_type,
            'kode_pembayaran' => $kode_pembayaran,
            'kode_midtrans' => $kode_midtrans,
            'bank' => $bank,
            'va_numbers' => $va_numbers
        ];

        $masukin = Order::create($data);
        $berapa = 0;
        for ($i = 0; $i < count($request->product_id); $i++) {
            if($request->durasi_perawatan[$i]){
                if($jml <= $request->jumlah[$i]){
                    $jml = $request->jumlah[$i];
                };
                if($durasi <= $request->durasi_perawatan[$i]){
                    $durasi = $request->durasi_perawatan[$i];
                };
            }
            $berapa = $request->jumlah[$i];
            $detail = [
                'order_id' => $masukin->id,
                'product_id' => $request->product_id[$i],
                'durasi_sewa' => $request->durasi_sewa[$i],
                'durasi_perawatan' => $request->durasi_perawatan[$i],
                'jumlah' => $berapa,
                'total' => $request->total[$i],
            ];
            OrderItem::create($detail);
        }
        for($j = 0; $j < count($request->product_id); $j++){
            Cart::where('user_id', Auth::user()->id)->delete();
        }
        if ($request->durasi_perawatan){
            for ($i = 1; $i <= $durasi; $i++){
                for ($j=1; $j <= $jml; $j++){
                    History::create([
                        'order_id' => $masukin->id,
                        'catatan' => null,
                        'proses' => $i .' - '.$j,
                        'status' => 0
                    ]);
                }
            }
        }

        return redirect('/');
    }
}
