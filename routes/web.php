<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kasir\DashboardController;
use App\Http\Controllers\Kasir\OrderController;
use App\Http\Controllers\Kasir\CustomerController;
use App\Http\Controllers\Kasir\ProductController;
use App\Http\Controllers\Kasir\CategoryController;
use App\Http\Controllers\Kasir\JobController;
use App\Http\Controllers\Kasir\InvoiceController;
use App\Http\Controllers\Kasir\PaymentController;
use App\Http\Controllers\Kasir\SupplierController;
use App\Http\Controllers\Kasir\MaterialController;
use App\Http\Controllers\Kasir\ReceivableController;
use App\Http\Controllers\Kasir\DebtController;
use App\Http\Controllers\Kasir\OmsetController;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

// Kasir Routes
Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    // Main
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Orders 
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    
    // Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    
    // Products
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    
    // Operations
    Route::get('/job', [JobController::class, 'index'])->name('job');
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    
    // Supply
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::get('/material', [MaterialController::class, 'index'])->name('material');
    
    // Finance
    Route::get('/receivable', [ReceivableController::class, 'index'])->name('receivable');
    Route::get('/debt', [DebtController::class, 'index'])->name('debt');
    Route::get('/omset', [OmsetController::class, 'index'])->name('omset');
});

// Pekerja Routes
Route::middleware(['auth', 'role:pekerja'])->group(function () {
    Route::get('/pekerja', function () {
        return 'pekerja page';
    })->name('pekerja');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');