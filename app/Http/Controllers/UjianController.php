<?php

namespace App\Http\Controllers;

use App\Models\Jawab;
use App\Models\Paket;
use App\Models\Detailsoal;

use Illuminate\Http\Request;
use function Laravel\Prompts\alert;

class UjianController extends Controller
{
    public function index()
    {
        return view('ujian.index');
    }
    public function detailSoalKecerdasan()
    {
        $soal = Detailsoal::where('jenis', '=', 'Kecerdasan')->get();
        $soal = $soal->shuffle();
        $paket = Paket::where('jenis', '=', 'Kecerdasan')->get();
        return view('ujian.kecerdasan', compact('soal', 'paket'));
    }
    public function getSoal(Request $request)
    {

        $nomorSoal = $request->input('nomor_soal');

        $idSoal = $request->input('id_soal');
        $soal = Detailsoal::find($idSoal);
        $jawaban = Jawab::where('id_soal', $idSoal)->first();
        if ($jawaban) {
            return view('ujian.get_soal', compact('soal', 'nomorSoal', 'jawaban'))
                ->with('noSoal', json_encode($nomorSoal));
        } else {
            $jawaban = '';
            return view('ujian.get_soal', compact('soal', 'nomorSoal', 'jawaban'))
                ->with('noSoal', json_encode($nomorSoal));
        }
    }
    public function simpanJawaban(Request $request)
    {

        $idSoal = $request->input('id_soal');
        $idPaket = $request->input('paket_soal');
        $jawaban1 = $request->input('jawaban1');
        $jawaban2 = $request->input('jawaban2');

        // Cari data jawaban berdasarkan id_soal
        $jawaban = Jawab::where('id_soal', $idSoal)->first();

        // Jika data jawaban tidak ditemukan, buat data baru
        if (!$jawaban) {
            $jawaban = new Jawab();
            $jawaban->id_soal = $idSoal;
            $jawaban->id_paket = $idPaket;
            $jawaban->id_user = auth()->user()->id;
        }

        // Update atau simpan jawaban sesuai dengan input
        $jawaban->pilihan1 = $jawaban1;
        $jawaban->pilihan2 = $jawaban2;
        $jawaban->save();
    }

    public function DetailSoalKepribadian()
    {
        $soal = Detailsoal::where('jenis', '=', 'Kepribadian')->where('status', '=', 'Y')->get();
        $soal = $soal->shuffle();
        $paket = Paket::where('jenis', '=', 'Kepribadian')->get();

        return view('ujian.kepribadian.index', compact('soal', 'paket'));
    }
    public function getSoalKepribadian(Request $request)
    {

        $nomorSoal = $request->input('nomor_soal');

        $idSoal = $request->input('id_soal');

        $soal = Detailsoal::find($idSoal);
        $jawaban = Jawab::where('id_soal', $idSoal)->first();
        if ($jawaban) {
            return view('ujian.kepribadian.get_soal', compact('soal', 'nomorSoal', 'jawaban'))
                ->with('noSoal', json_encode($nomorSoal));
        } else {
            $jawaban = '';
            return view('ujian.kepribadian.get_soal', compact('soal', 'nomorSoal', 'jawaban'))
                ->with('noSoal', json_encode($nomorSoal));
        }
    }
    public function simpanJawabanKepribadian(Request $request)
    {

        $idSoal = $request->input('id_soal');
        $idPaket = $request->input('id_paket');
        $jawaban1 = $request->input('jawaban1');

        // Cari data jawaban berdasarkan id_soal
        $jawaban = Jawab::where('id_soal', $idSoal)->first();

        // Jika data jawaban tidak ditemukan, buat data baru
        if (!$jawaban) {
            $jawaban = new Jawab();
            $jawaban->id_soal = $idSoal;
            $jawaban->id_paket = $idPaket;
            $jawaban->id_user = auth()->user()->id;
        }

        // Update atau simpan jawaban sesuai dengan input
        $jawaban->pilihan1 = $jawaban1;
        $jawaban->save();
    }
}
