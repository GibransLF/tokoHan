<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('insiden', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stok_id');
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('detail_transaksi_id');
            $table->string('jenis_insiden');
            $table->text('deskripsi');
            $table->integer('jumlah');
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produk');
            $table->foreign('stok_id')->references('id')->on('stok');
            $table->foreign('transaksi_id')->references('id')->on('transaksi');
            $table->foreign('detail_transaksi_id')->references('id')->on('detail_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insiden');
    }
};
