 <?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\RaporController;

// Admin Guru Controller
use App\Http\Controllers\Admin\Guru\AbsensiGuruController;
use App\Http\Controllers\Admin\Guru\DashboardGuruController;
use App\Http\Controllers\Admin\Guru\DataGuruController;
use App\Http\Controllers\Admin\Guru\JadwalGuruController;

// Admin Siswa Controller
use App\Http\Controllers\Admin\Siswa\AbsensiSiswaController;
use App\Http\Controllers\Admin\Siswa\DashboardSiswaController;
use App\Http\Controllers\Admin\Siswa\DataSiswaController;
use App\Http\Controllers\Admin\Siswa\JadwalSiswaController;

// Admin Users Controller
use App\Http\Controllers\Admin\UserController;

Route::get('/auth', function () {
    return view('auth.login');
});

//testing
Route::get('/admin/guru/data/create', function () {
    return view('admin.guru.data.create');
});
Route::get('/admin/guru/data/edit', function () {
    return view('admin.guru.data.edit');
});

// Login Routes
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/loginProcess', [LoginController::class, 'loginProcess'])->name('login.process');
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
// Admin Dashboard Routes
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
Route::get('admin/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
Route::get('admin/pengumuman', [PengumumanController::class, 'index'])->name('admin.pengumuman.index');
Route::get('admin/rapor', [RaporController::class, 'index'])->name('admin.rapor.index');

// Admin Guru Routes
Route::get('admin/guru/dashboard', [DashboardGuruController::class, 'index'])->name('admin.guru.dashboard.index');
Route::get('admin/guru/data', [DataGuruController::class, 'index'])->name('admin.guru.data.index');
Route::get('admin/guru/data/create', [DataGuruController::class, 'create'])->name('admin.guru.data.create');
Route::get('admin/guru/data/edit/{nip}', [DataGuruController::class, 'edit'])->name('admin.guru.data.edit');
Route::get('admin/guru/jadwal', [JadwalGuruController::class, 'index'])->name('admin.guru.jadwal.index');
Route::get('admin/guru/absensi', [AbsensiGuruController::class, 'index'])->name('admin.guru.absensi.index');

// Admin Siswa Routes
Route::get('admin/siswa/dashboard', [DashboardSiswaController::class, 'index'])->name('admin.siswa.dashboard.index');
Route::get('admin/siswa/data', [DataSiswaController::class, 'index'])->name('admin.siswa.data.index');
Route::get('admin/siswa/jadwal', [JadwalSiswaController::class, 'index'])->name('admin.siswa.jadwal.index');
Route::get('admin/siswa/absensi', [AbsensiSiswaController::class, 'index'])->name('admin.siswa.absensi.index');

// Admin Users Routes
Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::get('admin/users/edit/{id_user}', [UserController::class, 'edit'])->name('admin.users.edit');
Route::post('admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
Route::post('admin/users/update/{id_user}', [UserController::class, 'update'])->name('admin.users.update');
Route::post('admin/users/delete/{id_user}', [UserController::class, 'destroy'])->name('admin.users.destroy');