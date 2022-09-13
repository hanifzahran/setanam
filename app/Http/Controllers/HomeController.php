<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function getData(){

        return $product = Product::orderBy('id', 'DESC')->get();
    }

    public function index()
    {
        return view('customer.product.product');
    }

    public function detailTanaman(Product $product){
        $user = Auth::user();
        return view('customer.product.detail_tanaman', compact('product', 'user'));
    }

    public function detailLayanan(Product $product){
        $user = Auth::user();
        return view('customer.product.detail_layanan', compact('product', 'user'));
    }

    public function detailItem(Product $product){
        $user = Auth::user();
        return view('customer.product.detail_item', compact('product', 'user'));
    }
}
