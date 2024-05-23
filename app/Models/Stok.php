<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok';
    protected $fillable = [
        'produk_id',
        'stok',
        'stok_total',
        'ukuran',
        'harga',
        'hidden',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
