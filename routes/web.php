<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kasir\DashboardController as KasirDashboard;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:admin'])->group(function (){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

Route::middleware(['auth', 'role:kasir'])->group(function (){
    Route::get('/kasir', [KasirDashboard::class, 'index'] )->name('kasir.dashboard');
});

Route::middleware(['auth', 'role:pekerja'])->group(function (){
    Route::get('/pekerja', function (){
        return 'pekerja page';
    })->name('pekerja');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
