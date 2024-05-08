<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Stok;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($namaProduk)
    {
        $produk = Produk::where('nama', $namaProduk)->firstOrFail();
        return view("stok.create", compact("produk"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ukuran' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $data["stok_total"] = $data["stok"];
        $data["produk_id"] = $request->produk_id;

        if(Stok::create($data)){

            return redirect()->route('stok.show', $request->nama )->with('success', 'Data berhasil disimpan!');
        }
        else{
            return redirect()->route('member.index', $request->nama)->with('errors', 'Data gagal disimpan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $namaProduk)
    {
        $stoks = Stok::select('stok.*', 'produk.nama')
                ->join('produk', 'stok.produk_id', '=', 'produk.id')
                ->where('produk.nama', $namaProduk)
                ->get();


        return view("stok.show", compact("stoks", "namaProduk"));
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
    public function destroy(string $namaProduk,string $id)
    {
        if(Stok::destroy($id)){
            return redirect()->route('stok.show', $namaProduk)->with('success', 'Data stok berhasil dihapus!');
        }
        else{
            return redirect()->route('stok.show', $namaProduk)->with('errors', 'Data stok gagal dihapus!');
        }
    }
}
