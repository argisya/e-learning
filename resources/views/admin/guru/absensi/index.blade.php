@extends('layouts.app')

@section('title', 'Users')

@section('content')
<body class="bg-gray-50 font-sans">
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Absensi Guru</h1>
                <p class="text-gray-500 mt-1 text-sm">Rekam kehadiran guru sesuai dengan periode waktu yang dipilih</p>
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
                
                <!-- Teacher Selection -->
                <div class="mb-6">
                    <label for="teacher_search" class="block text-sm font-medium text-gray-700 mb-2">Cari Guru</label>
                    <div class="relative">
                        <i class="fas fa-user-graduate absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="teacher_search" placeholder="Cari nama atau NIP..." 
                               class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    </div>
                </div>
                
                <!-- Class & Department Selection -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    
                    <!-- Kelas/Guru -->
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-700 mb-2">Departemen</label>
                        <select id="department" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                            <option value="">Semua Departemen</option>
                            <option value="IPA">MIPA</option>
                            <option value="IPS">IPS</option>
                            <option value="BHASA">Bahasa</option>
                            <option value="PKN">Pendidikan Kewarganegaraan</option>
                            <option value="TOMIN">Teknik Otomotif</option>
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
                            <p class="text-3xl font-bold mt-1">45</p>
                            <p class="text-xs opacity-80">hari kerja bulan ini</p>
                        </div>
                        
                        <div class="flex-1 border-l border-r border-white/20 px-6">
                            <div class="flex items-center gap-8 justify-center">
                                <div class="text-center">
                                    <p class="text-2xl font-bold">98%</p>
                                    <p class="text-xs opacity-80">Presentase Hadir</p>
                                </div>
                                <div class="w-px h-10 bg-white/20"></div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold">2%</p>
                                    <p class="text-xs opacity-80">Sakit/Izin</p>
                                </div>
                                <div class="w-px h-10 bg-white/20"></div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold">0%</p>
                                    <p class="text-xs opacity-80">Tidak Hadir</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-white text-center min-w-[120px]">
                            <span class="text-sm opacity-80">Total Guru</span>
                            <p class="text-3xl font-bold mt-1">32</p>
                            <p class="text-xs opacity-80">guru aktif</p>
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
                        <span class="text-gray-500">Total Guru:</span>
                        <span class="font-semibold text-gray-800">32 Guru</span>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">No</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Nama Lengkap</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">NIP</th>
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
                                            <p class="font-medium text-gray-800">Dr. Ahmad Fauzi, M.Pd.</p>
                                            <p class="text-xs text-gray-500">Mata Pelajaran: Matematika</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-700 font-mono text-xs">198501012008011001</td>
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
                                            <p class="font-medium text-gray-800">Bu Siti Aminah, S.Pd.</p>
                                            <p class="text-xs text-gray-500">Mata Pelajaran: Bahasa Indonesia</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-700 font-mono text-xs">198906022013012002</td>
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
                                            <p class="font-medium text-gray-800">Pak Budi Santoso, M.Si.</p>
                                            <p class="text-xs text-gray-500">Mata Pelajaran: Fisika</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-700 font-mono text-xs">199201022014011003</td>
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
                                            <p class="font-medium text-gray-800">Ibu Ratna Sari, S.Hist.</p>
                                            <p class="text-xs text-gray-500">Mata Pelajaran: Sejarah</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-700 font-mono text-xs">199003032012012004</td>
                                <td class="px-4 py-4 text-orange-600 font-medium">07:25 WIB <span class="text-xs font-normal">(±15 menit)</span></td>
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
                                            <p class="font-medium text-gray-800">Mr. John Smith</p>
                                            <p class="text-xs text-gray-500">Mata Pelajaran: Bahasa Inggris</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-gray-700 font-mono text-xs">199405052019011005</td>
                                <td class="px-4 py-4 text-gray-500 italic">-</td>
                                <td class="px-4 py-4 text-gray-500 italic">-</td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-alpa"><i class="fas fa-times-circle"></i> Tidak Hadir</span>
                                </td>
                                <td class="px-4 py-4 text-gray-600 text-xs">Cutur melahirkan anak</td>
                                <td class="px-4 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button class="icon-btn icon-view" onclick="openModal('modalDetail5')" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                        <button class="icon-btn icon-edit" onclick="openModal('modalEdit5')" title="Ubah Data"><i class="fas fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            
                            <!-- More rows would go here... -->
                            
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
                        Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">10</span> dari <span class="font-medium">32</span> data
                    </p>
                    <div class="flex items-center gap-2">
                        <button disabled class="pagination-btn-disabled px-4 py-2 rounded-lg border opacity-50 cursor-not-allowed"><i class="fas fa-chevron-left"></i></button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">...</button>
                        <button class="pagination-btn">4</button>
                        <button class="btn-pagination-active px-4 py-2 rounded-lg border"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    @endsection
    
    
    <!-- Modal Export -->
    <div id="modalExport" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalExport')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Export Data Absensi</h3>
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
                                    <span>Sertakan Foto Guru</span>
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
            const teacherSearch = document.getElementById('teacher_search').value.toLowerCase();
            const department = document.getElementById('department').value;
            
            console.log('Filters:', { teacherSearch, department });
            
            if (teacherSearch.length > 0 || department !== '') {
                showEmptyState(true);
            } else {
                showEmptyState(false);
            }
        }
        
        // Reset Filters
        function resetFilters() {
            document.getElementById('teacher_search').value = '';
            document.getElementById('department').value = '';
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