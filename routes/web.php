<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\UjianController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\RouteGroup;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');



Route::group(['prefix' => 'ujian'], function () {
    Route::get('/index', [UjianController::class, 'index'])->name('peserta');
    Route::get('/kecerdasan', [UjianController::class, 'detailSoalKecerdasan'])->name('kecerdasan');
    Route::get('/get-soal', [UjianController::class, 'getSoal']);
    Route::post('simpan-jawaban', [UjianController::class, 'simpanJawaban']);
    Route::get('/laporan', [LaporanController::class, 'show-siswa'])->name('laporan-siswa');
    Route::group(['prefix' => 'kepribadian'], function () {
        Route::get('/index',  [UjianController::class, 'detailSoalKepribadian']);
        Route::get('/get-soal', [UjianController::class, 'getSoalKepribadian']);
        Route::post('/simpan-jawaban', [UjianController::class, 'simpanJawabanKepribadian']);
    });
});
// Route::group(['prefix' => 'laporan'], function () {
//     Route::get('/index', [LaporanController::class, 'show'])->name('laporan-siswa');
// });





Route::group(['prefix' => 'siswa', 'middleware' => 'auth'], function () {
    Route::get('/index', [UserController::class, 'index'])->name('siswa');
    Route::get('/tambah-siswa', [UserController::class, 'create'])->name('tambah-siswa');
    Route::post('/', [UserController::class, 'store'])->name('simpan-siswa');
    Route::get('/edit_siswa/{id}', [UserController::class, 'show'])->name('detail-siswa');
    Route::post('/siswa-update/{id}', [UserController::class, 'edit'])->name('edit_siswa');
    Route::get('/siswa-delete/{id}', [UserController::class, 'destroy'])->name('siswa-delete');
});

Route::group(['prefix' => 'soal', 'middleware' => 'auth'], function () {
    Route::get('/index', [PaketController::class, 'index'])->name('soal');
    Route::get('/edit-paket/{id}', [PaketController::class, 'show']);
    Route::post('/update-paket/{id}', [PaketController::class, 'edit']);
    Route::get('/detailSoal/{id}', [SoalController::class, 'index'])->name('detailSoal');

    Route::get('/aksi/edit/{id}', [SoalController::class, 'show']);
    Route::post('/aksi/edit', [SoalController::class, 'edit'])->name('edit-soal');
    Route::delete('/delete-soal/{id}', [SoalController::class, 'delete'])->name('hapus-soal');

    Route::group(['prefix' => 'kepribadian'], function () {
        Route::post('/index', [SoalController::class, 'storeKepribadian']);
        Route::get('/edit/{id}', [SoalController::class, 'showKepribadian']);
        Route::post('/update', [SoalController::class, 'updateKepribadian']);
    });

    Route::group(['prefix' => 'kecermatan'], function () {
        Route::post('/index', [SoalController::class, 'storeKecermatan']);
        Route::delete('/delete-soal/{id}', [SoalController::class, 'deleteKecermatan']);
    });
    Route::group(['prefix' => 'aksi'], function () {
        Route::get('/edit/{id}', [SoalController::class, 'show']);
    });
});

// Route::post('soal/kepribadian/index',  [SoalController::class, 'storeKepribadian']);
// Route::post('soal/detail-soal', [SoalController::class, 'store'])->name('simpan_soal');
