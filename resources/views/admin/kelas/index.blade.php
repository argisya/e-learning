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
                        <p class="text-2xl font-bold text-gray-800 mt-1">450</p>
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
                        <p class="text-2xl font-bold text-gray-800 mt-1">12</p>
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
                                        {{ $class->nama_lengkap}} 
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

                                            <form action="{{ route('admin.kelas.destroy', ['id_kelas' => $class->id_kelas]) }}" method="POST" class="inline-flex items-center m-0" onsubmit="return confirm('Apakah Anda yakin?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center w-9 h-9 text-red-500 hover:text-red-700 rounded hover:bg-red-50 transition-colors" title="Hapus">
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
    
    <!-- Modal View Detail -->
    <div id="modalView1" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalView1')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Detail Data Kelas</h3>
                    <button onclick="closeModal('modalView1')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    
                    <!-- Class Profile -->
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                        <img src="{{ asset('images/class-room.jpg') }}" alt="" class="w-20 h-20 rounded-xl object-cover border-4 border-primary-100">
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-800">Kelas VII A</h4>
                            <p class="text-sm text-gray-500">SMP IT Al-Fath</p>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-active mt-2">
                                <span class="status-dot status-active"></span> Aktif
                            </span>
                        </div>
                    </div>
                    
                    <!-- Info Grid -->
                    <dl class="space-y-4 text-sm">
                        <div class="grid grid-cols-2 gap-4">
                            <dt class="font-medium text-gray-500">Kode Kelas</dt>
                            <dd class="text-gray-800 font-mono">IT-AF-VIIA-2024</dd>
                            
                            <dt class="font-medium text-gray-500">Jenjang</dt>
                            <dd class="text-gray-800"><span class="badge badge-active">SMP</span></dd>
                            
                            <dt class="font-medium text-gray-500">Ruang Kelas</dt>
                            <dd class="text-gray-800">R101</dd>
                            
                            <dt class="font-medium text-gray-500">Jumlah Siswa</dt>
                            <dd class="text-gray-800 font-bold text-lg">37 siswa</dd>
                            
                            <dt class="font-medium text-gray-500">Wali Kelas</dt>
                            <dd class="text-gray-800">
                                <div class="flex items-center gap-2 mt-1">
                                    <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-8 h-8 rounded-full object-cover border-2">
                                    <div>
                                        <p class="font-medium text-gray-800">Dr. Ahmad Fauzi, M.Pd.</p>
                                        <p class="text-xs text-gray-500">NIP: 19850101</p>
                                    </div>
                                </div>
                            </dd>
                            
                            <dt class="font-medium text-gray-500">Status</dt>
                            <dd class="text-gray-800">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-active">
                                    <span class="status-dot status-active"></span> Aktif
                                </span>
                            </dd>
                        </div>
                        
                        <!-- Additional Info -->
                        <hr class="border-gray-200 my-4">
                        
                        <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <i class="fas fa-info-circle text-blue-600 text-xl mt-1"></i>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800 text-sm">Informasi Tambahan</p>
                                <ul class="text-xs text-gray-500 mt-2 space-y-1">
                                    <li><i class="fas fa-calendar-day text-blue-600"></i> Dibuat: 1 Juli 2024</li>
                                    <li><i class="fas fa-clock text-blue-600"></i> Update Terakhir: Hari Ini</li>
                                    <li><i class="fas fa-check text-blue-600"></i> Tahun Ajaran: 2024/2025</li>
                                    <li><i class="fas fa-clock text-blue-600"></i> Jam Pelajaran: 07:00 - 15:00 WIB</li>
                                </ul>
                            </div>
                        </div>
                    </dl>
                </div>
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t flex justify-end gap-3">
                    <button onclick="closeModal('modalView1')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Tutup</button>
                    <button onclick="closeModal('modalView1')" class="inline-flex items-center justify-center gap-2 px-4 py-2 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">Edit Kelas</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Edit Student -->
    <div id="modalEdit1" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalEdit1')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Edit Data Kelas</h3>
                    <button onclick="closeModal('modalEdit1')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        
                        <!-- Identitas Kelas -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Identitas Kelas</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="nama_kelas_edit" class="block text-sm font-medium text-gray-700 mb-1">Nama Kelas <span class="text-red-500">*</span></label>
                                    <input type="text" id="nama_kelas_edit" name="nama_kelas_edit" value="Kelas VII A" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="kode_kelas_edit" class="block text-sm font-medium text-gray-700 mb-1">Kode Kelas <span class="text-red-500">*</span></label>
                                    <input type="text" id="kode_kelas_edit" name="kode_kelas_edit" value="IT-AF-VIIA-2024" readonly class="w-full px-4 py-2.5 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-500 cursor-not-allowed">
                                </div>
                                <div>
                                    <label for="jenjang_edit" class="block text-sm font-medium text-gray-700 mb-1">Jenjang <span class="text-red-500">*</span></label>
                                    <select id="jenjang_edit" name="jenjang_edit" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                        <option value="SMP" selected>SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="SMK">SMK</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="tingkat_edit" class="block text-sm font-medium text-gray-700 mb-1">Tingkat/Kelas <span class="text-red-500">*</span></label>
                                    <select id="tingkat_edit" name="tingkat_edit" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                        <option value="VII" selected>VII</option>
                                        <option value="VIII">VIII</option>
                                        <option value="IX">IX</option>
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Ruang & Jadwal -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Ruang & Jadwal</h3>
                            <div class="space-y-4">
                                <div>
                                    <label for="ruang_kelas_edit" class="block text-sm font-medium text-gray-700 mb-1">Ruang Kelas <span class="text-red-500">*</span></label>
                                    <input type="text" id="ruang_kelas_edit" name="ruang_kelas_edit" value="R101" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="jam_mulai_edit" class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                                        <input type="time" id="jam_mulai_edit" name="jam_mulai_edit" value="07:00" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                    </div>
                                    <div>
                                        <label for="jam_selesai_edit" class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai</label>
                                        <input type="time" id="jam_selesai_edit" name="jam_selesai_edit" value="15:00" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Wali Kelas -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Wali Kelas</h3>
                            <div>
                                <label for="wali_kelas_edit" class="block text-sm font-medium text-gray-700 mb-1">Pilih Wali Kelas <span class="text-red-500">*</span></label>
                                <select id="wali_kelas_edit" name="wali_kelas_edit" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                    <option value="">-- Pilih Guru --</option>
                                    <option value="1" selected>Dr. Ahmad Fauzi, M.Pd.</option>
                                    <option value="2">Bu Siti Aminah, S.Pd.</option>
                                    <option value="3">Pak Budi Santoso, M.Si.</option>
                                    <option value="4">Ibu Ratna Sari, S.Hist.</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Program Keahlian -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Program Keahlian</h3>
                            <div>
                                <label for="program_edit" class="block text-sm font-medium text-gray-700 mb-1">Program Keahlian</label>
                                <select id="program_edit" name="program_edit" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                    <option value="">-- Pilih Program --</option>
                                    <option value="IPA" selected>IPA</option>
                                    <option value="IPS">IPS</option>
                                    <option value="Bahasa">Bahasa</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Status</h3>
                            <div>
                                <label for="status_edit" class="block text-sm font-medium text-gray-700 mb-2">Status Kelas <span class="text-red-500">*</span></label>
                                <select id="status_edit" name="status_edit" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                    <option value="aktif" selected>Aktif</option>
                                    <option value="tidak_aktif">Tidak Aktif</option>
                                    <option value="lulus">Lulus</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="flex justify-end gap-3 pt-6 mt-6 border-t">
                        <button type="button" onclick="closeModal('modalEdit1')" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Batal</button>
                        <button type="submit" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Modal Delete Confirmation -->
    <div id="modalDeleteConfirmation" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalDeleteConfirmation')"></div>
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
                            <button type="button" onclick="closeModal('modalDeleteConfirmation')" class="flex-1 px-4 py-2.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Batal</button>
                            <button type="submit" class="flex-1 px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium">Hapus Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Export -->
    <div id="modalExport" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalExport')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Export Data Kelas</h3>
                    <button onclick="closeModal('modalExport')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div>
                            <label for="format_export_class" class="block text-sm font-medium text-gray-700 mb-2">Format File</label>
                            <select id="format_export_class" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="pdf">PDF (Portable Document Format)</option>
                                <option value="excel">Excel (.xlsx)</option>
                                <option value="csv">CSV (Comma Separated Values)</option>
                                <option value="print">Print Preview</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Opsi Export</label>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" checked onchange="enableDisableFields()">
                                    <span>Sertakan Foto Setiap Kelas</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" checked>
                                    <span>Lampirkan Rekap Jumlah Siswa</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox">
                                    <span>Gabar Grafik Statistic</span>
                                </label>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-info-circle text-blue-600 text-xl mt-1"></i>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800 text-sm">Informasi</p>
                                    <p class="text-xs text-gray-500 mt-1">File akan diunduh secara otomatis setelah export selesai</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="flex justify-end gap-3 pt-6 mt-6 border-t">
                        <button onclick="closeModal('modalExport')" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Batal</button>
                        <button class="inline-flex items-center justify-center gap-2 px-4 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                            <i class="fas fa-download mr-2"></i>Export Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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
            openModal('modalDeleteConfirmation');
        }
        
        // Apply Filters
        function applyFilters() {
            const searchInput = document.getElementById('class_search').value.toLowerCase();
            const jenjangFilter = document.getElementById('jenjang_filter').value;
            const tingkatFilter = document.getElementById('tingkat_filter').value;
            const programFilter = document.getElementById('program_filter').value;
            
            console.log('Filters:', { searchInput, jenjangFilter, tingkatFilter, programFilter });
            
            if (searchInput.length > 0 || jenjangFilter !== '' || tingkatFilter !== '') {
                showEmptyState(true);
            } else {
                showEmptyState(false);
            }
        }
        
        // Reset Filters
        function resetFilters() {
            document.getElementById('class_search').value = '';
            document.getElementById('jenjang_filter').value = '';
            document.getElementById('tingkat_filter').value = '';
            document.getElementById('program_filter').value = '';
            showEmptyState(false);
        }
        
        // Show/Hide Empty State
        function showEmptyState(show) {
            const emptyState = document.getElementById('emptyState');
            const tableBody = document.querySelector('#classContent tbody');
            
            if (show) {
                emptyState.classList.remove('hidden');
                if (tableBody) tableBody.classList.add('hidden');
            } else {
                emptyState.classList.add('hidden');
                if (tableBody) tableBody.classList.remove('hidden');
            }
        }
        
        // Enable Disable Fields in Export Modal
        function enableDisableFields() {
            const checkbox = event.target;
            const nextElement = checkbox.nextElementSibling;
            
            if (checkbox.checked) {
                nextElement.style.opacity = '1';
            } else {
                nextElement.style.opacity = '0.5';
            }
        }
        
        // Keyboard Navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal').forEach(modal => modal.classList.add('hidden'));
            }
            
            if (e.key === 'Enter' && e.target.tagName === 'INPUT') {
                applyFilters();
            }
        });
        
        // Print Handler
        window.addEventListener('beforeprint', function() {
            document.body.classList.add('print-mode');
        });
        
        window.addEventListener('afterprint', function() {
            document.body.classList.remove('print-mode');
        });
    </script>