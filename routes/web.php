<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail', function() {
    return view('emails.order');
});

Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');

Route::get('/dashboard', [OrderController::class, 'dashboard'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'admin'])->middleware('role:admin')->name('admin');
    Route::get('/admin/view', [AdminController::class, 'view'])->middleware('role:admin')->name('view');
    Route::get('/customer', [OrderController::class, 'index'])->middleware('role:customer')->name('customer.index');
    Route::get('/customer/create', [OrderController::class, 'create'])->name('customer.create');
    Route::post('/customer', [OrderController::class, 'store'])->name('customer.store');
    Route::get('/customer/{order}/edit', [OrderController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/{order}', [OrderController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{order}', [OrderController::class, 'destroy'])->name('customer.destroy');

});

require __DIR__.'/auth.php';
