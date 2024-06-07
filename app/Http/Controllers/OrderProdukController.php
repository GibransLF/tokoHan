<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Produk;
use App\Models\Stok;
use App\Models\Transaksi;
use App\Models\DetailTansaksi;
use App\Models\Promosi;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();

        $produks = Produk::with(['stoks' => function ($query) {
            $query->with(['currentDiscount']);
        }])->where('hidden', false)->get();

        $hargaView = Stok::select('produk_id', DB::raw('MIN(harga) as hargaMin'))
                    ->groupBy('produk_id')
                    ->get()
                    ->keyBy("produk_id");

        $promosiView = Promosi::select('produk_id', 'diskon')
                        ->where('tgl_mulai', '<=', now()->toDateString())
                        ->where('tgl_selesai', '>=', now()->toDateString())
                        ->orderBy('tgl_mulai', 'desc')
                        ->get()
                        ->keyBy('produk_id');

        return view("orderProduk.index", compact("members", "produks", "hargaView", "promosiView"));
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
        $user = Auth::user();
        $nama = $user->nama; 

        $data = $request->validate([
            'items' => 'required|array',
            'dp' => 'required|numeric',
            'rental_total' => 'required|integer',
            'rental_limit' => 'required|integer',
            'dpCheck' => 'required|boolean',
            'tgl_sewa' => 'required|date',
            'tgl_pengembalian' => 'required|date|after_or_equal:tgl_sewa',
        ]);

        return $request->all();
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
