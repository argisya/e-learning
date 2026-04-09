@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Absensi Siswa</h1>
                <p class="text-gray-500 mt-1 text-sm">Rekam kehadiran siswa sesuai dengan periode waktu yang dipilih</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-print"></i> Cetak
                </button>
                <button onclick="openModal('modalExport')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-download"></i> Export
                </button>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden mb-8">
            <div class="p-6 border-b bg-gray-50">
                
                <!-- Student Selection -->
                <div class="mb-6">
                    <label for="student_search" class="block text-sm font-medium text-gray-700 mb-2">Cari Siswa</label>
                    <div class="relative">
                        <i class="fas fa-user-graduate absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="student_search" placeholder="Cari nama atau NIS..." 
                               class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    </div>
                </div>
                
                <!-- Class & Date Selection -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    
                    <!-- Kelas -->
                    <div>
                        <label for="class_filter" class="block text-sm font-medium text-gray-700 mb-2">Kelas</label>
                        <select id="class_filter" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                            <option value="">Semua Kelas</option>
                            <option value="VII A">VII A</option>
                            <option value="VIII A">VIII A</option>
                            <option value="IX A">IX A</option>
                            <option value="X IPA">X IPA</option>
                            <option value="XI IPS">XI IPS</option>
                            <option value="XII IPA">XII IPA</option>
                        </select>
                    </div>
                    
                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="date_start" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Awal</label>
                        <input type="date" id="date_start" value="{{ date('Y-m-d') }}" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    </div>
                    
                    <!-- Tanggal Akhir -->
                    <div>
                        <label for="date_end" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                        <input type="date" id="date_end" value="{{ date('Y-m-d', strtotime('+1 week')) }}" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    </div>
                    
                    <!-- Tampilkan Hasil -->
                    <div class="flex items-end">
                        <button onclick="applyFilters()" class="w-full px-4 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                            <i class="fas fa-search mr-2"></i>Tampilkan Hasil
                        </button>
                    </div>
                </div>
                
                <!-- Statistics Overview -->
                <div class="px-6 py-4 bg-gradient-to-r from-primary-500 to-secondary-500">
                    <div class="flex flex-wrap items-center justify-between gap-6">
                        
                        <div class="text-white text-center min-w-[120px]">
                            <span class="text-sm opacity-80">Total Kehadiran</span>
                            <p class="text-3xl font-bold mt-1">432</p>
                            <p class="text-xs opacity-80">siswa hadir bulan ini</p>
                        </div>
                        
                        <div class="flex-1 border-l border-r border-white/20 px-6">
                            <div class="flex items-center gap-8 justify-center">
                                <div class="text-center">
                                    <p class="text-2xl font-bold">96%</p>
                                    <p class="text-xs opacity-80">Presentase Hadir</p>
                                </div>
                                <div class="w-px h-10 bg-white/20"></div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold">3%</p>
                                    <p class="text-xs opacity-80">Sakit/Izin</p>
                                </div>
                                <div class="w-px h-10 bg-white/20"></div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold">1%</p>
                                    <p class="text-xs opacity-80">Tidak Hadir</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-white text-center min-w-[120px]">
                            <span class="text-sm opacity-80">Total Siswa</span>
                            <p class="text-3xl font-bold mt-1">450</p>
                            <p class="text-xs opacity-80">total siswa aktif</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Attendance Legend -->
            <div class="px-6 py-3 bg-gray-50 border-t">
                <div class="flex flex-wrap items-center gap-4">
                    <span class="text-sm text-gray-600">Legenda:</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-green-100 text-green-700"><span class="status-dot status-active"></span>Hadir</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-yellow-100 text-yellow-700"><span class="status-dot status-inactive"></span>Sakit</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700"><span class="status-dot status-inactive"></span>Izin</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-red-100 text-red-700"><span class="status-dot status-inactive"></span>Tidak Hadir</span>
                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-orange-100 text-orange-700">Terlambat</span>
                </div>
            </div>
        </div>
        
        <!-- Attendance Records -->
        <div id="attendanceContent" class="max-w-7xl mx-auto space-y-6">
            
            <!-- Today's Summary -->
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="p-6 border-b flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-calendar-check"></i>
                        </span>
                        Ringkasan Kehadiran - {{ now()->isoFormat('dddd, D MMMM YYYY') }}
                    </h2>
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-gray-500">Total Siswa:</span>
                        <span class="font-semibold text-gray-800">450 Siswa</span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">No</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Nama Lengkap</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">NIS</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Kelas</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Waktu Masuk</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Waktu Pulang</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Catatan</th>
                                <th scope="col" class="px-4 py-3 text-right font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            
                            <!-- Row 1: Hadir -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 text-gray-600 text-center">1</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-10 h-10 rounded-full object-cover border-2">
                                        <div>
                                            <p class="font-medium text-gray-800">Ahmad Rizky Pratama</p>
                                            <p class="text-xs text-gray-500">Kelas VII A</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-700 font-mono text-xs">2024001 | 0012345678</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-blue-50 text-blue-700 text-xs font-medium">
                                        <i class="fas fa-users"></i> VII A
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-gray-700">07:00 WIB</td>
                                <td class="px-4 py-4 text-gray-700">15:30 WIB</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-hadir"><i class="fas fa-check-circle"></i> Hadir</span>
                                </td>
                                <td class="px-4 py-4 text-gray-600 text-xs">Belum ada catatan</td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="icon-btn icon-view" onclick="openModal('modalDetail1')" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                        <button class="icon-btn icon-edit" onclick="openModal('modalEdit1')" title="Ubah Data"><i class="fas fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Row 2: Sakit -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 text-gray-600 text-center">2</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-10 h-10 rounded-full object-cover border-2">
                                        <div>
                                            <p class="font-medium text-gray-800">Siti Nurhaliza</p>
                                            <p class="text-xs text-gray-500">Kelas VIII A</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-700 font-mono text-xs">2024002 | 0012345679</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-purple-50 text-purple-700 text-xs font-medium">
                                        <i class="fas fa-users"></i> VIII A
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-gray-500 italic">-</td>
                                <td class="px-4 py-4 text-gray-500 italic">-</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-sakit"><i class="fas fa-notes-medical"></i> Sakit</span>
                                </td>
                                <td class="px-4 py-4 text-gray-600 text-xs">Demam tinggi, membawa surat dokter</td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="icon-btn icon-view" onclick="openModal('modalDetail2')" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                        <button class="icon-btn icon-edit" onclick="openModal('modalEdit2')" title="Ubah Data"><i class="fas fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Row 3: Izin -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 text-gray-600 text-center">3</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-10 h-10 rounded-full object-cover border-2">
                                        <div>
                                            <p class="font-medium text-gray-800">Muhammad Fikri</p>
                                            <p class="text-xs text-gray-500">Kelas IX A</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-700 font-mono text-xs">2024003 | 0012345680</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-orange-50 text-orange-700 text-xs font-medium">
                                        <i class="fas fa-users"></i> IX A
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-gray-500 italic">-</td>
                                <td class="px-4 py-4 text-gray-500 italic">-</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-izin"><i class="fas fa-paper-plane"></i> Izin</span>
                                </td>
                                <td class="px-4 py-4 text-gray-600 text-xs">Menangani keperluan keluarga mendesak</td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="icon-btn icon-view" onclick="openModal('modalDetail3')" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                        <button class="icon-btn icon-edit" onclick="openModal('modalEdit3')" title="Ubah Data"><i class="fas fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Row 4: Terlambat -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 text-gray-600 text-center">4</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-10 h-10 rounded-full object-cover border-2">
                                        <div>
                                            <p class="font-medium text-gray-800">Rina Kartika</p>
                                            <p class="text-xs text-gray-500">Kelas X IPA</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-700 font-mono text-xs">2024004 | 0012345681</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-cyan-50 text-cyan-700 text-xs font-medium">
                                        <i class="fas fa-users"></i> X IPA
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-orange-600 font-medium">07:15 WIB <span class="text-xs font-normal">(±15 menit)</span></td>
                                <td class="px-4 py-4 text-gray-700">15:30 WIB</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-lambat"><i class="fas fa-clock"></i> Terlambat</span>
                                </td>
                                <td class="px-4 py-4 text-gray-600 text-xs">Macet di jalan raya</td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="icon-btn icon-view" onclick="openModal('modalDetail4')" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                        <button class="icon-btn icon-edit" onclick="openModal('modalEdit4')" title="Ubah Data"><i class="fas fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- Row 5: Tidak Hadir -->
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4 text-gray-600 text-center">5</td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-10 h-10 rounded-full object-cover border-2">
                                        <div>
                                            <p class="font-medium text-gray-800">Dedi Supriadi</p>
                                            <p class="text-xs text-gray-500">Kelas XI IPS</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-700 font-mono text-xs">2024005 | 0012345682</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-medium">
                                        <i class="fas fa-users"></i> XI IPS
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-gray-500 italic">-</td>
                                <td class="px-4 py-4 text-gray-500 italic">-</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-alpa"><i class="fas fa-times-circle"></i> Tidak Hadir</span>
                                </td>
                                <td class="px-4 py-4 text-gray-600 text-xs">Ibu sakit keras, belum ada surat</td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="icon-btn icon-view" onclick="openModal('modalDetail5')" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                        <button class="icon-btn icon-edit" onclick="openModal('modalEdit5')" title="Ubah Data"><i class="fas fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- More rows... -->
                            
                        </tbody>
                    </table>
                </div>
                
                <!-- Empty State -->
                <div id="emptyState" class="hidden p-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak Ada Rekam Absensi</h3>
                    <p class="text-gray-500 mb-6">Tidak ditemukan data absensi untuk kriteria yang dipilih</p>
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
                        <button disabled class="pagination-btn-disabled px-4 py-2 rounded-lg border opacity-50 cursor-not-allowed"><i class="fas fa-chevron-left"></i></button>
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

    <!-- ================= MODALS ================= -->
    
    <!-- Modal Detail Absensi -->
    <div id="modalDetail1" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalDetail1')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Detail Absensi Siswa</h3>
                    <button onclick="closeModal('modalDetail1')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    
                    <!-- Student Profile -->
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-16 h-16 rounded-full object-cover border-4 border-primary-100">
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-800">Ahmad Rizky Pratama</h4>
                            <p class="text-sm text-gray-500">Kelas VII A</p>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-hasil mt-2"><i class="fas fa-check-circle"></i> Hadir</span>
                        </div>
                    </div>
                    
                    <!-- Attendance Info -->
                    <dl class="space-y-4 text-sm">
                        <div class="grid grid-cols-2 gap-4">
                            <dt class="font-medium text-gray-500">Tanggal Absensi</dt>
                            <dd class="text-gray-800">{{ now()->isoFormat('D MMMM YYYY') }}</dd>
                            
                            <dt class="font-medium text-gray-500">Waktu Masuk</dt>
                            <dd class="text-gray-800">07:00 WIB</dd>
                            
                            <dt class="font-medium text-gray-500">Waktu Pulang</dt>
                            <dd class="text-gray-800">15:30 WIB</dd>
                            
                            <dt class="font-medium text-gray-500">Durasi Belajar</dt>
                            <dd class="text-gray-800">8 jam 30 menit</dd>
                            
                            <dt class="font-medium text-gray-500">Status</dt>
                            <dd class="text-gray-800">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-hasil">
                                    <i class="fas fa-check-circle"></i> Hadir
                                </span>
                            </dd>
                            
                            <dt class="font-medium text-gray-500">Pukul Masuk Teori</dt>
                            <dd class="text-gray-800">07:00 WIB</dd>
                        </div>
                        
                        <!-- Location Tracking -->
                        <hr class="border-gray-200 my-4">
                        
                        <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <i class="fas fa-map-marker-alt text-blue-600 text-xl mt-1"></i>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800 text-sm">Lokasi Absensi</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    SMP Islam Terpadu Al-Fath<br>
                                    Jl. Merdeka No. 123, Bandung<br>
                                    Lat:-6.9175, Long:107.6191
                                </p>
                            </div>
                        </div>
                    </dl>
                </div>
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t flex justify-end gap-3">
                    <button onclick="closeModal('modalDetail1')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Tutup</button>
                    <button onclick="closeModal('modalDetail1')" class="inline-flex items-center justify-center gap-2 px-4 py-2 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">Edit Data</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Edit Absensi -->
    <div id="modalEdit1" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalEdit1')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Edit Data Absensi Siswa</h3>
                    <button onclick="closeModal('modalEdit1')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <form action="#" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        
                        <!-- Nama -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" value="Ahmad Rizky Pratama" readonly class="w-full px-4 py-2.5 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-500 cursor-not-allowed">
                        </div>
                        
                        <!-- Status Kehadiran -->
                        <div>
                            <label for="status_absensi" class="block text-sm font-medium text-gray-700 mb-2">Status Kehadiran <span class="text-red-500">*</span></label>
                            <select id="status_absensi" name="status_absensi" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="hadir" selected>Hadir</option>
                                <option value="sakit">Sakit</option>
                                <option value="izin">Izin</option>
                                <option value="tidak_hadir">Tidak Hadir</option>
                                <option value="terlambat">Terlambat</option>
                            </select>
                        </div>
                        
                        <!-- Waktu Masuk & Pulang -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="waktu_masuk" class="block text-sm font-medium text-gray-700 mb-1">Waktu Masuk <span class="text-red-500">*</span></label>
                                <input type="time" id="waktu_masuk" name="waktu_masuk" value="07:00" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                            <div>
                                <label for="waktu_pulang" class="block text-sm font-medium text-gray-700 mb-1">Waktu Pulang <span class="text-red-500">*</span></label>
                                <input type="time" id="waktu_pulang" name="waktu_pulang" value="15:30" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                        </div>
                        
                        <!-- Durasi Belajar -->
                        <div>
                            <label for="durasi_belajar" class="block text-sm font-medium text-gray-700 mb-1">Durasi Belajar (Jam)</label>
                            <input type="number" id="durasi_belajar" name="durasi_belajar" value="8.5" step="0.5" min="0" max="24" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Catatan -->
                        <div>
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                            <textarea id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">Belum ada catatan</textarea>
                        </div>
                        
                        <!-- Bukti Dukungan -->
                        <div>
                            <label for="foto_bukti" class="block text-sm font-medium text-gray-700 mb-2">Foto Bukti Dukungan (Opsional)</label>
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 rounded-lg bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-300">
                                    <i class="fas fa-camera text-gray-400 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <label class="cursor-pointer btn-secondary px-4 py-2">
                                        <input type="file" name="foto_bukti" accept="image/*" class="hidden">
                                        <i class="fas fa-upload mr-2"></i>Pilih File
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG | Maksimal: 2MB</p>
                                </div>
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
    
    <!-- Modal Export -->
    <div id="modalExport" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalExport')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Export Data Absensi Siswa</h3>
                    <button onclick="closeModal('modalExport')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div>
                            <label for="format_export" class="block text-sm font-medium text-gray-700 mb-2">Format File</label>
                            <select id="format_export" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
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
                                    <span>Sertakan Foto Siswa</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" checked>
                                    <span>Lampirkan Bukti Absensi</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox">
                                    <span>Gabar Grafik Statistik</span>
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
        
        // Apply Filters
        function applyFilters() {
            const studentSearch = document.getElementById('student_search').value.toLowerCase();
            const classFilter = document.getElementById('class_filter').value;
            
            console.log('Filters:', { studentSearch, classFilter });
            
            if (studentSearch.length > 0 || classFilter !== '') {
                showEmptyState(true);
            } else {
                showEmptyState(false);
            }
        }
        
        // Reset Filters
        function resetFilters() {
            document.getElementById('student_search').value = '';
            document.getElementById('class_filter').value = '';
            showEmptyState(false);
        }
        
        // Show/Hide Empty State
        function showEmptyState(show) {
            const emptyState = document.getElementById('emptyState');
            const tableBody = document.querySelector('#attendanceContent tbody');
            
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