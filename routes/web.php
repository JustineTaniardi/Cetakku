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
    // Main ===
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Order Routes
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::put('/order/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
    
    // Order Status Updates
    Route::put('/order/{id}/status', [OrderController::class, 'updateStatus'])->name('order.update-status');
    Route::put('/order/{id}/payment', [OrderController::class, 'updatePayment'])->name('order.update-payment');

    
    // Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    
    // Products ===
    // Product Routes
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    
    // Product Material Routes
    Route::post('/product/{id}/material', [ProductController::class, 'addMaterial'])->name('product.material.add');
    Route::put('/product/{productId}/material/{materialId}', [ProductController::class, 'updateMaterial'])->name('product.material.update');
    Route::delete('/product/{productId}/material/{materialId}', [ProductController::class, 'deleteMaterial'])->name('product.material.delete');

    
    
    // Category & Unit Routes
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    
    // Category CRUD
    Route::post('/category', [CategoryController::class, 'storeCategory'])->name('category.store');
    Route::put('/category/{id}', [CategoryController::class, 'updateCategory'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'destroyCategory'])->name('category.destroy');
    
    // Unit CRUD
    Route::post('/unit', [CategoryController::class, 'storeUnit'])->name('unit.store');
    Route::put('/unit/{id}', [CategoryController::class, 'updateUnit'])->name('unit.update');
    Route::delete('/unit/{id}', [CategoryController::class, 'destroyUnit'])->name('unit.destroy');
    
    // Operations ===
    Route::get('/job', [JobController::class, 'index'])->name('job');
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    
    // Supply ===
     // Supplier Routes
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/{id}', [SupplierController::class, 'show'])->name('supplier.show');
    Route::put('/supplier/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    
    // Supplier Material Routes
    Route::post('/supplier/{id}/material', [SupplierController::class, 'addMaterial'])->name('supplier.material.add');
    Route::put('/supplier/{supplierId}/material/{materialId}', [SupplierController::class, 'updateMaterial'])->name('supplier.material.update');
    Route::delete('/supplier/{supplierId}/material/{materialId}', [SupplierController::class, 'deleteMaterial'])->name('supplier.material.delete');


    // Material Routes
    Route::get('/material', [MaterialController::class, 'index'])->name('material');
    Route::post('/material', [MaterialController::class, 'store'])->name('material.store');
    Route::get('/material/{id}', [MaterialController::class, 'show'])->name('material.show');
    Route::put('/material/{id}', [MaterialController::class, 'update'])->name('material.update');
    Route::delete('/material/{id}', [MaterialController::class, 'destroy'])->name('material.destroy');
    
    // Material Supplier Routes
    Route::post('/material/{id}/supplier', [MaterialController::class, 'addSupplier'])->name('material.supplier.add');
    Route::put('/material/{materialId}/supplier/{supplierId}', [MaterialController::class, 'updateSupplier'])->name('material.supplier.update');
    Route::delete('/material/{materialId}/supplier/{supplierId}', [MaterialController::class, 'deleteSupplier'])->name('material.supplier.delete');

    
    // Finance ===
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