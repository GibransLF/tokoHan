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
        'member_id',
        'jenis_insiden',
        'deskripsi',
        'jumlah',
    ];

    public function stok()
    {
        return $this->belongsTo(Stok::class, 'stok_id', 'id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
    public function detail()
    {
        return $this->belongsTo(DetailTansaksi::class, 'detail_transaksi_id', 'id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
