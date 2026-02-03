<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('/admin', function (){
        return 'admin page';
    })->name('admin');
});

Route::middleware(['auth', 'role:kasir'])->group(function (){
    Route::get('/kasir', function (){
        return 'kasir page';
    })->name('kasir');
});

Route::middleware(['auth', 'role:pekerja'])->group(function (){
    Route::get('/pekerja', function (){
        return 'pekerja page';
    })->name('pekerja');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
