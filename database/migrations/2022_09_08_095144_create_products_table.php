<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('deskripsi');
            $table->string('jumlah')->nullable();;
            $table->string('berat')->nullable();;
            $table->string('harga')->nullable();;
            $table->string('jenis_pot')->nullable();;
            $table->string('intensitas_cahaya')->nullable();
            $table->string('kebutuhan_air')->nullable();
            $table->string('gambar')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
