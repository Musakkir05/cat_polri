<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Instruksi;
use App\Models\Detailsoal;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class
SoalController extends Controller
{
    public function index($id)
    {
        $paket = Paket::findOrFail($id);
        // dd($paket->paket);
        if ($paket->paket === 'Kecerdasan') {
            $soal = Detailsoal::where('jenis', '=', 'Kecerdasan')->get();
            return view('soal.kecerdasan.index', ['soalList' => $soal]);
        } elseif ($paket->paket === 'Kepribadian') {

            $soal = Detailsoal::where('jenis', '=', 'Kepribadian')->get();

            return view('soal.kepribadian.index', ['soalList' => $soal]);
        } elseif ($paket->paket === 'Kecermatan') {
            $jumlah_soal = Pertanyaan::whereHas('instruksi', function ($query) {
                // Filter instruksi yang memiliki status Y
                $query->where('status', 'Y');
            })
                ->where('status', 'Y') // Filter pertanyaan yang memiliki status Y
                ->count();
            $soal = Instruksi::all();
            return view('soal.kecermatan.index', ['soalList' => $soal, 'jumlah_soal' => $jumlah_soal]);
        }
    }
    public function store(Request $request)
    {
        $paket = Paket::findOrFail($request->id_paket);

        if ($request->soal == "") {
            return "Soal tidak boleh kosong.";
        } elseif ($request->kunci1 == "") {
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
            $query->kunci_jawaban1 = $request->kunci1;
            $query->kunci_jawaban2 = $request->kunci2;
            $query->score = $request->score;
            $query->status = $request->status;
            $query->save();
            return 'ok';
        }
    }
    public function show($id)
    {
        $soal = Detailsoal::findOrFail($id);
        return view('soal.kecerdasan.edit', ['soal' => $soal]);
    }

    public function update(Request $request)
    {

        if ($request->soal == "") {
            return "Soal tidak boleh kosong.";
        } elseif ($request->kunci1 == "") {
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
            $query->kunci_jawaban1 = $request->kunci1;
            $query->kunci_jawaban2 = $request->kunci2;
            $query->score = $request->score;
            $query->status = $request->status;
            $query->save();
            return 'ok';
        }
    }

    public function delete($id)
    {
        $soal = Detailsoal::findOrFail($id);
        $soal->delete();
        return response()->json(['success' => 'Soal berhasil di hapus']);
    }

    public function storeKepribadian(Request $request)
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
            $query->kunci_jawaban1 = $request->kunci;
            $query->score = $request->score;
            $query->status = $request->status;
            $query->save();
            return 'done';
        }
    }
    public function showKepribadian($id)
    {
        $soal = Detailsoal::findOrFail($id);
        return view('soal.kepribadian.edit', ['soal' => $soal]);
    }
    public function updateKepribadian(Request $request)
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
            $query->kunci_jawaban1 = $request->kunci;
            $query->score = $request->score;
            $query->status = $request->status;
            $query->save();

            return 'ok';
        }
    }
    public function storeKecermatan(Request $request)
    {

        $paket = Paket::findOrFail($request->id_paket);

        if ($request->soal == "") {
            return "soal tidak boleh kosong.";
        } else {

            $query = new Instruksi;
            $query->id_paket = $paket->id;
            $query->soal = $request->soal;
            $query->waktu = $request->waktu;
            $query->status = $request->status;
            $query->save();
            return 'done';
        }
    }
    public function editKecermatan($id)
    {
        $soal = Instruksi::findOrFail($id);
        return view('soal/kecermatan/edit', ['soal' => $soal]);
    }
    public function updateKecermatan(Request $request)
    {

        if ($request->soal == "") {
            return "soal tidak boleh kosong.";
        } else {

            $query = Instruksi::findOrFail($request->id);
            $query->soal = $request->soal;
            $query->status = $request->status;
            $query->save();
            return 'ok';
        }
    }
    public function deleteKecermatan($id)
    {
        $soal = Instruksi::findOrFail($id);
        $soal->delete();
        return response()->json(['success' => 'Soal berhasil di hapus']);
    }


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
    public function editPertanyaan($id)
    {
        $soal = Pertanyaan::findOrFail($id);
        return view('soal/kecermatan/pertanyaan/edit', ['soal' => $soal]);
    }
    public function updatePertanyaan(Request $request)
    {
        if ($request->soal == "") {
            return "soal tidak boleh kosong.";
        } else {

            $query = Pertanyaan::findOrFail($request->id);
            $query->soal = $request->soal;
            $query->kunci = $request->kunci;
            $query->status = $request->status;
            $query->save();
            return 'ok';
        }
    }
}
