<?php

use App\Http\Controllers\Login;
use Illuminate\Support\Facades\Route;

// bagian login user
Route::get('/login', [Login::class, 'index'])->name('login');
Route::post('/validate', [Login::class, 'Validasi_login']);

// bagian registrasi user
Route::get('/register', [Login::class, 'register']);
Route::post('/registered', [Login::class, 'registered']);

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('layout.admin');
    });
    Route::get('/logout', [Login::class, 'logout']);

    // Tambahkan route lainnya di sini...
});
