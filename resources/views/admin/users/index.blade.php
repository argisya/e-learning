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
                        <th scope="col" class="px-6 py-4 text-right hidden lg:table-cell">Aksi</th>
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
                        
                        <td class="px-6 py-4 text-right hidden lg:table-cell">
                            <div class="flex items-center justify-end gap-2">
                                <button 
                                class="icon-btn icon-edit" 
                                onclick="window.location.href=`{{ route('admin.users.edit', $user->id_user) }}`"
                                title="Edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="icon-btn icon-delete" onclick="confirmDelete({{ $user->id_user }})" title="Hapus">
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
    
    <!-- ================= MODALS ================= -->
    
    <!-- Modal View Detail -->
    <div id="modalView1" class="modal fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75" onclick="closeModal('modalView1')"></div>
            <div class="relative bg-white rounded-xl max-w-md w-full mx-4">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Detail User</h3>
                    <button onclick="closeModal('modalView1')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                        <img src="{{ asset('images/avatar.jpg') }}" alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 border-primary-100">
                        <div>
                            <h4 class="text-xl font-bold text-gray-800">Admin Utama</h4>
                            <span class="badge badge-admin">Administrator</span>
                            <p class="text-xs text-gray-400 mt-1">ID: ADM001</p>
                        </div>
                    </div>
                    <dl class="space-y-4 text-sm">
                        <div class="grid grid-cols-2 gap-4">
                            <dt class="font-medium text-gray-500">Username</dt>
                            <dd class="text-gray-800">admin</dd>
                            
                            <dt class="font-medium text-gray-500">Email</dt>
                            <dd class="text-gray-800">admin@sekolah.sch.id</dd>
                            
                            <dt class="font-medium text-gray-500">Status</dt>
                            <dd class="text-gray-800">
                                <span class="inline-flex items-center gap-1">
                                    <span class="status-dot status-active"></span> Aktif
                                </span>
                            </dd>
                            
                            <dt class="font-medium text-gray-500">Dibuat</dt>
                            <dd class="text-gray-800">15 Januari 2024</dd>
                            
                            <dt class="font-medium text-gray-500">Login Terakhir</dt>
                            <dd class="text-gray-800">2 menit yang lalu</dd>
                        </div>
                    </dl>
                </div>
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t flex justify-end gap-3">
                    <button onclick="closeModal('modalView1')" class="btn-secondary px-4 py-2 rounded-lg">Tutup</button>
                    <button class="btn-primary px-4 py-2 rounded-lg">Edit User</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Delete Confirmation -->
    <div id="modalDeleteConfirmation" class="modal fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75" onclick="closeModal('modalDeleteConfirmation')"></div>
            <div class="relative bg-white rounded-xl max-w-md w-full mx-4 p-6">
                <div class="flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus User</h3>
                    <p class="text-gray-600 text-sm mb-6">Apakah Anda yakin ingin menghapus user ini? Data tidak dapat dikembalikan!</p>
                    <form action="{{ route('admin.users.destroy', $user->id_user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-center gap-3 w-full">
                            <button type="button" onclick="closeModal('modalDeleteConfirmation')" class="flex-1 px-4 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">Batal</button>
                            <button type="submit" class="flex-1 px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium">Hapus User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Filter -->
    <div id="modalFilter" class="modal fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75" onclick="closeModal('modalFilter')"></div>
            <div class="relative bg-white rounded-xl max-w-lg w-full mx-4 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Filter Data User</h3>
                    <button onclick="closeModal('modalFilter')" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                </div>
                <form class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none appearance-none bg-white">
                            <option value="">Semua Role</option>
                            <option value="admin">Administrator</option>
                            <option value="guru">Guru</option>
                            <option value="siswa">Siswa</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <div class="flex gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status_filter" checked>
                                <span>Aktif</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status_filter">
                                <span>Tidak Aktif</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status_filter">
                                <span>Semua</span>
                            </label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Daftar</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Dari</label>
                                <input type="date" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500 mb-1">Sampai</label>
                                <input type="date" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <button type="button" onclick="closeModal('modalFilter')" class="btn-secondary px-4 py-2.5 rounded-lg">Reset</button>
                        <button type="submit" class="btn-primary px-4 py-2.5 rounded-lg">Terapkan Filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
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
    
    <script>
        // Close Modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        
        // Open Modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        
        // Confirm Delete
        function confirmDelete(id) {
            const form = document.querySelector('#modalDeleteConfirmation form');
            form.action = `/admin/users/${id}`;
            openModal('modalDeleteConfirmation');
        }
        
        // Apply Filters
        function applyFilters() {
            console.log('Filters applied');
        }
        
        // Keyboard Navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal.open').forEach(modal => {
                    modal.classList.add('hidden');
                });
            }
        });
    </script>