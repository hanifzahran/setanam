<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama",
        "deskripsi",
        "jumlah",
        "berat",
        "harga",
        "jenis_pot",
        "intensitas_cahaya",
        "kebutuhan_air",
        "gambar",
        "lokasi",
        "kategori",
    ];

    public function cart(){
        $this->belongsTo('App\Models\Cart', 'product_id');
    }
}
