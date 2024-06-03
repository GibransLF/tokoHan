<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promosi;
use App\Models\Produk;
use App\Models\Stok;

class ManagePromosiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promosis = Promosi::with(['produk', 'stok'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view("managePromosi.index", compact("promosis"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::where('hidden', false)->get();
        return view("managePromosi.create", compact("produks"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'produk' => 'required',
            'stok' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:tgl_sewa',
            'diskon' => 'required|numeric|min:0|max:100',
        ]);

        $data["diskon"] = $data["diskon"] / 100;

        $dataDiskon = [
            'stok_id' => $data['stok'],
            'produk_id' => $data['produk'],
            'tgl_mulai' => $data['start'],
            'tgl_selesai' => $data['end'],
            'diskon' => $data['diskon']
        ];

        if(Promosi::create($dataDiskon)){
            return redirect()->route('managePromosi.index')->with('success', 'Data berhasil disimpan!');
        }
        else{
            return redirect()->route('managePromosi.index')->with('errors', 'Data gagal disimpan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stoks = Stok::where('produk_id', $id)
                    ->where('hidden', false)
                    ->get();
        return response()->json($stoks);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produks = Produk::where('hidden', false)->get();
        $promosi = Promosi::findOrFail($id);

        return view('managePromosi.edit', compact('produks','promosi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $promosi = Promosi::findOrFail($id);

        $data = $request->validate([
            'produk' => 'required',
            'stok' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:tgl_sewa',
            'diskon' => 'required|numeric|min:0|max:100',
        ]);

        $data["diskon"] = $data["diskon"] / 100;

        $dataUpdateDiskon = [
            'stok_id' => $data['stok'],
            'produk_id' => $data['produk'],
            'tgl_mulai' => $data['start'],
            'tgl_selesai' => $data['end'],
            'diskon' => $data['diskon']
        ];

        if($promosi->update($dataUpdateDiskon)){
            return redirect()->route('managePromosi.index')->with('success', 'Data berhasil diubah.');
        }
        else{
            return redirect()->route('managePromosi.index')->with('errors', 'Data gagal diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Promosi::destroy($id)){
            return redirect()->route('managePromosi.index')->with('success', 'Data berhasil dihapus!');
        }
        else{
            return redirect()->route('managePromosi.index')->with('errors', 'Data gagal dihapus!');
        }
    }
}
