<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jawab;
use App\Models\Paket;
use App\Models\Detailsoal;
use App\Models\Pertanyaan;
use App\Models\Jawaban_kecermatan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function show()
    {

        $detailSoals = DetailSoal::where('status', 'Y')->get();


        $result = [];


        $jumlahSoalKecerdasan = DetailSoal::where('jenis', 'Kecerdasan')->where('status', 'Y')->count();

        $jumlahSoalKepribadian = DetailSoal::where('jenis', 'Kepribadian')->where('status', 'Y')->count();


        foreach ($detailSoals as $detailSoal) {

            $paket = Paket::find($detailSoal->id_paket);


            if ($paket) {

                $jenis_soal = $paket->jenis;


                $jawabans = Jawab::where('id_soal', $detailSoal->id)->get();


                if ($jawabans->isEmpty()) {
                    $jawabans = [null];
                }


                foreach ($jawabans as $jawaban) {

                    $user = optional($jawaban)->user;


                    if ($user && !isset($result[$user->id])) {
                        $result[$user->id] = [
                            'nama' => $user->name,
                            'nilai' => [
                                'Kecerdasan' => ['jawaban_benar' => 0, 'jumlah_soal' => 0],
                                'Kepribadian' => ['jawaban_benar' => 0, 'jumlah_soal' => 0],
                                'Kecermatan' => ['jawaban_benar' => 0, 'jumlah_soal' => 0],
                            ],
                        ];
                    }
                    if ($jawabans->isEmpty()) {
                        $jawabans = [null];
                    }


                    if ($jawaban && $jawaban->pilihan2 === null) {

                        $benar = ($jawaban->pilihan1 === $detailSoal->kunci_jawaban1) ? 1 : 0;
                    } elseif ($jawaban) {

                        $benar = (
                            ($jawaban->pilihan1 === $detailSoal->kunci_jawaban1 || $jawaban->pilihan1 === $detailSoal->kunci_jawaban2) &&
                            ($jawaban->pilihan2 === $detailSoal->kunci_jawaban1 || $jawaban->pilihan2 === $detailSoal->kunci_jawaban2)
                        ) ? 1 : 0;
                    }


                    $result[$user->id]['nilai'][$jenis_soal]['jawaban_benar'] += $benar;

                    $result[$user->id]['nilai'][$jenis_soal]['jumlah_soal']++;
                }
            }
        }


        foreach ($result as &$userResult) {
            $userResult['nilai']['Kecerdasan']['jumlah_soal'] = $jumlahSoalKecerdasan;
        }

        foreach ($result as &$userResult) {
            $userResult['nilai']['Kepribadian']['jumlah_soal'] = $jumlahSoalKepribadian;
        }


        $pertanyaansKecermatan = Pertanyaan::where('status', 'Y')->get();


        $jumlah_soal_kecermatan = Pertanyaan::whereHas('instruksi', function ($query) {

            $query->where('status', 'Y');
        })
            ->where('status', 'Y')
            ->count();


        foreach ($result as &$userResult) {
            $userResult['nilai']['Kecermatan']['jumlah_soal'] = $jumlah_soal_kecermatan;
        }


        foreach ($pertanyaansKecermatan as $pertanyaan) {
            // Dapatkan semua jawaban kecermatan untuk pertanyaan ini
            $jawabanKecermatans = Jawaban_Kecermatan::where('id_pertanyaan', $pertanyaan->id)->get();

            // Dapatkan id_instruksi yang terkait dengan pertanyaan ini
            $id_instruksi = $pertanyaan->id_instruksi;

            // Pastikan $id_instruksi tidak null sebelum mengakses propertinya
            if ($id_instruksi) {
                // Iterasi setiap jawaban kecermatan
                foreach ($jawabanKecermatans as $jawabanKecermatan) {
                    // Pastikan $jawabanKecermatan tidak null sebelum mengakses propertinya
                    if ($jawabanKecermatan) {
                        // Dapatkan user terkait dengan jawaban ini
                        $user = optional($jawabanKecermatan)->user;

                        // Periksa apakah user ada
                        if ($user) {
                            // Inisialisasi array untuk user jika belum ada
                            if (!isset($result[$user->id])) {
                                $result[$user->id] = [
                                    'nama' => $user->name,
                                    'nilai' => [
                                        'Kecerdasan' => ['jawaban_benar' => 0, 'jumlah_soal' => 0],
                                        'Kepribadian' => ['jawaban_benar' => 0, 'jumlah_soal' => 0],
                                        'Kecermatan' => [],
                                    ],
                                ];
                            }

                            // Inisialisasi array untuk id_instruksi jika belum ada
                            if (!isset($result[$user->id]['nilai']['Kecermatan'][$id_instruksi])) {
                                $result[$user->id]['nilai']['Kecermatan'][$id_instruksi] = [
                                    'jawaban_benar' => 0,
                                    'jawaban_salah' => 0,
                                    'jawaban_kosong' => 0,
                                    'tidak_dijawab' => 0,
                                    'jumlah_soal' => 0,
                                ];
                            }

                            // Periksa apakah jawaban benar, salah, kosong, atau tidak dijawab
                            $pertanyaan = Pertanyaan::find($jawabanKecermatan->id_pertanyaan);
                            if ($pertanyaan) {
                                if ($jawabanKecermatan->pilihan === $pertanyaan->kunci) {
                                    $result[$user->id]['nilai']['Kecermatan'][$id_instruksi]['jawaban_benar']++;
                                } elseif ($jawabanKecermatan->pilihan === null) {
                                    $result[$user->id]['nilai']['Kecermatan'][$id_instruksi]['jawaban_kosong']++;
                                } else {
                                    $result[$user->id]['nilai']['Kecermatan'][$id_instruksi]['jawaban_salah']++;
                                }
                                $result[$user->id]['nilai']['Kecermatan'][$id_instruksi]['jumlah_soal']++;
                            } else {
                                // Pertanyaan tidak ditemukan, anggap tidak dijawab
                                $result[$user->id]['nilai']['Kecermatan'][$id_instruksi]['tidak_dijawab']++;
                                $result[$user->id]['nilai']['Kecermatan'][$id_instruksi]['jumlah_soal']++;
                            }
                        }
                    }
                }
            }
        }

        // Hitung nilai ujian untuk setiap jenis soal
        foreach ($result as &$userData) {
            $userData['nilai']['Kecermatan']['jawaban_benar_total'] = 0;
            foreach ($userData['nilai']['Kecermatan'] as $nilai) {
                if (is_array($nilai)) {
                    $userData['nilai']['Kecermatan']['jawaban_benar_total'] += $nilai['jawaban_benar'];
                }
            }
        }

        // Kembalikan view dengan hasil perbandingan jawaban dan nilai ujian
        return view('laporan.index', compact('result'));
    }



    public function detailSoal($id)
    {
        // Ambil user berdasarkan ID
        $user = User::find($id);
        // Ambil semua detail soal
        $detailSoals = DetailSoal::where('status', 'Y')->get();

        // Buat array untuk menyimpan detail soal, kunci jawaban, dan pilihan
        $result = [];

        // Iterasi setiap detail soal
        foreach ($detailSoals as $detailSoal) {
            // Dapatkan paket terkait dengan detail soal ini
            $paket = Paket::find($detailSoal->id_paket);

            // Jika paket ditemukan
            if ($paket) {
                // Dapatkan jenis soal berdasarkan id_paket pada tabel Paket
                $jenis_soal = $paket->jenis;

                // Ambil jawaban yang sesuai dengan detail soal ini dan user ID yang sesuai
                $jawaban = Jawab::where('id_soal', $detailSoal->id)
                    ->where('id_user', $id)
                    ->first();

                // Jika tidak ada jawaban yang sesuai, inisialisasi nilai jawaban menjadi null
                if (!$jawaban) {
                    $jawaban = null;
                }

                // Periksa apakah jawaban benar, salah, atau kosong
                if ($jawaban && $jawaban->pilihan2 === null) {
                    // Jika hanya ada satu pilihan jawaban
                    $benar = ($jawaban->pilihan1 === $detailSoal->kunci_jawaban1) ? 1 : 0;
                } elseif ($jawaban) {
                    // Jika terdapat dua pilihan jawaban
                    $benar = (
                        ($jawaban->pilihan1 === $detailSoal->kunci_jawaban1 || $jawaban->pilihan1 === $detailSoal->kunci_jawaban2) &&
                        ($jawaban->pilihan2 === $detailSoal->kunci_jawaban1 || $jawaban->pilihan2 === $detailSoal->kunci_jawaban2)
                    ) ? 1 : 0;
                } else {
                    // Jika jawaban kosong, maka dianggap salah
                    $benar = 0;
                }

                // Inisialisasi isi jawaban dan pilihan
                $isi_jawaban1 = $detailSoal->getAttribute('pil' . $detailSoal->kunci_jawaban1);
                $isi_jawaban2 = $detailSoal->getAttribute('pil' . $detailSoal->kunci_jawaban2);
                $isi_pilihan1 = $jawaban ? $detailSoal->getAttribute('pil' . $jawaban->pilihan1) : 'Tidak dijawab';
                $isi_pilihan2 = $jawaban ? $detailSoal->getAttribute('pil' . $jawaban->pilihan2) : 'Tidak dijawab';


                if (!$benar || !$jawaban) {
                    // Jika jenis soal sudah ada di dalam $result, tambahkan 1 ke jumlah soal yang salah atau tidak dijawab
                    if (isset($result[$jenis_soal]['jumlah_salah_tidak_dijawab'])) {
                        $result[$jenis_soal]['jumlah_salah_tidak_dijawab']++;
                    } else {
                        // Jika jenis soal belum ada di dalam $result, inisialisasi jumlah soal yang salah atau tidak dijawab menjadi 1
                        $result[$jenis_soal]['jumlah_salah_tidak_dijawab'] = 1;
                    }

                    // Tambahkan detail soal ke dalam array $result
                    $result[$jenis_soal]['soal'][] = [
                        'soal' => $detailSoal->soal,
                        'kunci_jawaban1' => $detailSoal->kunci_jawaban1,
                        'kunci_jawaban2' => $detailSoal->kunci_jawaban2,
                        'isi_jawaban1' => $isi_jawaban1,
                        'isi_jawaban2' => $isi_jawaban2,
                        'pilihan1' => $jawaban ? $jawaban->pilihan1 : null,
                        'pilihan2' => $jawaban ? $jawaban->pilihan2 : null,
                        'isi_pilihan1' => $isi_pilihan1,
                        'isi_pilihan2' => $isi_pilihan2,
                        'nama_user' => $user->name, // Ubah sesuai kolom nama di tabel user
                    ];
                }
            }
        }

        // Kembalikan hasil dalam bentuk array yang di-compact
        return view('laporan.detail', compact('result'));
    }


    public function showLaporan()
    {
        $user_id = auth()->user()->id;

        // Ambil semua detail soal
        $detailSoals = DetailSoal::where('status', 'Y')->get();

        // Buat array untuk menyimpan hasil perbandingan jawaban dan nilai ujian
        $result = [];

        // Inisialisasi jumlah soal kecerdasan dan kepribadian
        $jumlahSoalKecerdasan = 0;
        $jumlahSoalKepribadian = 0;

        // Iterasi setiap detail soal
        foreach ($detailSoals as $detailSoal) {
            // Dapatkan paket terkait dengan detail soal ini
            $paket = Paket::find($detailSoal->id_paket);

            // Jika paket ditemukan
            if ($paket) {
                // Dapatkan jenis soal berdasarkan id_paket pada tabel Paket
                $jenis_soal = $paket->jenis;

                // Inisialisasi jumlah soal berdasarkan jenis
                if ($jenis_soal === 'Kecerdasan') {
                    $jumlahSoalKecerdasan++;
                } elseif ($jenis_soal === 'Kepribadian') {
                    $jumlahSoalKepribadian++;
                }

                if (!isset($result[$user_id])) {
                    $result[$user_id] = [
                        'nilai' => [
                            'Kecerdasan' => ['jawaban_benar' => 0, 'jumlah_soal' => 0],
                            'Kepribadian' => ['jawaban_benar' => 0, 'jumlah_soal' => 0],
                            'Kecermatan' => [],
                        ],
                    ];
                }

                $jawabans = Jawab::where('id_soal', $detailSoal->id)
                    ->where('id_user', $user_id)
                    ->get();
                foreach ($jawabans as $jawaban) {

                    if ($jawaban !== false) {
                        if ($jawaban->pilihan2 === null) {
                            // Jika pilihan2 dari jawaban kosong
                            $benar = ($jawaban->pilihan1 === $detailSoal->kunci_jawaban1) ? 1 : 0;
                        } else {
                            // Jika pilihan2 dari jawaban tidak kosong
                            $benar = (
                                ($jawaban->pilihan1 === $detailSoal->kunci_jawaban1 || $jawaban->pilihan1 === $detailSoal->kunci_jawaban2) &&
                                ($jawaban->pilihan2 === $detailSoal->kunci_jawaban1 || $jawaban->pilihan2 === $detailSoal->kunci_jawaban2)
                            ) ? 1 : 0;
                        }
                    } else {
                        // Jika tidak ada jawaban yang sesuai, inisialisasi nilai jawaban menjadi null
                        $benar = null;
                    }

                    $result[$user_id]['nilai'][$jenis_soal]['jawaban_benar'] += $benar;
                    // Tambahkan jumlah soal ke dalam array result berdasarkan jenis soal
                    $result[$user_id]['nilai'][$jenis_soal]['jumlah_soal']++;
                }
            }
        }

        // Set jumlah soal kecerdasan dan kepribadian pada array $result untuk user
        $result[$user_id]['nilai']['Kecerdasan']['jumlah_soal'] = $jumlahSoalKecerdasan;
        $result[$user_id]['nilai']['Kepribadian']['jumlah_soal'] = $jumlahSoalKepribadian;

        // Ambil semua instruksi yang tersedia dalam tabel Pertanyaan
        $instruksis = Pertanyaan::select('id_instruksi')->where('status', 'Y')->distinct()->get();

        // Iterasi setiap instruksi
        foreach ($instruksis as $instruksi) {
            $id_instruksi = $instruksi->id_instruksi;
            // Ambil pertanyaan berdasarkan instruksi
            $pertanyaansKecermatan = Pertanyaan::where('id_instruksi', $id_instruksi)->where('status', 'Y')->get();

            // Inisialisasi jumlah soal kecermatan
            $jumlah_soal_kecermatan = $pertanyaansKecermatan->count();

            // Set jumlah soal kecermatan pada array $result untuk user dan instruksi
            if (!isset($result[$user_id]['nilai']['Kecermatan'][$id_instruksi])) {
                $result[$user_id]['nilai']['Kecermatan'][$id_instruksi] = [
                    'jawaban_benar' => 0,
                    'jawaban_salah' => 0,
                    'jawaban_kosong' => 0,

                    'jumlah_soal' => $jumlah_soal_kecermatan,
                ];
            }

            // Iterasi setiap pertanyaan kecermatan
            foreach ($pertanyaansKecermatan as $pertanyaan) {
                // Ambil jawaban kecermatan yang sesuai dengan pertanyaan ini
                $jawabanKecermatan = Jawaban_Kecermatan::where('id_pertanyaan', $pertanyaan->id)
                    ->where('id_user', $user_id)
                    ->first();

                // Periksa apakah jawaban ada
                if ($jawabanKecermatan) {
                    // Periksa apakah jawaban benar atau salah
                    $benar = ($jawabanKecermatan->pilihan === $pertanyaan->kunci) ? 1 : 0;

                    // Tambahkan nilai jawaban ke dalam array result untuk user dan instruksi
                    if ($jawabanKecermatan->pilihan === $pertanyaan->kunci) {
                        $result[$user_id]['nilai']['Kecermatan'][$id_instruksi]['jawaban_benar']++;
                    } elseif ($jawabanKecermatan->pilihan === null) {
                        $result[$user_id]['nilai']['Kecermatan'][$id_instruksi]['jawaban_kosong']++;
                    } else {
                        $result[$user_id]['nilai']['Kecermatan'][$id_instruksi]['jawaban_salah']++;
                    }
                } else {
                    // Pertanyaan tidak ditemukan, anggap tidak dijawab
                    $result[$user_id]['nilai']['Kecermatan'][$id_instruksi]['jawaban_kosong']++;
                }
            }
        }

        // Hitung nilai ujian untuk setiap jenis soal
        foreach ($result[$user_id]['nilai'] as $jenis_soal => &$nilai) {
            if (isset($nilai['jumlah_soal']) && $nilai['jumlah_soal'] > 0) {
                $nilai['nilai'] = number_format(($nilai['jawaban_benar'] / $nilai['jumlah_soal']) * 100, 2);
            } else {
                $nilai['nilai'] = 0;
            }
        }

        // Kembalikan view dengan hasil perbandingan jawaban dan nilai ujian
        return view('ujian.laporan', compact('result'));
    }

    public function destroy($id)
    {

        // Hapus data dari tabel "jawab"
        $jawab = Jawab::where('id_user', $id)->delete();

        // Hapus data dari tabel "jawaban_kecermatan"
        $jawabanKecer = Jawaban_Kecermatan::where('id_user', $id)->delete();
        if ($jawab && $jawabanKecer) {
            return response()->json(
                ['success' => 'Data Ujian Berhasil di hapus']
            );
        } else {
            return response()->json(
                ['success' => 'Data Ujian Tidak Berhasil di hapus']
            );
        }
    }
}
