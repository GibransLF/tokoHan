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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_user');
            $table->unsignedBigInteger('member_id');
            $table->dateTime('tgl')->now();
            $table->date('tgl_sewa');
            $table->date('tgl_pengembalian');
            $table->string('kode_transaksi')->unique();
            $table->string('status_rental');
            $table->decimal('dp_dibayarkan', 10, 2);
            $table->decimal('harga_total', 10, 2);
            $table->decimal('denda', 10, 2);
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('member');
        });

        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('stok_id');
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('transaksi_id');
            $table->string('nama_produk');
            $table->integer('qty');
            $table->decimal('diskon_at')->default(0);
            $table->decimal('harga_at', 10, 2);
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('member');
            $table->foreign('stok_id')->references('id')->on('stok');
            $table->foreign('produk_id')->references('id')->on('produk');
            $table->foreign('transaksi_id')->references('id')->on('transaksi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
        Schema::dropIfExists('transaksi');
    }
};
