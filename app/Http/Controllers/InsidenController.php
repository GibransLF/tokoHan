<?php

namespace App\Http\Controllers;

use App\Models\Insiden;
use Illuminate\Http\Request;

class InsidenController extends Controller
{
    public function index(){
        $insidens = Insiden::with(['stok', 'produk', 'transaksi', 'detail', 'member'])->orderBy('created_at','desc')->get();

        return view("insiden.index", compact('insidens'));
    }
}
