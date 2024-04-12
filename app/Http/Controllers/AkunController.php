<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('akun.index', ['users' =>  $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:users|min:8',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'repeat_password' => 'required|same:password'
        ]);

        if($akun = user::create($data)){
            $akun->assignRole('staff');
            return redirect()->route('akun.index')->with('success', 'Data berhasil disimpan!');
        }
        else{
            return redirect()->route('akun.index')->with('errors', 'Data gagal disimpan!');
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
        $data['id'] = $id;
        return view('akun.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'password' => 'required|min:8',
            'repeat_password' => 'required|same:password'
        ]);

        $data = user::find($id);
        $data->password = $request->password;
        if($data->save()){
            return redirect()->route('akun.index')->with('success', 'Password berhasil diubah.');
        }
        else{
            return redirect()->route('akun.index')->with('errors', 'Password gagal diubah.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(user::destroy($id)){
            return redirect()->route('akun.index')->with('success', 'Data berhasil dihapus!');
        }
        else{
            return redirect()->route('akun.index')->with('errors', 'Data gagal dihapus!');
        }
    }
}
