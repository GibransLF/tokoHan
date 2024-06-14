<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insiden extends Model
{
    use HasFactory;

    protected $table = "insiden";

    protected $fillable = [
        'stok_id',
        'produk_id',
        'transaksi_id',
        'detail_transaksi_id',
        'jenis_insiden',
        'deskripsi',
        'jumlah',
    ];
}
