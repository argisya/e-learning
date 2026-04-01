@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-500 mt-1">Selamat datang kembali,</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="px-4 py-2 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                <i class="fas fa-download mr-2"></i>Export
            </button>
            <button class="px-4 py-2 gradient-bg text-white rounded-xl hover:shadow-lg transition-all-300">
                <i class="fas fa-plus mr-2"></i>Tambah Baru
            </button>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Siswa</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">1,234</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
                    </p>
                </div>
                <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-user-graduate text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Guru</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">56</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up"></i> 3% dari bulan lalu
                    </p>
                </div>
                <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Card 3 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Kelas Aktif</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">24</p>
                    <p class="text-xs text-gray-500 mt-2">
                        <i class="fas fa-minus"></i> Stabil
                    </p>
                </div>
                <div class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center">
                    <i class="fas fa-school text-orange-600 text-2xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Card 4 -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Pengumuman</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">8</p>
                    <p class="text-xs text-red-600 mt-2">
                        <i class="fas fa-circle text-xs"></i> 3 Baru
                    </p>
                </div>
                <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center">
                    <i class="fas fa-bullhorn text-red-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activity (2 columns) -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-800">Aktivitas Terbaru</h2>
                <a href="#" class="text-sm text-primary-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="p-6 space-y-4">
                <!-- Activity Item -->
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-book text-blue-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Tugas Matematika Ditambahkan</p>
                        <p class="text-xs text-gray-500">Kelas 9A - Bab 5: Aljabar Linear</p>
                        <p class="text-xs text-gray-400 mt-1">2 jam yang lalu</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check-circle text-green-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Nilai Ujian Diterbitkan</p>
                        <p class="text-xs text-gray-500">Ujian Tengah Semester - IPA</p>
                        <p class="text-xs text-gray-400 mt-1">5 jam yang lalu</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-orange-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-video text-orange-600"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Live Session Dimulai</p>
                        <p class="text-xs text-gray-500">Bahasa Inggris - Speaking Class</p>
                        <p class="text-xs text-gray-400 mt-1">Kemarin</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Upcoming Schedule (1 column) -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-bold text-gray-800">Jadwal Hari Ini</h2>
                <a href="#" class="text-sm text-primary-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="p-6 space-y-4">
                <!-- Schedule Item -->
                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                    <div class="text-center">
                        <p class="text-xs text-gray-500">07:00</p>
                        <p class="text-xs text-gray-400">WIB</p>
                    </div>
                    <div class="w-1 h-12 bg-primary-500 rounded-full"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Matematika</p>
                        <p class="text-xs text-gray-500">Ruang 101 - Pak Ahmad</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                    <div class="text-center">
                        <p class="text-xs text-gray-500">09:00</p>
                        <p class="text-xs text-gray-400">WIB</p>
                    </div>
                    <div class="w-1 h-12 bg-green-500 rounded-full"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">Bahasa Indonesia</p>
                        <p class="text-xs text-gray-500">Ruang 102 - Bu Siti</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                    <div class="text-center">
                        <p class="text-xs text-gray-500">11:00</p>
                        <p class="text-xs text-gray-400">WIB</p>
                    </div>
                    <div class="w-1 h-12 bg-orange-500 rounded-full"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">IPA</p>
                        <p class="text-xs text-gray-500">Lab IPA - Pak Budi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection