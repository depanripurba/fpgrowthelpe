<?php

use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('layout.admin');
});

Route::get('/', function () {
    return view('login');
});

