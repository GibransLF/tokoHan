<?php

namespace App\Http\Controllers;

use App\Models\DetailTansaksi;
use App\Models\Member;
use App\Models\Stok;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Auth\Events\Validated;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $nama = $request->input('nama','all');
        $nama == '' ? $nama = 'all' : $nama;
        $status = $request->input('status','all');
        $perPage = 5;

        $query = Transaksi::with(['member', 'produk'])->withCount('detailTransaksis')->orderBy('created_at','desc');

        if ($nama !== 'all') {
            $query->whereHas('member', function ($query) use ($nama) {
                $query->where('nama', 'like', '%' . $nama . '%');
            });
        }
    
        if ($status == 'late') {
            $query->where('tgl_pengembalian', '<', now()->toDateString())
                    ->where('status_rental', 'progress');
        } elseif ($status !== 'all') {
            $query->where('status_rental', $status);
        }
    
        
        $transaksis = $query->paginate($perPage);

        return view("transaksi.index", compact("transaksis"));
        }
        
    public function canceled(string $kode_transaksi)
    {
        $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        $transaksi->status_rental = 'canceled';
        $transaksi->save();

        $details = DetailTansaksi::where('transaksi_id',$transaksi->id) ->get();

        foreach ($details as $detail) {
            $stok = Stok::findOrFail($detail->stok_id);
            $stok->stok -= $detail->qty;
            $stok->save();
            
            $member = Member::findOrFail($detail->member_id);
            $member->rental_total -= $detail->qty;
            $member->save();
        }

        return redirect()->route('transaksi.detail', $kode_transaksi)->with('success', 'Data berhasil diubah.');
    }
    public function confirm(request $request, string $kode_transaksi)
    {
        $data = $request->validate([
            'denda' => 'nullable|numeric',
            ]);
        $data['denda'] = ($data['denda'] == null) ? 0 : $data['denda'];

        $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        $transaksi->status_rental = 'completed';
        $transaksi->denda = $data['denda'];
        $transaksi->save();

        $details = DetailTansaksi::where('transaksi_id',$transaksi->id) ->get();

        foreach ($details as $detail) {
            $stok = Stok::findOrFail($detail->stok_id);
            $stok->stok -= $detail->qty;
            $stok->save();

            $member = Member::findOrFail($detail->member_id);
            $member->rental_total -= $detail->qty;
            $member->save();
        }

        return redirect()->route('transaksi.detail', $kode_transaksi)->with('success', 'Data berhasil diubah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode_transaksi)
    {
        $transaksi = Transaksi::where('kode_transaksi', $kode_transaksi)
                                ->with(['detailTransaksis.stok', 'detailTransaksis.produk'])
                                ->firstOrFail();
        $detailTransaksis = $transaksi->detailTransaksis;

        return view('transaksi.detail', compact('transaksi', 'detailTransaksis','kode_transaksi'));
    }

    public function insiden(string $kode_transaksi){
        return view("transaksi.insiden", compact("kode_transaksi"));
    }
}
