<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AulaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('authenticated.dashboard');
    Route::post('/aulas/{aula}/presenca', [DashboardController::class, 'marcarPresenca'])->name('aulas.presenca');
    Route::post('/aulas/{aula}/falta', [DashboardController::class, 'marcarFalta'])->name('aulas.falta');

    Route::post('/logout', [AuthController::class, 'logout'])->name('authenticated.logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
        ->name('admin.login');

    Route::post('/admin/login', [AdminAuthController::class, 'login'])
        ->name('admin.login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/aulas', [AulaController::class, 'index'])->name('admin.aulas.index');
    Route::post('/admin/aulas', [AulaController::class, 'store'])->name('admin.aulas.store');
});
