@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
<div class="space-y-6">
    <!-- Breadcrumb -->
    <nav class="flex items-center space-x-2 text-sm text-gray-500" aria-label="Breadcrumb">
        <ol role="list" class="flex items-center space-x-2">
            <li><a href="" class="hover:text-primary-600"><i class="fas fa-home"></i></a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="#" class="hover:text-primary-600">Guru</a></li>
            <li><span class="mx-2">/</span></li>
            <li><span class="font-medium text-gray-800">Data Guru</span></li>
        </ol>
    </nav>
    
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Data Guru</h1>
            <p class="text-gray-500 mt-1">Kelola data guru sekolah SMP Islam Terpadu Al-Fath</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="btn-secondary btn-action px-4 py-2" onclick="openModal('modalFilter')">
                <i class="fas fa-filter mr-2"></i>Filter
            </button>
            <button type="submit" form="exportForm" class="btn-secondary btn-action px-4 py-2">
                <i class="fas fa-download mr-2"></i>Export
            </button>
            <a href="{{ route('admin.guru.data.create') }}" class="btn-primary btn-action px-4 py-2">
                <i class="fas fa-plus mr-2"></i>Tambah Guru
            </a>
        </div>
    </div>
    
    <!-- Tabs Section -->
    <div class="tabs bg-white rounded-xl border shadow-sm">
        <div class="tabs-header border-b">
            <button 
                class="tab-btn active p-4 text-sm font-semibold" 
                onclick="switchTab('identitas')" 
                id="tab-identitas"
            >
                <i class="fas fa-user-circle mr-2"></i>Data Identitas
            </button>
            <button 
                class="tab-btn p-4 text-sm font-semibold" 
                onclick="switchTab('pegawai')" 
                id="tab-pegawai"
            >
                <i class="fas fa-id-badge mr-2"></i>Data Pegawai & Jabatan
            </button>
        </div>
        
        <!-- Tab Content: Data Identitas -->
        <div class="tab-content p-6" id="panel-identitas">
            <!-- Search & Actions -->
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1 relative">
                    <input type="text" placeholder="Cari berdasarkan nama, NIP, atau NOKAS..." 
                           class="search-input w-full pl-10 pr-4 py-2.5">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
                <select class="form-select">
                    <option value="">Semua Status Kepegawaian</option>
                    <option value="PNS">PNS</option>
                    <option value="PPPK">PPPK</option>
                    <option value="TKS">Tenaga Kontrak Sekolah</option>
                </select>
                <select class="form-select">
                    <option value="">Semua Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen Protestan">Kristen Protestan</option>
                    <option value="Kristen Katolik">Kristen Katolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Konghucu">Konghucu</option>
                </select>
            </div>
            
            <!-- Table -->
            <div class="overflow-x-auto rounded-lg border">
                <table class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left">No</th>
                            <th scope="col" class="px-6 py-3 text-left">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-3 text-left">NIP/NKK</th>
                            <th scope="col" class="px-6 py-3 text-left">Tempat/Tgl Lahir</th>
                            <th scope="col" class="px-6 py-3 text-left">Jenis Kelamin</th>
                            <th scope="col" class="px-6 py-3 text-left">Agama</th>
                            <th scope="col" class="px-6 py-3 text-left">Status Pernikahan</th>
                            <th scope="col" class="px-6 py-3 text-left">No HP</th>
                            <th scope="col" class="px-6 py-3 text-center hidden lg:table-cell">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        
                        @forelse($guru as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-600">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $item->foto ? asset('storage/' . $item->foto) : asset('images/avatar.jpg') }}" alt="Avatar" 
                                        class="w-10 h-10 rounded-full object-cover border-2">
                                    <div>
                                        <h1 class="font-medium text-gray-900">{{ $item->nama_lengkap }}</h1>  
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700 font-mono text-xs">{{ $item->nip ?? '-' }}</td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-4">
                                @if($item->jenis_kelamin == 'Laki-laki' || $item->jenis_kelamin == 'L')
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-blue-50 text-blue-700">
                                        <i class="fas fa-mars"></i> Laki-laki
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-pink-50 text-pink-700">
                                        <i class="fas fa-venus"></i> Perempuan
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->agama }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs {{ $item->status_pernikahan == 'Menikah' ? 'bg-green-50 text-green-700' : 'bg-gray-50 text-gray-700' }}">
                                    <i class="fas {{ $item->status_pernikahan == 'Menikah' ? 'fa-ring' : 'fa-user' }}"></i> {{ $item->status_pernikahan }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">{{ $item->no_hp }}</td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    
                                    <a href="" class="inline-flex items-center justify-center w-9 h-9 text-blue-500 hover:text-blue-700 rounded hover:bg-blue-50 transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.guru.data.edit', $item->nip) }}" class="inline-flex items-center justify-center w-9 h-9 text-yellow-500 hover:text-yellow-700 rounded hover:bg-yellow-50 transition-colors" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                        <button type="button" onclick="confirmDelete('{{ route('admin.guru.data.destroy', $item->nip) }}')" class="inline-flex items-center justify-center w-9 h-9 text-red-500 hover:text-red-700 rounded hover:bg-red-50 transition-colors" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                                Belum ada data guru yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
                <p class="text-sm text-gray-600">
                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">45</span> data
                </p>
                <div class="flex items-center gap-2">
                    <button disabled class="btn-pagination-disabled">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn">...</button>
                    <button class="pagination-btn">5</button>
                    <button class="btn-pagination-active">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Tab Content: Data Pegawai & Jabatan -->
        <div class="tab-content p-6 hidden" id="panel-pegawai">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                <div class="stat-card stat-card-blue">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total PNS</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">32</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-user-tie text-blue-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card stat-card-green">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Total PPPK</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">12</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                            <i class="fas fa-briefcase text-green-600"></i>
                        </div>
                    </div>
                </div>
                
                <div class="stat-card stat-card-orange">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500">Rata-rata Masa Kerja</p>
                            <p class="text-2xl font-bold text-gray-800 mt-1">8.5 Tahun</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center">
                            <i class="fas fa-clock text-orange-600"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Search & Actions -->
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <div class="flex-1 relative">
                    <input type="text" placeholder="Cari berdasarkan nama atau NIP..." 
                           class="search-input w-full pl-10 pr-4 py-2.5">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </div>
                <select class="form-select">
                    <option value="">Semua Status Kepegawaian</option>
                    <option value="PNS">PNS</option>
                    <option value="PPPK">PPPK</option>
                    <option value="TKS">Tenaga Kontrak Sekolah</option>
                </select>
                <select class="form-select">
                    <option value="">Semua Jabatan</option>
                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                    <option value="Wakil Kepala Sekolah">Wakil Kepala Sekolah</option>
                    <option value="Guru Kelas">Guru Kelas</option>
                    <option value="Guru Mata Pelajaran">Guru Mata Pelajaran</option>
                </select>
            </div>
            
            <!-- Table -->
            <div class="overflow-x-auto rounded-lg border">
                <table class="w-full text-sm">
                    <thead class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left">No</th>
                            <th scope="col" class="px-6 py-3 text-left">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-3 text-left">NIP</th>
                            <th scope="col" class="px-6 py-3 text-left">Status Kepagawanan</th>
                            <th scope="col" class="px-6 py-3 text-left">Masa Kerja</th>
                            <th scope="col" class="px-6 py-3 text-left">Jabatan</th>
                            <th scope="col" class="px-6 py-3 text-left">SK Jabatan</th>
                            <th scope="col" class="px-6 py-3 text-right hidden lg:table-cell">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($guru as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            
                            <td class="px-6 py-4 text-gray-600">{{ $loop->iteration }}</td>
                            
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    
                                    <div>
                                        <h1 class="font-medium text-gray-900">{{ $item->nama_lengkap }}</h1>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 text-gray-700 font-mono text-xs">{{ $item->nip ?? '-' }}</td>
                            
                            <td class="px-6 py-4">
                                @if($item->status == 'PNS')
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-blue-50 text-blue-700 font-medium">
                                        <i class="fas fa-check-circle"></i> PNS
                                    </span>
                                @elseif($item->status == 'PPPK')
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-green-50 text-green-700 font-medium">
                                        <i class="fas fa-check-circle"></i> PPPK
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-gray-50 text-gray-700 font-medium">
                                        <i class="fas fa-user"></i> {{ $item->status }}
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-gray-700">{{ $item->masa_kerja }}</td>
                            
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-purple-50 text-purple-700 font-medium">
                                    <i class="fas fa-chalkboard-teacher"></i> {{ $item->jabatan }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 text-gray-700 text-xs">
                                SK: {{ $item->no_sk }}<br>
                            </td>
                            
                            <td class="px-6 py-4 text-right hidden lg:table-cell">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="icon-btn icon-view" onclick="openModal('modalViewPeg{{ $item->nip }}')" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="icon-btn icon-edit" onclick="openModal('modalEditPeg{{ $item->nip }}')" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button type="button" class="icon-btn icon-delete" onclick="confirmDelete('{{ route('admin.guru.data.destroy', $item->nip) }}')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500">
                                Belum ada data yang ditambahkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
                <p class="text-sm text-gray-600">
                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">45</span> data
                </p>
                <div class="flex items-center gap-2">
                    <button disabled class="btn-pagination-disabled">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn">...</button>
                    <button class="pagination-btn">5</button>
                    <button class="btn-pagination-active">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('layouts.partials.modal.delete')

@push('scripts')
        @vite(['resources/js/modal.js',
                'resources/js/validation.js',
                'resources/js/filter.js',
        ])
    @endpush


@stack('styles')
<style>
/* Custom Component Styles */
.tabs .tab-btn {
    color: #6b7280;
    background: transparent;
    transition: all 0.2s ease;
}

.tabs .tab-btn:hover {
    color: #4f46e5;
    background: rgba(79, 70, 229, 0.05);
}

.tabs .tab-btn.active {
    color: #4f46e0;
    background: rgba(79, 70, 229, 0.1);
    border-bottom: 2px solid #4f46e0;
    margin-bottom: -1px;
}

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

.stat-card {
    @apply bg-white rounded-xl border shadow-sm p-4 transition-shadow hover:shadow-md;
}

.stat-card-blue {
    @apply border-blue-100;
}

.stat-card-green {
    @apply border-green-100;
}

.stat-card-orange {
    @apply border-orange-100;
}

.form-group label span.text-red-500 {
    position: relative;
    top: 2px;
}

.form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.5rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 2.5rem;
    background-color: #fff;
    border-color: #d1d5db;
    border-radius: 0.5rem;
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}
</style>