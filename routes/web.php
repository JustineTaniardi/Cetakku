<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
<<<<<<< Updated upstream
=======

Route::middleware(['auth', 'role:kasir'])->group(function (){
    Route::get('/kasir', )->name('kasir');
});

Route::middleware(['auth', 'role:pekerja'])->group(function (){
    Route::get('/pekerja', function (){
        return 'pekerja page';
    })->name('pekerja');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
>>>>>>> Stashed changes
