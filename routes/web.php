<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaketController;
use Illuminate\Routing\Route as RoutingRoute;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/ujian', function () {
    return view('ujian.kecerdasan');
});

// Route::group(['prefix'=>'soal'],function(){

// })


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
    Route::get('/detailSoal/{id}', [SoalController::class, 'index']);
    Route::post('/detailSoal', [SoalController::class, 'store'])->name('simpan-soal');
    Route::get('/aksi/edit/{id}', [SoalController::class, 'show']);
    Route::post('/aksi/edit', [SoalController::class, 'edit'])->name('edit-soal');
    Route::delete('/delete-soal/{id}', [SoalController::class, 'delete'])->name('hapus-soal');

    // Route::group(['prefix' => 'aksi'], function () {
    //     Route::get('/edit/{id}', [SoalController::class, 'show']);
    // });
});
