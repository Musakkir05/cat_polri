<?php

namespace App\Http\Controllers;

use App\Models\Detailsoal;
use App\Models\Paket;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index()
    {
        $soal = Detailsoal::all();
        return view('soal.detailSoal', ['SoalList' => $soal]);
    }
    public function store(Request $request)
    {

        $paket = Paket::findOrFail($request->id_paket);

        if ($request->soal == "") {
            return "Soal tidak boleh kosong.";
        } elseif ($request->kunci == "") {
            return "Kunci jawaban soal tidak boleh kosong.";
        } elseif ($request->score == "") {
            return "Score soal tidak boleh kosong.";
        } elseif ($request->status == "") {
            return "Status soal tidak boleh kosong.";
        } else {

            $query = new Detailsoal;
            $query->id_paket = $paket->id;
            $query->jenis = $paket->jenis;
            $query->soal = $request->soal;
            $query->pilA = $request->pila;
            $query->pilB = $request->pilb;
            $query->pilC = $request->pilc;
            $query->pilD = $request->pild;
            $query->pilE = $request->pile;
            $query->kunci_jawaban = $request->kunci;
            $query->score = $request->score;
            $query->status = $request->status;
            $query->save();
            return 'ok';
        }
    }
    public function show($id)
    {
        $soal = Detailsoal::findOrFail($id);
        return view('soal.aksi.edit', ['soal' => $soal]);
    }

    public function edit(Request $request)
    {

        if ($request->soal == "") {
            return "Soal tidak boleh kosong.";
        } elseif ($request->kunci == "") {
            return "Kunci jawaban soal tidak boleh kosong.";
        } elseif ($request->score == "") {
            return "Score soal tidak boleh kosong.";
        } elseif ($request->status == "") {
            return "Status soal tidak boleh kosong.";
        } else {

            $query = Detailsoal::findOrFail($request->id);

            $query->soal = $request->soal;
            $query->pilA = $request->pila;
            $query->pilB = $request->pilb;
            $query->pilC = $request->pilc;
            $query->pilD = $request->pild;
            $query->pilE = $request->pile;
            $query->kunci_jawaban = $request->kunci;
            $query->score = $request->score;
            $query->status = $request->status;
            $query->save();
            return 'ok';
        }
    }

    public function delete($id)
    {
        $soal = Detailsoal::findOrFail($id);
        // $soal->delete();
        return response()->json(['success' => 'Soal berhasil di hapus']);
    }
}
