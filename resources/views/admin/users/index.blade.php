@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="min-h-screen py-8 px-4">
    
    <!-- Header -->
    <div class="max-w-6xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Manajemen User</h1>
            <p class="text-gray-500 mt-1 text-sm">Kelola akun pengguna sistem aplikasi e-learning</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="openModal('modalFilter')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-filter"></i> Filter
            </button>
            <button onclick="openModal('modalExport')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-download"></i> Export
            </button>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center gap-2 gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all shadow-md">
                <i class="fas fa-plus"></i> Tambah User
            </a>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        
        <!-- Total Users -->
        <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total User</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_users }}</p>
                    <p class="text-xs text-green-600 mt-2">
                        <i class="fas fa-arrow-up"></i> 12 dari bulan lalu
                    </p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-primary-100 flex items-center justify-center">
                    <i class="fas fa-users text-primary-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Admin -->
        <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Administrator</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_admin }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center">
                    <i class="fas fa-user-shield text-red-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Guru -->
        <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Guru</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_guru }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-chalkboard-teacher text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Siswa -->
        <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Siswa</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_siswa }}</p>
                </div>
                <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                    <i class="fas fa-user-graduate text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        
    </div>
    
    <!-- Content Card -->
    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden">
        
        <!-- Search Bar -->
        <div class="p-6 border-b bg-gray-50">
            <div class="flex flex-col lg:flex-row gap-4">
                
                <!-- Search Input -->
                <div class="flex-1 relative">
                    <input type="text" placeholder="Cari berdasarkan nama, username, atau email..." 
                            class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
                
                <!-- Filters -->
                <div class="flex flex-wrap gap-3">
                    
                    <!-- Filter Role -->
                    <select id="filterRole" onchange="applyFilters()" class="px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                        <option value="">Semua Role</option>
                        <option value="admin">Administrator</option>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                        <option value="staff">Staff</option>
                    </select>
                    
                    <!-- Filter Status -->
                    <select id="filterStatus" onchange="applyFilters()" class="px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Tidak Aktif</option>
                    </select>
                    
                    <!-- Sort -->
                    <select id="filterSort" onchange="applyFilters()" class="px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                        <option value="">Urutkan...</option>
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                        <option value="az">A-Z</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left w-16">
                            <input type="checkbox" class="rounded">
                        </th>
                        <th scope="col" class="px-6 py-4 text-left">Nama Lengkap</th>
                        <th scope="col" class="px-6 py-4 text-left">Username</th>
                        <th scope="col" class="px-6 py-4 text-left">Email</th>
                        <th scope="col" class="px-6 py-4 text-left">Role</th>
                        <th scope="col" class="px-6 py-4 text-left">Status</th>
                        <th scope="col" class="px-6 py-4 text-left">Terdaftar</th>
                        <th scope="col" class="px-6 py-4 text-center hidden lg:table-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        
                        <td class="px-6 py-4">
                            <input type="checkbox" class="rounded" value="{{ $user->id_user }}">
                        </td>
                        
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $user->nama_lengkap }}</p>
                                    <p class="text-xs text-gray-500 hidden sm:block">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 font-mono text-gray-700">{{ $user->username }}</td>
                        
                        <td class="px-6 py-4 text-gray-700 hidden md:table-cell">{{ $user->email }}</td>
                        
                        <td class="px-6 py-4">
                            @if(($user->nama_role) == 'Admin')
                                <span class="badge badge-admin">
                                    <i class="fas fa-user-shield"></i> Administrator
                                </span>
                            @elseif(($user->nama_role) == 'Guru')
                                <span class="badge badge-guru">
                                    <i class="fas fa-chalkboard-teacher"></i> Guru
                                </span>
                            @else
                                <span class="badge badge-siswa">
                                    <i class="fas fa-user-graduate"></i> Siswa
                                </span>
                            @endif
                        </td>
                        
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center">
                                @if(($user->status) == 'Aktif')
                                    <span class="status-dot status-active bg-green-500"></span> <span class="text-xs text-gray-600 hidden sm:inline ml-1">Aktif</span>
                                @else
                                    <span class="status-dot status-inactive bg-red-500"></span>
                                    <span class="text-xs text-gray-600 hidden sm:inline ml-1">Tidak Aktif</span>
                                @endif
                            </span>
                        </td>
                        
                        <td class="px-6 py-4 text-gray-600 text-xs">
                            {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('d M Y') }}
                        </td>
                        
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-2">
                                <a href="" class="inline-flex items-center justify-center w-9 h-9 text-blue-500 hover:text-blue-700 rounded hover:bg-blue-50 transition-colors" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id_user) }}" class="inline-flex items-center justify-center w-9 h-9 text-yellow-500 hover:text-yellow-700 rounded hover:bg-yellow-50 transition-colors" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                    <button onclick="confirmDelete('{{ route('admin.users.destroy', $user->id_user) }}')" class="inline-flex items-center justify-center w-9 h-9 text-red-500 hover:text-red-700 rounded hover:bg-red-50 transition-colors" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                            </div>
                        </td>
                    </tr>
                    
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                            Belum ada data pengguna yang ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-6 border-t">
            <p class="text-sm text-gray-600">
                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">156</span> data
            </p>
            <div class="flex items-center gap-2">
                <button disabled class="btn-pagination-disabled px-4 py-2 rounded-lg border">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn">...</button>
                <button class="pagination-btn">16</button>
                <button class="btn-pagination-active px-4 py-2 rounded-lg border">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@include('layouts.partials.modal.delete')

@push('scripts')
    @vite([
        'resources/js/modal.js',
    ])
@endpush
    
    <style>
        .icon-btn {
            @apply p-2 rounded-lg transition-colors;
        }
        .icon-btn:hover {
            @apply bg-gray-100;
        }
        .icon-btn.icon-view:hover {
            @apply bg-blue-50 text-blue-600;
        }
        .icon-btn.icon-edit:hover {
            @apply bg-yellow-50 text-yellow-600;
        }
        .icon-btn.icon-delete:hover {
            @apply bg-red-50 text-red-600;
        }
        .pagination-btn {
            @apply w-8 h-8 flex items-center justify-center rounded-lg text-sm font-medium transition-colors;
        }
        .pagination-btn:hover {
            @apply bg-gray-100;
        }
        .pagination-btn.active {
            @apply bg-primary-500 text-white;
        }
        .btn-pagination-active:hover {
            @apply bg-primary-600 text-white;
        }
        .btn-pagination-disabled {
            @apply opacity-50 cursor-not-allowed;
        }
    </style>
    