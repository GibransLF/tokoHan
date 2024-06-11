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
use Carbon\Carbon;

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
        $user_id = $user->id; 
        $namaUser = $user->name;
        $cabang = 'LF';

        $data = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer',
            'items.*.produk_id' => 'required|integer',
            'items.*.qty' => 'required|integer',
            'items.*.diskon' => 'required',
            'items.*.harga' => 'required|numeric',
            'member' => 'required',
            'dp' => 'required|numeric',
            'rental_total' => 'required|integer',
            'rental_limit' => 'required|integer',
            'dpCheck' => 'required|boolean',
            'tgl_sewa' => 'required|date',
            'tgl_pengembalian' => 'required|date|after_or_equal:tgl_sewa',
        ]);

        $uniqueCode = $cabang . $user_id . Carbon::now()->format('YmdHis') . $data['member'];

        $totalHarga = 0;
        foreach ($data['items'] as $item) {
            $totalDiskon = $item['harga'] * $item['diskon'];
            $harga = $item['harga'] * $item['qty'] - $totalDiskon;
            $totalHarga += $harga;
        }

        if($data['dpCheck'] == true){
            $useDp = $totalHarga*$data['dp'];
            }
        else{        
            $useDp = 0;
        }

        $transaksi = new Transaksi();
            $transaksi->nama_user = $namaUser;
            $transaksi->member_id = $data['member'];
            $transaksi->tgl = now();
            $transaksi->tgl_sewa = $data['tgl_sewa'];
            $transaksi->tgl_pengembalian = $data['tgl_pengembalian'];
            $transaksi->kode_transaksi = $uniqueCode;
            $transaksi->status_rental = 'progress';
            $transaksi->dp_dibayarkan = $useDp;
            $transaksi->harga_total = $totalHarga;
            $transaksi->denda = 0;
        $transaksi->save();

        //megambil id dari trnasksi sebelumnya
        $transaksiId = $transaksi->id;

        foreach($data['items'] as $item){
            $detail_transaksi = new DetailTansaksi();
                $detail_transaksi->member_id = $data['member'];
                $detail_transaksi->stok_id = $item['id'];
                $detail_transaksi->produk_id = $item['produk_id'];
                $detail_transaksi->transaksi_id = $transaksiId;
                $detail_transaksi->qty = $item['qty'];
                $detail_transaksi->diskon_at = $item['diskon'];
                $detail_transaksi->harga_at = $item['harga'];
            $detail_transaksi->save();

            $stok = Stok::findOrFail($item['id']);
                $stok->stok += $item['qty'];
            $stok->save();

            $member = Member::findOrFail($data['member']);
                $member->rental_total += $item['qty'];
            $member->save();
        }

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
    public function success()
    {
        return view("orderProduk.success");
    }
}
