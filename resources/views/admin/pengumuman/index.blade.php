@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Pengumuman</h1>
                <p class="text-gray-500 mt-1 text-sm">Kelola pengumuman di SMP Islam Terpadu Al-Fath</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-print mr-2"></i>Cetak
                </button>
                <a href="{{ route('admin.pengumuman.create') }}" class="inline-flex items-center gap-2 gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all shadow-md">
                    <i class="fas fa-plus mr-2"></i>Tambah Pengumuman
                </a>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden mb-8">
            <div class="p-6 border-b bg-gray-50">
                
                <!-- Search Input -->
                <div class="mb-6">
                    <label for="search_input" class="block text-sm font-medium text-gray-700 mb-2">Cari Pengumuman</label>
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="search_input" placeholder="Cari judul atau isi pengumuman..." 
                               class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    </div>
                </div>
                
                <!-- Category & Status Selection -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- Kategori -->
                    <div>
                        <label for="category_filter" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select id="category_filter" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                            <option value="">Semua Kategori</option>
                            <option value="umum">Umum</option>
                            <option value="akademik">Akademik</option>
                            <option value="kegiatan">Kegiatan</option>
                            <option value="undangan">Undangan</option>
                            <option value="penting">Penting</option>
                        </select>
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status_filter" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status_filter" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                            <option value="">Semua Status</option>
                            <option value="publish">Dipublish</option>
                            <option value="draft">Draft</option>
                            <option value="arsip">Arsip</option>
                        </select>
                    </div>
                    
                    <!-- Tanggal Dari -->
                    <div>
                        <label for="date_from" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dari</label>
                        <input type="date" id="date_from" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    </div>
                    
                    <!-- Tampilkan Hasil -->
                    <div class="flex items-end">
                        <button onclick="applyFilters()" class="w-full px-4 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                            <i class="fas fa-filter mr-2"></i>Tampilkan Data
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Legend -->
            <div class="px-6 py-3 bg-gray-50 border-t">
                <div class="flex flex-wrap items-center gap-4">
                    <span class="text-sm text-gray-600">Legenda:</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700"><i class="fas fa-circle"></i> Umum</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-purple-100 text-purple-700"><i class="fas fa-book"></i> Akademik</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-orange-100 text-orange-700"><i class="fas fa-calendar-alt"></i> Kegiatan</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-pink-100 text-pink-700"><i class="fas fa-envelope-open"></i> Undangan</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-red-100 text-red-700"><i class="fas fa-exclamation-circle"></i> Penting</span>
                </div>
            </div>
        </div>
        
        <!-- Announcement List -->
        <div id="announcementContent" class="max-w-7xl mx-auto space-y-6">
            
            <!-- Today's Summary -->
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="p-6 border-b flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-bullhorn"></i>
                        </span>
                        Daftar Pengumuman
                    </h2>
                    <span class="text-sm text-gray-500">Total: 25 Pengumuman</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left">No</th>
                                <th scope="col" class="px-6 py-4 text-left">Judul Pengumuman</th>
                                <th scope="col" class="px-6 py-4 text-center">Kategori</th>
                                <th scope="col" class="px-6 py-4 text-left hidden md:table-cell">Penulis</th>
                                <th scope="col" class="px-6 py-4 text-left">Tanggal</th>
                                <th scope="col" class="px-6 py-4 text-center">Status</th>
                                <th scope="col" class="px-6 py-4 text-left hidden lg:table-cell">Sudah Dibaca</th>
                                <th scope="col" class="px-6 py-4 text-center hidden lg:table-cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($pengumuman as $p => $pengumuman)
                                
                            
                            <!-- Row 1 -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-gray-600 text-center">1</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $pengumuman->judul_pengumuman }}</p>
                                            <p class="text-xs text-gray-500 truncate max-w-[300px]">{{ $pengumuman->isi_pengumuman }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($pengumuman->kategori == 'Umum')
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-purple-100 text-purple-700"><i class="fas fa-book"></i> {{$pengumuman->kategori}}</span>
                                    @elseif($pengumuman->kategori == 'Akademik')
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700"><i class="fas fa-graduation-cap"></i> {{$pengumuman->kategori}}</span>
                                    @elseif($pengumuman->kategori == 'Kegiatan')
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-green-100 text-green-700"><i class="fas fa-calendar-alt"></i> {{$pengumuman->kategori}}</span>
                                    @elseif($pengumuman->kategori == 'Undangan')
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700"><i class="fas fa-envelope"></i> {{$pengumuman->kategori}}</span>
                                    @elseif($pengumuman->kategori == 'Penting')
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-red-100 text-red-700"><i class="fas fa-exclamation-triangle"></i> {{$pengumuman->kategori}}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 hidden md:table-cell">
                                    <div class="flex items-center gap-2">
                                        
                                        <p class="font-medium text-gray-800 text-xs">{{ $pengumuman->nama_lengkap }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700">{{ \Carbon\Carbon::parse($pengumuman->created_at)->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-active">
                                        <span class="status-dot status-active"></span> {{ $pengumuman->status == 'publish' ? 'Dipublish' : ($pengumuman->status == 'draft' ? 'Draft' : 'Arsip') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600 text-xs hidden lg:table-cell">
                                    234 / 450 Siswa
                                </td>

                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        
                                        <a href="" class="inline-flex items-center justify-center w-9 h-9 text-blue-500 hover:text-blue-700 rounded hover:bg-blue-50 transition-colors" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.pengumuman.edit', $pengumuman->id_pengumuman) }}" class="inline-flex items-center justify-center w-9 h-9 text-yellow-500 hover:text-yellow-700 rounded hover:bg-yellow-50 transition-colors" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                            <button onclick="confirmDelete('{{ route('admin.pengumuman.destroy', $pengumuman->id_pengumuman) }}')" class="inline-flex items-center justify-center w-9 h-9 text-red-500 hover:text-red-700 rounded hover:bg-red-50 transition-colors" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        
                                    </div>
                                </td>
                            </tr>
                            <!-- More rows... -->
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada pengumuman ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Empty State -->
                <div id="emptyState" class="hidden p-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bullhorn text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak Ada Pengumuman Ditemukan</h3>
                    <p class="text-gray-500 mb-6">Tidak ditemukan data pengumuman untuk kriteria yang dipilih</p>
                    <button onclick="resetFilters()" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">
                        <i class="fas fa-redo"></i> Reset Filter
                    </button>
                </div>
                
                <!-- Pagination -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-6 border-t">
                    <p class="text-sm text-gray-600">
                        Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">4</span> dari <span class="font-medium">25</span> data
                    </p>
                    <div class="flex items-center gap-2">
                        <button disabled class="btn-pagination-disabled px-4 py-2 rounded-lg border opacity-50 cursor-not-allowed"><i class="fas fa-chevron-left"></i></button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">...</button>
                        <button class="pagination-btn">3</button>
                        <button class="btn-pagination-active px-4 py-2 rounded-lg border"><i class="fas fa-chevron-right"></i></button>
                    </div>
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