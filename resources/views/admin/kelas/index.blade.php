@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
<div class="min-h-screen py-8 px-4 w-full">
        
        <div class="max-w-7xl mx-auto mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Data Kelas</h1>
                <p class="text-gray-500 mt-1 text-sm">Kelola informasi kelas di SMP Islam Terpadu Al-Fath</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <button onclick="openModal('modalExport')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors whitespace-nowrap">
                    <i class="fas fa-download mr-2"></i>Export
                </button>
                <a href="{{ route('admin.kelas.create') }}" class="inline-flex items-center gap-2 gradient-bg text-white px-4 py-2 rounded-lg hover:opacity-90 transition-all shadow-md whitespace-nowrap bg-blue-600">
                    <i class="fas fa-plus mr-2"></i>Tambah Kelas
                </a>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            
            <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Kelas</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_kelas }}</p>
                        <p class="text-xs text-green-600 mt-2"><i class="fas fa-check-circle"></i> Semua Aktif</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-school text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Kelas Aktif</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $kelas_aktif }}</p>
                        <p class="text-xs text-green-600 mt-2">Semua aktif tahun ajaran</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total Siswa</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_siswa }}</p>
                        <p class="text-xs text-green-600 mt-2">Rata-rata 37 siswa/kelas</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl p-6 border shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Guru Wali Kelas</p>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $total_wali_kelas }}</p>
                        <p class="text-xs text-green-600 mt-2">Semua terisi</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-user-tie text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden mb-8">
            <div class="p-6 border-b bg-gray-50">
                <div class="mb-6">
                    <label for="class_search" class="block text-sm font-medium text-gray-700 mb-2">Cari Kelas</label>
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="class_search" placeholder="Cari nama atau kode kelas..." 
                               class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label for="jenjang_filter" class="block text-sm font-medium text-gray-700 mb-2">Jenjang</label>
                        <select id="jenjang_filter" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all bg-white">
                            <option value="">Semua Jenjang</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="SMK">SMK</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="tingkat_filter" class="block text-sm font-medium text-gray-700 mb-2">Tingkat/Kelas</label>
                        <select id="tingkat_filter" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all bg-white">
                            <option value="">Semua Tingkat</option>
                            <option value="VII">VII</option>
                            <option value="VIII">VIII</option>
                            <option value="IX">IX</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="program_filter" class="block text-sm font-medium text-gray-700 mb-2">Program Keahlian</label>
                        <select id="program_filter" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all bg-white">
                            <option value="">Semua Program</option>
                            <option value="IPA">IPA</option>
                            <option value="IPS">IPS</option>
                        </select>
                    </div>
                    
                    <div class="flex items-end">
                        <button onclick="applyFilters()" class="w-full px-4 py-2.5 bg-blue-600 text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                            <i class="fas fa-filter mr-2"></i>Tampilkan Data
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="px-6 py-3 bg-gray-50 border-t">
                <div class="flex flex-wrap items-center gap-4">
                    <span class="text-sm text-gray-600">Legenda:</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-green-100 text-green-700"><i class="fas fa-check-circle"></i> Aktif</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-700"><i class="fas fa-times-circle"></i> Tidak Aktif</span>
                </div>
            </div>
        </div>
        
        <div id="classContent" class="max-w-7xl mx-auto space-y-6 w-full">
            
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden w-full">
                <div class="p-6 border-b flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center text-blue-600 text-sm">
                            <i class="fas fa-building"></i>
                        </span>
                        Daftar Kelas
                    </h2>
                    <span class="text-sm text-gray-500">Total: {{ $total_kelas }} Kelas</span>
                </div>
                
                <div class="w-full overflow-x-auto">
                    <table class="w-full text-sm min-w-max">
                        <thead class="bg-gradient-to-r from-primary-500 to-secondary-500 text-white">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left whitespace-nowrap">No</th>
                                <th scope="col" class="px-6 py-4 text-left whitespace-nowrap">Nama Kelas</th>
                                <th scope="col" class="px-6 py-4 text-left whitespace-nowrap">Jenjang Pendidikan</th>
                                <th scope="col" class="px-6 py-4 text-left whitespace-nowrap">Tingkat/Kelas</th>
                                <th scope="col" class="px-6 py-4 text-left whitespace-nowrap">Jurusan</th>
                                <th scope="col" class="px-6 py-4 text-left whitespace-nowrap">Wali Kelas</th>
                                <th scope="col" class="px-6 py-4 text-left whitespace-nowrap">Status</th>
                                <th scope="col" class="px-6 py-4 text-left whitespace-nowrap">keterangan</th>
                                <th scope="col" class="px-6 py-4 text-center whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($kelas as $index => $class)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        {{ $loop->iteration }}
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                                
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $class->nama_kelas }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-gray-900 font-mono text-xs whitespace-nowrap">
                                        {{ $class->jenjang_pendidikan }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <div>
                                                <p class="font-medium text-gray-800 text-xs">{{ $class->tingkat }} / {{ $class->jurusan }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                        {{ $class->jurusan }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-800 font-medium whitespace-nowrap">
                                        @if ($class->nama_lengkap == null)
                                            Belum ada
                                        @else
                                        {{ $class->nama_lengkap}} 
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($class->status == 'Aktif')
                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-green-100 text-green-700 text-xs">
                                                <i class="fas fa-circle text-[8px]"></i> Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-gray-100 text-gray-700 text-xs">
                                                <i class="fas fa-circle text-[8px]"></i> Tidak Aktif
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-gray-800 font-medium whitespace-nowrap">
                                        {{ $class->keterangan}} 
                                    </td>

                                    <td class="px-6 py-4 text-right whitespace-nowrap">
                                        <div class="flex items-center justify-end gap-2">
                                            
                                            <a href="" class="inline-flex items-center justify-center w-9 h-9 text-blue-500 hover:text-blue-700 rounded hover:bg-blue-50 transition-colors" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('admin.kelas.edit', ['id_kelas' => $class->id_kelas]) }}" class="inline-flex items-center justify-center w-9 h-9 text-yellow-500 hover:text-yellow-700 rounded hover:bg-yellow-50 transition-colors" title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <form action="{{ route('admin.kelas.destroy', ['id_kelas' => $class->id_kelas]) }}" method="POST" class="inline-flex items-center m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="confirmDelete('{{ route('admin.kelas.destroy', ['id_kelas' => $class->id_kelas]) }}')" class="inline-flex items-center justify-center w-9 h-9 text-red-500 hover:text-red-700 rounded hover:bg-red-50 transition-colors" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-10 text-center text-gray-500">
                                        Data kelas belum tersedia.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-6 border-t">
                    <p class="text-sm text-gray-600 text-center sm:text-left">
                        Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">3</span> dari <span class="font-medium">12</span> data
                    </p>
                    <div class="flex flex-wrap justify-center items-center gap-2">
                        <button disabled class="px-3 py-1.5 rounded border opacity-50 cursor-not-allowed bg-white"><i class="fas fa-chevron-left"></i></button>
                        <button class="px-3 py-1.5 rounded border bg-blue-600 text-white">1</button>
                        <button class="px-3 py-1.5 rounded border bg-white hover:bg-gray-50">2</button>
                        <button class="px-3 py-1.5 rounded border bg-white hover:bg-gray-50">3</button>
                        <span class="px-2">...</span>
                        <button class="px-3 py-1.5 rounded border bg-white hover:bg-gray-50">4</button>
                        <button class="px-3 py-1.5 rounded border bg-white hover:bg-gray-50"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <!-- ================= MODALS ================= -->
    <!-- Modal Delete Confirmation -->
    <div id="modalDelete" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalDelete')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full modal-content">
                <div class="px-6 py-6 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus Data Kelas</h3>
                    <p class="text-gray-600 text-sm mb-6">Apakah Anda yakin ingin menghapus data kelas ini? Tindakan ini tidak dapat dibatalkan!</p>
                    <form action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-center gap-3">
                            <button type="button" onclick="closeModal('modalDelete')" class="flex-1 px-4 py-2.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Batal</button>
                            <button type="submit" class="flex-1 px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium">Hapus Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/modal.js',
                'resources/js/filter.js',
                'resources/js/validation.js',
        ])
    @endpush