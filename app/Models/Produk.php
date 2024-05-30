<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stok;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = [
        'kode',
        'nama',
        'gambar',
        'deskripsi',
        'hidden',
    ];

    public function stoks()
    {
        return $this->hasMany(Stok::class, 'produk_id')->where('hidden', false);
    }
}
