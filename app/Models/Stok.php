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
    public function promosis()
    {
        return $this->hasMany(Promosi::class, 'stok_id');
    }

    public function currentDiscount()
    {
        return $this->hasOne(Promosi::class, 'stok_id')
                    ->where('tgl_mulai', '<=', now()->toDateString())
                    ->where('tgl_selesai', '>=', now()->toDateString())
                    ->orderBy('tgl_mulai', 'desc');
    }
}
