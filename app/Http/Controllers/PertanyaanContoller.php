<?php

namespace App\Http\Controllers;

use App\Models\Instruksi;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanContoller extends Controller
{
    public function showPertanyaan($id)
    {
        $instruksi = Instruksi::where('id', '=', $id)->first();
        $soal = Pertanyaan::where('id_instruksi', '=', $id)->get();
        return view('soal.kecermatan.pertanyaan.detail-pertanyaan', ['soalList' => $soal, 'instruksi' => $instruksi]);
    }
    public function storePertanyaan(Request $request)
    {

        if ($request->soal == "") {
            return "soal tidak boleh kosong.";
        } else {

            $query = new Pertanyaan;
            $query->id_instruksi = $request->id_instruksi;
            $query->soal = $request->soal;
            $query->kunci = $request->kunci;
            $query->status = $request->status;
            $query->save();
            return 'done';
        }
    }
}
