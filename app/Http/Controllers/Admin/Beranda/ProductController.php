<?php

namespace App\Http\Controllers\Admin\Beranda;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Product::all();
        return view('admin.beranda.ubah', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        $path = $request->file('gambar');
        $namaFoto = Str::random(). '.' . $path->getClientOriginalExtension();
        $path->storeAs('public/images/product', $namaFoto);
        $product = new Product();
        $product->nama = $request->nama;
        $product->deskripsi = $request->deskripsi;
        $product->jumlah = $request->jumlah ?? null;
        $product->berat = $request->berat ?? null;
        $product->harga = $request->harga ?? null;
        $product->jenis_pot = $request->jenis_pot ?? null;
        $product->intensitas_cahaya = $request->intensitas_cahaya ?? null;
        $product->kebutuhan_air = $request->kebutuhan_air ?? null;
        $product->gambar = $namaFoto;
        $product->lokasi = $request->lokasi ?? null;
        $product->kategori = $request->kategori ?? null;
        $product->save();
        return redirect("/admin/ubah");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function editTanaman(Product $product)
    {
        return view('admin.beranda.ubah_tanaman', compact('product'));
    }

    public function editLayanan(Product $product)
    {
        return view('admin.beranda.ubah_layanan', compact('product'));
    }

    public function editItem(Product $product)
    {
        return view('admin.beranda.ubah_item', compact('product'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        if($request->hasFile('gambar')){
            if(Storage::exists("/public/images/siswa/" . $product->gambar)){
                Storage::delete("/public/images/siswa/" . $product->gambar);
            }
            $path = $request->file('gambar');
            $namaFoto = Str::random(). '.' . $path->getClientOriginalExtension();
            $path->storeAs('public/images/product', $namaFoto);
            $product->foto = $namaFoto;
            $product->gambar = $namaFoto;
        }
        $product->nama = $request->nama;
        $product->deskripsi = $request->deskripsi;
        $product->jumlah = $request->jumlah ?? null;
        $product->berat = $request->berat ?? null;
        $product->harga = $request->harga ?? null;
        $product->jenis_pot = $request->jenis_pot ?? null;
        $product->intensitas_cahaya = $request->intensitas_cahaya ?? null;
        $product->kebutuhan_air = $request->kebutuhan_air ?? null;
        $product->lokasi = $request->lokasi ?? null;
        $product->kategori = $request->kategori ?? null;
        $product->save();
        return redirect("/admin/ubah");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(Storage::exists("/public/images/product/" . $product->gambar)){
            Storage::delete("/public/images/product/" . $product->gambar);
        }
        $product->delete();
        return redirect("/admin/ubah");
    }
}
