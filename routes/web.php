<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});


Route::get('/deals', function () {
    return view('deals');
});
