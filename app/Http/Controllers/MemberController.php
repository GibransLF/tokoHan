<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::where('hidden', false)->get();
        return view("member.index", compact("members"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("member.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|unique:member|min:3',
            'alamat' => 'required',
            'nohp' => 'required|min:12',
            'dp_limit' => 'required',
            'rental_limit' => 'required',
        ]);
        
        $data['dp_limit'] /= 100;

        if(Member::create($data)){

            return redirect()->route('member.index')->with('success', 'Data berhasil disimpan!');
        }
        else{
            return redirect()->route('member.index')->with('errors', 'Data gagal disimpan!');
        }
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
        $member = Member::findOrFail($id);

        return view("member.edit", compact("member"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|unique:member,nama,'.$id.'|min:3',
            'alamat' => 'required',
            'nohp' => 'required|min:12',
            'dp_limit' => 'required',
            'rental_limit' => 'required',
        ]);

        $data['dp_limit'] /= 100;

        if($member->update($data)){
            return redirect()->route('member.index')->with('success', 'Data berhasil diubah.');
        }
        else{
            return redirect()->route('member.index')->with('errors', 'Data gagal diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Member::find($id);
        $data->hidden = true;
        if($data->save()){
            return redirect()->route('member.index')->with('success', 'Data berhasil dihapus!');
        }
        else{
            return redirect()->route('member.index')->with('errors', 'Data gagal dihapus!');
        }
    }
}
