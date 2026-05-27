<?php

use App\Http\Controllers\Login;
use App\Http\Controllers\ProdukController;
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
    Route::get('/produk', [ProdukController::class, 'index']);
    Route::get('/tambahproduk', [ProdukController::class, 'tambahproduk']);
    Route::POST('/tambahkankedb', [ProdukController::class, 'Tambahkankedb']);

    // Tambahkan route lainnya di sini...
});
