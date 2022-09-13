<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('total');
            $table->unsignedBigInteger('status_pembayaran');
            $table->unsignedBigInteger('status_pengiriman')->nullable();
            $table->unsignedBigInteger('status_peminjaman')->nullable();
            $table->unsignedBigInteger('status_perawatan')->nullable();
            $table->string('kode_pembayaran')->nullable();
            $table->string('kode_midtrans');
            $table->string('payment_type')->nullable();
            $table->string('bank')->nullable();
            $table->string('va_numbers')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
