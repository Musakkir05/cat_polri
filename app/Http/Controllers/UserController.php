<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('siswa/index', ['UserList' => $user]);
    }
    public function create()
    {
        return view('siswa/tambah-siswa');
    }
    public function store(Request $request)
    {

        $request->merge([
            'password' => bcrypt($request->password)
        ]);

        $request['status'] = 'Siswa';


        User::create($request->all());

        return redirect(route('siswa'))->with('success', 'Data berhasil ditambahkan');
    }
    public function show($id)
    {
        $siswa = User::findOrFail($id);
        return view('siswa/edit-siswa', ['siswa' => $siswa]);
    }
    public function edit(Request $request, $id)
    {
        $siswa = User::findOrFail($id);
        $siswa->name = $request->name;
        $siswa->No_hp = $request->No_hp;
        $siswa->email = $request->email;
        $siswa->password = $request->password;

        $siswa->save();
        return redirect()->route('siswa')->with('success', 'data berhasil di Ubah');
    }
    public function destroy($id)
    {
        $siswa = User::findOrFail($id);
        if ($siswa) {
            $siswa->delete();
            return redirect()->route('siswa')->with('success', 'data berhasil di hapus');
        }
    }
}
