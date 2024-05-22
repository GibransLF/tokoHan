<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Produk;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();

        $produks = Produk:: select("produk.id AS id_produk", "kode", "nama", "gambar", "deskripsi")
                            ->where("hidden", false)->with(('stoks'))
                            ->get();

        $hargaView = Stok::select('produk_id', DB::raw('MIN(harga) as hargaMin'))
                    ->groupBy('produk_id')
                    ->get()
                    ->keyBy("produk_id");

        return view("orderProduk.index", compact("members", "produks", "hargaView"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $memberId)
    {
        $member = Member::findOrFail($memberId);
        return response()->json($member);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
