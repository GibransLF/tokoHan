<?php

namespace App\Models;

use App\Models\Transaksi;
use App\Models\Stok;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTansaksi extends Model
{
    protected $table = 'detail_transaksi';

    protected $fillable = [
        'stok_id',
        'transaksi_id',
        'nama_produk',
        'qty',
        'harga_at',
    ];

    public function transaksis()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
    public function stoks()
    {
        return $this->belongsTo(Stok::class, 'stok_id', 'id');
    }
}
