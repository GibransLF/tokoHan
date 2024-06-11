<?php

namespace App\Models;

use App\Models\Member;
use App\Models\DetailTansaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'nama_user',
        'member_id',
        'tgl',
        'tgl_sewa',
        'tgl_pengembalian',
        'kode_transaksi',
        'status_rental',
        'dp_dibayarkan',
        'harga_total',
        'denda',
    ];

    public function detailsTransaksis()
    {
        return $this->hasMany(DetailTansaksi::class, 'transaksi_id');
    }

    public function member(){
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
