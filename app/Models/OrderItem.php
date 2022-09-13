<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
      "order_id",
      "product_id",
      "jumlah_perawatan",
      "durasi_sewa",
      "durasi_perawatan",
      "jumlah",
      "total",
    ];

    public function orders()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

}
