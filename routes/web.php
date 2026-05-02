<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nabil', function () {
    return response()->json([
        'message' => 'Hello nabil al fadila',
        'status' => 'success'
        ]);
});