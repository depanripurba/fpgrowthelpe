<?php

use App\Http\Controllers\Fpgrowth;
use App\Http\Controllers\Login;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiControler;
use Illuminate\Support\Facades\Route;

// bagian login user
Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/validate', [Login::class, 'Validasi_login']);

// bagian registrasi user
Route::get('/register', [Login::class, 'register']);
Route::post('/registered', [Login::class, 'registered']);

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('layout.dasboard');
    });
    Route::get('/logout', [Login::class, 'logout']);
    // start bagian halaman produk
    Route::get('/produk', [ProdukController::class, 'index']);
    Route::get('/tambahproduk', [ProdukController::class, 'tambahproduk']);
    Route::POST('/tambahkankedb', [ProdukController::class, 'Tambahkankedb']);
    Route::get('/editproduk/{id}', [ProdukController::class, 'Editproduk']);
    Route::post('/updateproduk', [ProdukController::class, 'Updatedata']);
    Route::get('/hapusdataproduk/{id}', [ProdukController::class, 'hapusdataproduk']);
    // end dari halaman produk

    // start halaman transaksi
    Route::get('/transaksi', [TransaksiControler::class, 'index']);
    Route::get('/tambahtransaksi', [TransaksiControler::class, 'Tambahtransaksi']);
    Route::post('/tambahkantrankedb', [TransaksiControler::class, 'Tambahkankedb']);
    Route::get('/editdatatransaksi/{id}', [TransaksiControler::class, 'Edittransaksi']);
    Route::post('/updatetransaksi', [TransaksiControler::class, 'Updatedata']);
    Route::get('/hapusdatatransaksi/{id}', [TransaksiControler::class, 'hapusdatatransaksi']);
    // end halaman transaksi

    // start bagian itemset
    Route::get('/frekuensiitemset', [Fpgrowth::class, 'index']);
    // end bagian itemset

});
