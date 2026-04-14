@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Data Siswa</h1>
                <p class="text-gray-500 mt-1 text-sm">Manajemen data siswa SMP Islam Terpadu Al-Fath</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openModal('modalImport')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-upload mr-2"></i>Import
                </button>
                <button onclick="openModal('modalExportStudent')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
                <a href="{{ route('admin.siswa.data.create') }}" class="inline-flex items-center gap-2 gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all shadow-md">
                    <i class="fas fa-plus mr-2"></i>Tambah Siswa
                </a>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            
            <!-- Total Siswa -->
            <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Siswa</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_siswa }}</p>
                        <p class="text-xs text-green-600 mt-2"><i class="fas fa-arrow-up"></i> 25 dari bulan lalu</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-primary-100 flex items-center justify-center">
                        <i class="fas fa-user-graduate text-primary-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Laki-laki -->
            <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Laki-laki</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_siswa_laki }}</p>
                        <p class="text-xs text-green-600 mt-2">51%</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-mars text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <!-- Perempuan -->
            <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Perempuan</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_siswa_perempuan }}</p>
                        <p class="text-xs text-green-600 mt-2">49%</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-pink-100 flex items-center justify-center">
                        <i class="fas fa-venus text-pink-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden mb-8">
            <div class="p-6 border-b bg-gray-50">
                
                <!-- Search Input -->
                <div class="mb-6">
                    <label for="student_search" class="block text-sm font-medium text-gray-700 mb-2">Cari Siswa</label>
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="student_search" placeholder="Cari berdasarkan nama, NIS, atau NISN..." 
                               class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    </div>
                </div>
                
                <!-- Class & Status Selection -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- Kelas -->
                    <div>
                        <label for="class_filter" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <select id="class_filter" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                            <option value="">Semua Kelas</option>
                            <option value="VII A">VII A</option>
                            <option value="VII B">VII B</option>
                            <option value="VIII A">VIII A</option>
                            <option value="VIII B">VIII B</option>
                            <option value="IX A">IX A</option>
                            <option value="X IPA">X IPA</option>
                            <option value="XI IPS">XI IPS</option>
                            <option value="XII IPA">XII IPA</option>
                        </select>
                    </div>
                    
                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="gender_filter" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                        <select id="gender_filter" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                            <option value="">Semua</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label for="status_filter" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status_filter" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                            <option value="">Semua Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak_aktif">Tidak Aktif</option>
                            <option value="lulus">Lulus</option>
                        </select>
                    </div>
                    
                    <!-- Apply Filters -->
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
                    <span class="text-sm text-gray-600">Legenda Status:</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-green-100 text-green-700"><i class="fas fa-check-circle"></i> Aktif</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700"><i class="fas fa-times-circle"></i> Tidak Aktif</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700"><i class="fas fa-graduation-cap"></i> Lulus</span>
                </div>
            </div>
        </div>
        
        <!-- Student List -->
        <div id="studentContent" class="max-w-7xl mx-auto space-y-6">
            
            <!-- Today's Summary -->
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="p-6 border-b flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-users"></i>
                        </span>
                        Daftar Siswa
                    </h2>
                    <span class="text-sm text-gray-500">Total: 450 Siswa</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left w-16">
                                    <input type="checkbox" class="rounded">
                                </th>
                                <th scope="col" class="px-6 py-4 text-left">Nama Lengkap</th>
                                <th scope="col" class="px-6 py-4 text-left">NIS/NISN</th>
                                <th scope="col" class="px-6 py-4 text-left">Kelas</th>
                                <th scope="col" class="px-6 py-4 text-left hidden md:table-cell">Jenis Kelamin</th>
                                <th scope="col" class="px-6 py-4 text-left">Email</th>
                                <th scope="col" class="px-6 py-4 text-left">Nomor HP</th>
                                <th scope="col" class="px-6 py-4 text-left hidden lg:table-cell">Alamat</th>
                                <th scope="col" class="px-6 py-4 text-left">Status</th>
                                <th scope="col" class="px-6 py-4 text-center hidden lg:table-cell">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($siswa as $student)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="rounded" value="{{ $student->nis }}">
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $student->nama_lengkap }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-700 font-mono text-xs">{{ $student->nis }} | {{ $student->nisn }}</td>
                                
                                <td class="px-6 py-4">

                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-blue-50 text-blue-700 text-xs font-medium">
                                        @if ($student->nama_kelas == null)
                                            Belum Terdaftar
                                        @else
                                            <i class="fas fa-users"></i> {{ $student->nama_kelas }}
                                        @endif
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 hidden md:table-cell">
                                    <span class="inline-flex items-center gap-1">
                                        @if($student->jenis_kelamin == 'L')
                                            <i class="fas fa-mars text-blue-600"></i> Laki-laki
                                        @else
                                            <i class="fas fa-venus text-pink-600"></i> Perempuan
                                        @endif
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 text-gray-700 hidden md:table-cell">{{ $student->email }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $student->no_hp }}</td>
                                <td class="px-6 py-4 text-gray-600 text-xs hidden lg:table-cell truncate max-w-[150px]">
                                    {{ $student->alamat }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    @if($student->status == 'Aktif')
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-active">
                                            <span class="status-dot status-active"></span> Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-lulus">
                                            <span class="status-dot"></span> Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="" class="inline-flex items-center justify-center w-9 h-9 text-blue-500 hover:text-blue-700 rounded hover:bg-blue-50 transition-colors" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.siswa.data.edit', $student->nis) }}" class="inline-flex items-center justify-center w-9 h-9 text-yellow-500 hover:text-yellow-700 rounded hover:bg-yellow-50 transition-colors" title="Edit">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        {{-- <form action="{{ route('admin.siswa.data.destroy', $student->nis) }}" method="POST" class="inline-flex items-center m-0"> --}}
                                            {{-- @csrf --}}
                                            {{-- @method('DELETE') --}}
                                            <button onclick="confirmDelete('{{ route('admin.siswa.data.destroy', $student->nis) }}')" class="inline-flex items-center justify-center w-9 h-9 text-red-500 hover:text-red-700 rounded hover:bg-red-50 transition-colors" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        {{-- </form> --}}
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-6 py-4 text-center text-gray-500">Belum ada data siswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Empty State -->
                <div id="emptyState" class="hidden p-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-clock text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak Ada Siswa Ditemukan</h3>
                    <p class="text-gray-500 mb-6">Tidak ditemukan data siswa untuk kriteria yang dipilih</p>
                    <button onclick="resetFilters()" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">
                        <i class="fas fa-redo"></i> Reset Filter
                    </button>
                </div>
                
                <!-- Pagination -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-6 border-t">
                    <p class="text-sm text-gray-600">
                        Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">450</span> data
                    </p>
                    <div class="flex items-center gap-2">
                        <button disabled class="btn-pagination-disabled px-4 py-2 rounded-lg border opacity-50 cursor-not-allowed"><i class="fas fa-chevron-left"></i></button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">...</button>
                        <button class="pagination-btn">45</button>
                        <button class="btn-pagination-active px-4 py-2 rounded-lg border"><i class="fas fa-chevron-right"></i></button>
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