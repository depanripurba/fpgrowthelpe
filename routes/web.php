<?php

use App\Http\Controllers\RegisterControler;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('layout.admin');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterControler::class,'index']);

