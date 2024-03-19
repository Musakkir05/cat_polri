<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $soal = Paket::all();
        return view('soal.index', ['SoalList' => $soal]);
    }
    public function show($id)
    {
        $paket = Paket::findOrfail($id);
        return view('soal.edit-paket', ['paket' => $paket]);
    }
    public function edit(Request $request, $id)
    {
        $paket = Paket::findOrfail($id);
        $paket->deskripsi = $request->deskripsi;
        $paket->kkm = $request->kkm;
        $paket->waktu = $request->waktu;
        $paket->save();
        return redirect('soal/index')->with('message', 'Data berhasil diubah');
    }
}
