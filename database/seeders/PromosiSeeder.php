<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PromosiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('promosi')->insert([
            'stok_id' => 2,
            'produk_id' => 1,
            'tgl_mulai' => now(),
            'tgl_selesai' => Carbon::now()->addDays(7),
            'diskon' => 0.3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
