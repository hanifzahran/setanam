<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "total",
        "status_pembayaran",
        "status_pengiriman",
        "status_peminjaman",
        "status_perawatan",
        "kode_pembayaran",
        "kode_midtrans",
        "payment_type",
        "bank",
        "va_numbers",
    ];

    public function order_details()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function histories(){
        return $this->hasMany('App\Models\History', 'order_id');
    }
}
