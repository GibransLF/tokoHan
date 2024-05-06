<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Stok;


class ManageProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::where("hidden", false)->get();
        $produks->load('stoks');

        return view("manageProduk/index", compact("produks"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("manageProduk.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string',
            'nama' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
            'ukuran.*' => 'string|max:50',
            'stok.*' => 'integer|min:0',
            'harga.*' => 'numeric|min:0',
        ]);

        // Upload gambar dan tambahkan ke data
        $gambar = $request->file('gambar')->store('img/produk');
        $data = $request->only(['kode', 'nama', 'deskripsi']);
        $data['gambar'] = $gambar;

        $produk = Produk::create($data);

        // Simpan data stok ke dalam database
        if($request->ukuran){
            foreach ($request->ukuran as $index => $ukuran) {
                $stok = new Stok();
                $stok->produk_id = $produk->id;
                $stok->ukuran = $ukuran;
                $stok->stok = $request->stok[$index];
                $stok->stok_total = $request->stok[$index];
                $stok->harga = $request->harga[$index];
                $stok->save();
            }
        }

        // Redirect ke halaman lain dengan pesan sukses
        return redirect()->route('manageProduk.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        return view("manageProduk.edit", compact("produk"));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        $data = $request->validate([
            'kode' => 'required|string',
            'nama' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string',
        ]);

        if(!empty($data['gambar'])){
            $gambar = $request->file('gambar')->store('img/produk');
            $data['gambar'] = $gambar;
        }

        if($produk->update($data)){
            return redirect()->route('manageProduk.index')->with('success', 'Data berhasil diubah.');
        }
        else{
            return redirect()->route('manageProduk.index')->with('errors', 'Data gagal diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Produk::find($id);
        $data->hidden = true;
        if($data->save()){
            return redirect()->route('manageProduk.index')->with('success', 'Data Produk berhasil dihapus!');
        }
        else{
            return redirect()->route('manageProduk.index')->with('errors', 'Data Produk gagal dihapus!');
        }
    }
}
