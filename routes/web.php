<?php

use App\Http\Controllers\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.admin');
});

// bagian login user
Route::get('/login', [Login::class,'index']);
Route::post('/validate', [Login::class,'Validasi_login']);



// bagian registrasi user
Route::get('/register', [Login::class,'register']);
Route::post('/registered', [Login::class,'registered']);


