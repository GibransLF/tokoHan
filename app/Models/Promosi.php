<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produk;
use App\Models\Stok;

class Promosi extends Model
{
    use HasFactory;

    protected $table = 'promosi';
    protected $fillable = [
        'stok_id',
        'produk_id',
        'tgl_mulai',
        'tgl_selesai',
        'diskon',
    ];

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
    public function stok(){
        return $this->belongsTo(Stok::class, 'stok_id', 'id');
    }
}
