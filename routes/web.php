<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\RaporController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/auth', function () {
    return view('auth.login');
});

// Login Routes
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/loginProcess', [LoginController::class, 'loginProcess'])->name('login.process');
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
// Admin Dashboard Routes
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
Route::get('admin/pengumuman', [PengumumanController::class, 'index'])->name('admin.pengumuman.index');
Route::get('admin/rapor', [RaporController::class, 'index'])->name('admin.rapor.index');

// Admin Guru Routes
Route::get('admin/guru/dashboard', [DashboardGuruController::class, 'index'])->name('admin.guru.dashboard.index');
Route::get('admin/guru/data', [DataGuruController::class, 'index'])->name('admin.guru.data.index');
Route::get('admin/guru/data/autofill', [DataGuruController::class, 'autofill'])->name('admin.guru.data.autofill');
Route::get('admin/guru/data/create', [DataGuruController::class, 'create'])->name('admin.guru.data.create');
Route::get('admin/guru/data/edit/{nip}', [DataGuruController::class, 'edit'])->name('admin.guru.data.edit');
Route::post('admin/guru/data/store', [DataGuruController::class, 'store'])->name('admin.guru.data.store');
Route::put('admin/guru/data/update/{nip}', [DataGuruController::class, 'update'])->name('admin.guru.data.update');
Route::delete('admin/guru/data/{nip}', [DataGuruController::class, 'destroy'])->name('admin.guru.data.destroy');
Route::get('admin/guru/jadwal', [JadwalGuruController::class, 'index'])->name('admin.guru.jadwal.index');
Route::get('admin/guru/absensi', [AbsensiGuruController::class, 'index'])->name('admin.guru.absensi.index');

// Admin Siswa Routes
Route::get('admin/siswa/dashboard', [DashboardSiswaController::class, 'index'])->name('admin.siswa.dashboard.index');
Route::get('admin/siswa/data', [DataSiswaController::class, 'index'])->name('admin.siswa.data.index');
Route::get('admin/siswa/data/autofill', [DataSiswaController::class, 'autofill'])->name('admin.siswa.data.autofill');
Route::get('admin/siswa/data/create', [DataSiswaController::class, 'create'])->name('admin.siswa.data.create');
Route::get('admin/siswa/data/edit/{nis}', [DataSiswaController::class, 'edit'])->name('admin.siswa.data.edit');
Route::post('admin/siswa/data/store', [DataSiswaController::class, 'store'])->name('admin.siswa.data.store');
Route::put('admin/siswa/data/update/{nis}', [DataSiswaController::class, 'update'])->name('admin.siswa.data.update');
Route::delete('admin/siswa/data/{nis}', [DataSiswaController::class, 'destroy'])->name('admin.siswa.data.destroy');
Route::get('admin/siswa/jadwal', [JadwalSiswaController::class, 'index'])->name('admin.siswa.jadwal.index');
Route::get('admin/siswa/absensi', [AbsensiSiswaController::class, 'index'])->name('admin.siswa.absensi.index');

// Admin Kelas Routes
Route::get('admin/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
Route::get('admin/kelas/create', [KelasController::class, 'create'])->name('admin.kelas.create');
Route::get('admin/kelas/edit/{id_kelas}', [KelasController::class, 'edit'])->name('admin.kelas.edit');
Route::post('admin/kelas/store', [KelasController::class, 'store'])->name('admin.kelas.store');
Route::put('admin/kelas/update/{id_kelas}', [KelasController::class, 'update'])->name('admin.kelas.update');
Route::delete('admin/kelas/{id_kelas}', [KelasController::class, 'destroy'])->name('admin.kelas.destroy');

// Admin Users Routes
Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::get('admin/users/edit/{id_user}', [UserController::class, 'edit'])->name('admin.users.edit');
Route::post('admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
Route::put('admin/users/update/{id_user}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('admin/users/{id_user}', [UserController::class, 'destroy'])->name('admin.users.destroy');