<?php

namespace App\Http\Controllers;


use App\Models\Jawab;
use App\Models\Paket;
use App\Models\Instruksi;
use App\Models\Detailsoal;
use App\Models\Jawaban_kecermatan;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class UjianController extends Controller
{
    public function index()
    {
        return view('ujian.index');
    }
    public function detailSoalKecerdasan()
    {
        $userId = auth()->user()->id; // Mendapatkan ID pengguna yang sedang login

        // Menghitung jumlah jawaban kecermatan berdasarkan ID pengguna
        $jumlahJawaban = Jawaban_kecermatan::where('id_user', $userId)->count();

        // Jika jumlah jawaban lebih dari 10, lakukan pengalihan
        if ($jumlahJawaban > 5) {
            return redirect()->back()->with('message', 'Anda sudah melakukan ujian, silahkan pilih menu laporan untuk melihat hasil ujian');
        }

        $soal = Detailsoal::where('jenis', '=', 'Kecerdasan')->get();
        $soal = $soal->shuffle();
        $paket = Paket::where('jenis', '=', 'Kecerdasan')->get();
        $fullsc = true;
        return view('ujian.kecerdasan', compact('soal', 'paket', 'fullsc'));
    }
    public function getSoal(Request $request)
    {

        $nomorSoal = $request->input('nomor_soal');
        $idUser = auth()->user()->id;
        $idSoal = $request->input('id_soal');
        $soal = Detailsoal::find($idSoal);
        $jawaban = Jawab::where('id_soal', $idSoal)->where('id_user', '=', $idUser)->first();
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
        $idUser = auth()->user()->id;
        $idSoal = $request->input('id_soal');
        $idPaket = $request->input('id_paket');
        $jawaban1 = $request->input('jawaban1');
        $jawaban2 = $request->input('jawaban2');

        // Cari data jawaban berdasarkan id_soal
        $jawaban = Jawab::where('id_soal', $idSoal)->where('id_user', '=', $idUser)->first();

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
        $idUser = auth()->user()->id;
        $idSoal = $request->input('id_soal');

        $soal = Detailsoal::find($idSoal);
        $jawaban = Jawab::where('id_soal', $idSoal)->where('id_user', '=', $idUser)->first();
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
        $idUser = auth()->user()->id;
        // Cari data jawaban berdasarkan id_soal
        $jawaban = Jawab::where('id_soal', $idSoal)->where('id_user', '=', $idUser)->first();

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

    public function detailSoalKecermatan()
    {
        $petunjuk = Instruksi::where('status', '=', 'Y')->first();
        $nomor = 1;
        $soal = Pertanyaan::where('id_instruksi', '=', $petunjuk->id)->first();



        return view('ujian.kecermatan.index', compact('petunjuk', 'soal', 'nomor'));
    }
    public function getSoalKecermatan(Request $request)
    {

        $id_pertanyaan = $request->id_pertanyaan;
        $id_user = auth()->user()->id;
        $id_instruksi = $request->id_instruksi;
        $pilihan = $request->answer;

        $query = Jawaban_kecermatan::where('id_pertanyaan', $id_pertanyaan)
            ->where('id_instruksi', $id_instruksi)
            ->where('id_user', $id_user)
            ->where('id_pertanyaan', '!=', 199999)
            ->first();

        if (!$query) {
            $query = new Jawaban_kecermatan();
            $query->id_user = $id_user;
            $query->id_instruksi = $id_instruksi;
            $query->id_pertanyaan = $id_pertanyaan;
        }

        $query->pilihan = $pilihan;
        $query->save();

        $soal = Pertanyaan::where('id_instruksi', '=', $id_instruksi)->where('status', '=', 'Y')->where('id', '>', $id_pertanyaan)->orderBy('id')->first();


        if (!isset($soal)) {
            $petunjuk = Instruksi::where('id', '>', $id_instruksi)->where('status', '=', 'Y')
                ->orderBy('id')
                ->first();

            if (!isset($petunjuk)) {
                return 'ok';
            }

            $soal = Pertanyaan::where('id_instruksi', '=', $petunjuk->id)
                ->first();


            return response()->json(['soal' => $soal, 'petunjuk' => $petunjuk]);
        } else {

            $petunjuk = Instruksi::where('id', '=', $id_instruksi)
                ->first();


            return response()->json(['soal' => $soal, 'petunjuk' => $petunjuk]);
        }
    }


    public function resetUjian()
    {
        if (Jawab::count() === 0 && Jawaban_kecermatan::count() === 0) {
            return response()->json(['message' => 'Data ujian sudah kosong'], 200);
        }
        Jawab::truncate();
        Jawaban_Kecermatan::truncate();

        return response()->json(['message' => 'Ujian telah direset'], 200);
    }
}
