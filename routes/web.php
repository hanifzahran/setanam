<?php
date_default_timezone_set("Asia/Jakarta");

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index']);
Route::get('/getData', [\App\Http\Controllers\HomeController::class, 'getData']);

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate']);
Route::get('/register', [\App\Http\Controllers\LoginController::class, 'register']);
Route::post('/register', [\App\Http\Controllers\LoginController::class, 'registered']);

Route::get('/admin/login', [\App\Http\Controllers\Admin\LoginController::class, 'index']);
Route::post('/admin/login', [\App\Http\Controllers\Admin\LoginController::class, 'authenticate']);

Route::group(["middleware" => "auth"], function () {

    Route::group(['middleware' => "isAdmin"], function () {
        // Halaman Admin
        Route::prefix('admin')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\Beranda\HomeController::class, "index"]);

            Route::get('/detail-customer', function () {
                return view('admin.beranda.data_customer');
            });
            Route::get('/data-customer', [\App\Http\Controllers\Admin\Beranda\DetailController::class, 'dataCustomer']);


            Route::get('/detail-transaksi', [\App\Http\Controllers\Admin\Beranda\DetailController::class, 'detailTransaksi']);
            Route::get('/data-transaksi', [\App\Http\Controllers\Admin\Beranda\DetailController::class, 'dataTransaksi']);

            Route::get('/ubah', [\App\Http\Controllers\Admin\Beranda\ProductController::class, 'index']);

//       Crud Product
            Route::get('/ubah-tanaman/{product}/edit', [\App\Http\Controllers\Admin\Beranda\ProductController::class, 'editTanaman']);
            Route::post('/ubah-tanaman/{product}/update', [\App\Http\Controllers\Admin\Beranda\ProductController::class, 'update']);

            Route::get('/ubah-layanan/{product}/edit', [\App\Http\Controllers\Admin\Beranda\ProductController::class, 'editLayanan']);
            Route::post('/ubah-layanan/{product}/update', [\App\Http\Controllers\Admin\Beranda\ProductController::class, 'update']);

            Route::get('/ubah-item/{product}/edit', [\App\Http\Controllers\Admin\Beranda\ProductController::class, 'editItem']);
            Route::post('/ubah-item/{product}/update', [\App\Http\Controllers\Admin\Beranda\ProductController::class, 'update']);

            Route::get('/tambah-tanaman', function () {
                return view('admin.beranda.tambah_tanaman');
            });

            Route::post('/tambah-tanaman', [\App\Http\Controllers\Admin\Beranda\ProductController::class, 'store']);

            Route::get('/tambah-layanan', function () {
                return view('admin.beranda.tambah_layanan');
            });
            Route::post('/tambah-layanan', [\App\Http\Controllers\Admin\Beranda\ProductController::class, 'store']);

            Route::get('/tambah-item', function () {
                return view('admin.beranda.tambah_item');
            });
            Route::post('/tambah-item', [\App\Http\Controllers\Admin\Beranda\ProductController::class, 'store']);


            Route::prefix('pemesanan')->group(function () {
                Route::get('/data-pesanan', [\App\Http\Controllers\Admin\Pemesanan\HomeController::class, 'dataPesanan']);
                Route::get('/', [\App\Http\Controllers\Admin\Pemesanan\HomeController::class, 'index']);
                Route::get('/daftar-pengiriman', [\App\Http\Controllers\Admin\Pemesanan\HomeController::class, 'pengiriman']);
                Route::post('/konfirmasi-pengiriman/{order}', [\App\Http\Controllers\Admin\Pemesanan\HomeController::class, 'konfirmasi']);
            });


            Route::prefix('perawatan')->group(function () {
                Route::get('/', [\App\Http\Controllers\Admin\Perawatan\HomeController::class, 'index']);
                Route::get('/detail/{id}', [\App\Http\Controllers\Admin\Perawatan\HomeController::class, 'detail']);
            });
        });
    });

//  Akun
    Route::get('/akun/pengaturan-akun', [\App\Http\Controllers\AccountController::class, 'index']);
    Route::get('/akun/pemesanan', [\App\Http\Controllers\AccountController::class, 'pemesanan']);
    Route::post('/logout', [\App\Http\Controllers\AccountController::class, 'logout']);
// Akhir Akun

//  Halaman Detail
    Route::get('/product/detail-tanaman/{product}', [\App\Http\Controllers\HomeController::class, 'detailTanaman']);
    Route::get('/product/detail-layanan/{product}', [\App\Http\Controllers\HomeController::class, 'detailLayanan']);
    Route::get('/product/detail-item/{product}', [\App\Http\Controllers\HomeController::class, 'detailItem']);
// Akhir Halaman Detail

//  Pembelian Product
    Route::get('/product/keranjang', [\App\Http\Controllers\CartController::class, 'index']);
    Route::post('/product/pembayaran', [\App\Http\Controllers\CartController::class, 'bayar']);
    Route::post('/product/bayar', [\App\Http\Controllers\CartController::class, 'selesai']);
//  Akhir Pembelian Product

    Route::get('/product/progress-pemesanan/{id}', [\App\Http\Controllers\AccountController::class, 'detailPemesanan']);
    Route::get('/product/barang-diterima/{id}', [\App\Http\Controllers\AccountController::class, 'terimaBarang']);


    Route::get('/product/konfirmasi-perawatan/{id}/{od}/{ed}', [\App\Http\Controllers\AccountController::class, 'konfirmasi']);
    Route::post('/product/konfirmasi-perawatan', [\App\Http\Controllers\AccountController::class, 'konfirmasiLagi']);
    Route::get('/product/data-pengembalian/{id}', [\App\Http\Controllers\AccountController::class, 'pengembalianTanaman']);
    

});
