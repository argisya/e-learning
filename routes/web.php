 <?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('auth.login');
});

// Login Routes
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard.dashboard');
Route::post('/loginProcess', [LoginController::class, 'loginProcess'])->name('login.process');