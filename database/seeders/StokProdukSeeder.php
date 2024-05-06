<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class StokProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //produk
        DB::table('produk')->insert([
            'kode' => 'LF046EZ',
            'nama' => 'Tester',
            'gambar' => 'img/produk/logo.png',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.',
            'hidden' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        //stok
        DB::table('stok')->insert([
            'produk_id' => '1',
            'stok' => '64',
            'stok_total' => '64',
            'ukuran' => 'L',
            'harga' => '50000',
            'hidden' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('stok')->insert([
            'produk_id' => '1',
            'stok' => '64',
            'stok_total' => '64',
            'ukuran' => 'XL',
            'harga' => '100000',
            'hidden' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
