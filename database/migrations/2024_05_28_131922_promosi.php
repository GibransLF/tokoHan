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
        Schema::create('promosi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stok_id');
            $table->unsignedBigInteger('produk_id');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->decimal('diskon');
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('produk');
            $table->foreign('stok_id')->references('id')->on('stok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promosi');
    }
};
