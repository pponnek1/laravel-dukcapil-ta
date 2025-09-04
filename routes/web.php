<?php

use Illuminate\Support\Facades\Route;
use App\Models\Antrian;

use App\Http\Controllers\testController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DaftarAntrianController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AntrianstoreController;
use App\Http\Controllers\LaporanController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/daftar-antrian', [DaftarAntrianController::class, 'index'])->name('daftar-antrian.index');
Route::get('/daftar-antrian/{antrian:slug}', [DaftarAntrianController::class, 'show'])->name('daftar-antrian.show');

Route::get('/antrian', [AntrianController::class, 'index'])->name('antrian.index');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/antrian/create/{id}', [AntrianController::class, 'create']);
    Route::POST('/antrian', [AntrianController::class, 'store'])->name('store.antrian');
    Route::get('/antrian/detail', [AntrianController::class, 'detail']);
    Route::DELETE('/antrian/detail/{id}', [AntrianController::class, 'destroy']);
    Route::get('/antrian/kode-antrian/{id}', [AntrianController::class, 'cetakKodeAntrian']);

    Route::get('/panggil-antrian/{id}', [AntrianStoreController::class, 'panggilAntrian'])->name('panggil.antrian');
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export-pdf');

});

