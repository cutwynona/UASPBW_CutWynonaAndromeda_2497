<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminConcertController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\ProfileController;

// Redirect ke login
Route::get('/', fn() => redirect()->route('login'));

// Auth Routes (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Customer Routes
Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Konser & Tiket
    Route::get('/concerts',                  [ConcertController::class, 'index'])->name('concerts.index');
    Route::get('/concerts/{concert}',        [ConcertController::class, 'show'])->name('concerts.show');

    // Order
    Route::get('/orders/create/{concert}',  [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders',                  [OrderController::class, 'store'])->name('orders.store');

    // Tickets
    Route::get('/tickets',                  [OrderController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{order}',          [OrderController::class, 'show'])->name('tickets.show');
    Route::patch('/tickets/{order}/cancel', [OrderController::class, 'cancel'])->name('tickets.cancel');

    // TAMBAHKAN RUTE INI UNTUK DOWNLOAD PDF
    Route::get('/tickets/{id}/download',    [OrderController::class, 'downloadTicket'])->name('tickets.download');

    // Route Pembayaran
    Route::patch('/tickets/{order}/pay', [OrderController::class, 'processPayment'])->name('tickets.pay');
});

// Admin Routes
Route::middleware(['auth','is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',                [AdminController::class, 'dashboard'])->name('dashboard');

    // Admin Konser
    Route::get('/concerts',                 [AdminConcertController::class, 'index'])->name('concerts.index');
    Route::get('/concerts/create',          [AdminConcertController::class, 'create'])->name('concerts.create');
    Route::post('/concerts',                [AdminConcertController::class, 'store'])->name('concerts.store');
    Route::get('/concerts/{concert}/edit',    [AdminConcertController::class, 'edit'])->name('concerts.edit');
    Route::put('/concerts/{concert}',        [AdminConcertController::class, 'update'])->name('concerts.update');
    Route::delete('/concerts/{concert}',     [AdminConcertController::class, 'destroy'])->name('concerts.destroy');

    // Admin Orders
    Route::get('/orders',                   [AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status',    [AdminOrderController::class, 'updateStatus'])->name('orders.status');
    Route::patch('/orders/{order}/confirm',   [AdminOrderController::class, 'confirmPayment'])->name('orders.confirm');

    // Admin Users
    Route::get('/users',                    [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{user}',          [AdminController::class, 'deleteUser'])->name('users.delete');
});
