<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/loginProcess', [LoginController::class, 'loginProcess'])->name('login.process');

Route::get('admin/dashboard', function () {
        return view('admin.dashboard.dashboard');
})->name('admin.dashboard.dashboard');