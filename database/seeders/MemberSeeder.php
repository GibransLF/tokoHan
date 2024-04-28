<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('member')->insert([
            'nama' => 'Non Member',
            'alamat' => 'Alamat Non Member',
            'nohp' => '000000000000',
            'dp_limit' => '0.15',
            'rental_limit' => '10',
            'hidden' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('member')->insert([
            'nama' => 'Forz',
            'alamat' => 'Alamat Forz',
            'nohp' => '000000000046',
            'dp_limit' => '0.5',
            'rental_limit' => '15',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
