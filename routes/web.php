<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;

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
    Route::get('/dashboard', function () {
        return view('authenticated.dashboard');
    })->name('authenticated.dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('authenticated.logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
        ->name('admin.login');

    Route::post('/admin/login', [AdminAuthController::class, 'login'])
        ->name('admin.login.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/admin/aulas', function () {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        return view('admin.aulas.index');
    })->name('admin.aulas.index');
});
