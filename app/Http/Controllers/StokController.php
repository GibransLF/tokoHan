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
    public function create($kodeProduk)
    {
        $produk = Produk::where('kode', $kodeProduk)->firstOrFail();
        return view("stok.create", compact("produk"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ukuran' => 'required|string|max:50',
            'stok_total' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $data["produk_id"] = $request->produk_id;

        if(Stok::create($data)){
            return redirect()->route('stok.show', $request->kode )->with('success', 'Data berhasil disimpan!');
        }
        else{
            return redirect()->route('stok.index', $request->kode)->with('errors', 'Data gagal disimpan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kodeProduk)
    {
        $stoks = Stok::select('stok.*', 'produk.kode', 'produk.nama')
                ->join('produk', 'stok.produk_id', '=', 'produk.id')
                ->where('produk.kode', $kodeProduk)
                ->where('stok.hidden', false)
                ->get();


        return view("stok.show", compact("stoks", "kodeProduk"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kodeProduk,string $id)
    {
        $stok = Stok::findOrFail($id);
        $produk = Produk::where('kode', $kodeProduk)->firstOrFail();

        return view("stok.edit", compact("stok", "produk"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $stok = Stok::findOrFail($id);

        $data = $request->validate([
            'ukuran' => 'required|string|max:50',
            'stok_total' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);
        if($stok->update($data)){
            return redirect()->route('stok.show', $request["kode"])->with('success', 'Data berhasil diubah.');
        }
        else{
            return redirect()->route('stok.show', $request["nama"])->with('errors', 'Data gagal diubah.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kodeProduk,string $id)
    {
        $data = Stok::find($id);
        $data->hidden = true;
        if($data->save()){
            return redirect()->route('stok.show', $kodeProduk)->with('success', 'Data stok berhasil dihapus!');
        }
        else{
            return redirect()->route('stok.show', $kodeProduk)->with('errors', 'Data stok gagal dihapus!');
        }
    }
}
