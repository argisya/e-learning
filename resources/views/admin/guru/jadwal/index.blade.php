@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-7xl mx-auto mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Jadwal Mengajar Guru</h1>
                <p class="text-gray-500 mt-1 text-sm">Lihat jadwal mengajar guru berdasarkan kelas yang dipilih</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-print"></i> Cetak
                </button>
                <button onclick="openModal('modalExportSchedule')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-download"></i> Export
                </button>
            </div>
        </div>
        
        <!-- Filter Section -->
        <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden mb-8">
            <div class="p-6 border-b bg-gray-50">
                
                <!-- Teacher Name Input -->
                <div class="mb-6">
                    <label for="teacher_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Guru</label>
                    <div class="relative">
                        <i class="fas fa-user-graduate absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="teacher_name" placeholder="Cari nama guru..." 
                               class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    </div>
                </div>
                
                <!-- Class Selection Tabs -->
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Pilih Kelas</h3>
                    <div class="flex flex-wrap gap-2" id="classTabs">
                        
                        <!-- Tab Buttons -->
                        <button class="class-tab active px-4 py-2 bg-primary-50 text-primary-600 rounded-lg text-sm font-medium transition-colors" data-class="all">
                            Semua Kelas
                        </button>
                        
                        <button class="class-tab px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 hover:border-primary-500 hover:text-primary-600 transition-colors" data-class="VII">
                            VII A
                        </button>
                        
                        <button class="class-tab px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 hover:border-primary-500 hover:text-primary-600 transition-colors" data-class="VIII">
                            VIII A
                        </button>
                        
                        <button class="class-tab px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 hover:border-primary-500 hover:text-primary-600 transition-colors" data-class="IX">
                            IX A
                        </button>
                        
                        <button class="class-tab px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 hover:border-primary-500 hover:text-primary-600 transition-colors" data-class="X">
                            X IPA
                        </button>
                        
                        <button class="class-tab px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 hover:border-primary-500 hover:text-primary-600 transition-colors" data-class="XI">
                            XI IPS
                        </button>
                        
                        <button class="class-tab px-4 py-2 bg-white border border-gray-200 rounded-lg text-sm text-gray-600 hover:border-primary-500 hover:text-primary-600 transition-colors" data-class="XII">
                            XII IPA
                        </button>
                        
                    </div>
                </div>
                
                <!-- Date Range & View Options -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    
                    <!-- Date Start -->
                    <div>
                        <label for="date_start" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Awal</label>
                        <input type="date" id="date_start" value="{{ date('Y-m-d') }}" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    </div>
                    
                    <!-- Date End -->
                    <div>
                        <label for="date_end" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                        <input type="date" id="date_end" value="{{ date('Y-m-d', strtotime('+1 week')) }}" 
                               class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                    </div>
                    
                    <!-- Time Filter -->
                    <div>
                        <label for="time_filter" class="block text-sm font-medium text-gray-700 mb-2">Filter Waktu</label>
                        <select id="time_filter" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                            <option value="">Semua Waktu</option>
                            <option value="morning">Pagi (07:00-10:00)</option>
                            <option value="afternoon">Sore (10:00-13:00)</option>
                            <option value="evening">Malam (13:00-16:00)</option>
                        </select>
                    </div>
                    
                    <!-- Apply Filters -->
                    <div class="flex items-end">
                        <button onclick="applyFilters()" class="w-full px-4 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                            <i class="fas fa-filter mr-2"></i>Tampilkan Jadwal
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Stats Overview -->
            <div class="px-6 py-4 bg-gradient-to-r from-primary-500 to-secondary-500">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="text-white">
                        <span class="text-sm">Total Jam Mengajar:</span>
                        <span class="ml-2 font-bold text-lg">45 jam/minggu</span>
                    </div>
                    <div class="text-white">
                        <span class="text-sm">Guru Aktif:</span>
                        <span class="ml-2 font-bold text-lg">32 guru</span>
                    </div>
                    <div class="text-white">
                        <span class="text-sm">Kelas Terpakai:</span>
                        <span class="ml-2 font-bold text-lg">12 kelas</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Schedule Content -->
        <div id="scheduleContent" class="max-w-7xl mx-auto space-y-6">
            
            <!-- Today's Schedule -->
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                <div class="p-6 border-b flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-calendar-day"></i>
                        </span>
                        Jadwal Hari Ini - {{ now()->isoFormat('dddd, D MMMM YYYY') }}
                    </h2>
                    <span class="text-sm text-gray-500">{{ now()->isoFormat('DD/MM/YYYY') }}</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Waktu</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Hari</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Kelas</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Mata Pelajaran</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Guru</th>
                                <th scope="col" class="px-4 py-3 text-left font-semibold text-gray-700">Ruang</th>
                                <th scope="col" class="px-4 py-3 text-right font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            
                            <!-- Morning Session -->
                            <tr class="hover:bg-gray-50 transition-colors slot-morning">
                                <td class="px-4 py-4 text-gray-600"><span class="font-medium">07:00 - 08:30</span></td>
                                <td class="px-4 py-4"><span class="badge-badge">Senin</span></td>
                                <td class="px-4 py-4"><span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-blue-50 text-blue-700 text-xs font-medium"><i class="fas fa-users"></i> VII A</span></td>
                                <td class="px-4 py-4"><span class="font-medium text-gray-800">Matematika</span></td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-8 h-8 rounded-full object-cover border-2">
                                        <span class="font-medium text-gray-800">Dr. Ahmad Fauzi, M.Pd.</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4"><span class="badge-badge">R101</span></td>
                                <td class="px-4 py-4 text-right">
                                    <button onclick="openModal('modalDetail1')" class="icon-btn icon-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                    <button onclick="openModal('modalEdit1')" class="icon-btn icon-edit" title="Ubah Jadwal"><i class="fas fa-pen"></i></button>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50 transition-colors slot-morning">
                                <td class="px-4 py-4 text-gray-600"><span class="font-medium">07:00 - 08:30</span></td>
                                <td class="px-4 py-4"><span class="badge-badge">Senin</span></td>
                                <td class="px-4 py-4"><span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-green-50 text-green-700 text-xs font-medium"><i class="fas fa-users"></i> VIII A</span></td>
                                <td class="px-4 py-4"><span class="font-medium text-gray-800">Bahasa Indonesia</span></td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-8 h-8 rounded-full object-cover border-2">
                                        <span class="font-medium text-gray-800">Bu Siti Aminah, S.Pd.</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4"><span class="badge-badge">R102</span></td>
                                <td class="px-4 py-4 text-right">
                                    <button onclick="openModal('modalDetail2')" class="icon-btn icon-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                    <button onclick="openModal('modalEdit2')" class="icon-btn icon-edit" title="Ubah Jadwal"><i class="fas fa-pen"></i></button>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50 transition-colors slot-morning">
                                <td class="px-4 py-4 text-gray-600"><span class="font-medium">08:30 - 10:00</span></td>
                                <td class="px-4 py-4"><span class="badge-badge">Senin</span></td>
                                <td class="px-4 py-4"><span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-purple-50 text-purple-700 text-xs font-medium"><i class="fas fa-users"></i> IX A</span></td>
                                <td class="px-4 py-4"><span class="font-medium text-gray-800">IPA Terpadu</span></td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-8 h-8 rounded-full object-cover border-2">
                                        <span class="font-medium text-gray-800">Pak Budi Santoso, M.Si.</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4"><span class="badge-badge">Lab IPA</span></td>
                                <td class="px-4 py-4 text-right">
                                    <button onclick="openModal('modalDetail3')" class="icon-btn icon-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                    <button onclick="openModal('modalEdit3')" class="icon-btn icon-edit" title="Ubah Jadwal"><i class="fas fa-pen"></i></button>
                                </td>
                            </tr>
                            
                            <!-- Afternoon Session -->
                            <tr class="hover:bg-gray-50 transition-colors slot-afternoon">
                                <td class="px-4 py-4 text-gray-600"><span class="font-medium">10:00 - 11:30</span></td>
                                <td class="px-4 py-4"><span class="badge-badge">Senin</span></td>
                                <td class="px-4 py-4"><span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-orange-50 text-orange-700 text-xs font-medium"><i class="fas fa-users"></i> X IPA</span></td>
                                <td class="px-4 py-4"><span class="font-medium text-gray-800">Fisika</span></td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-8 h-8 rounded-full object-cover border-2">
                                        <span class="font-medium text-gray-800">Pak Joko Susilo, S.Si.</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4"><span class="badge-badge">Lab Fisika</span></td>
                                <td class="px-4 py-4 text-right">
                                    <button onclick="openModal('modalDetail4')" class="icon-btn icon-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                    <button onclick="openModal('modalEdit4')" class="icon-btn icon-edit" title="Ubah Jadwal"><i class="fas fa-pen"></i></button>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50 transition-colors slot-afternoon">
                                <td class="px-4 py-4 text-gray-600"><span class="font-medium">11:30 - 13:00</span></td>
                                <td class="px-4 py-4"><span class="badge-badge">Senin</span></td>
                                <td class="px-4 py-4"><span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-yellow-50 text-yellow-700 text-xs font-medium"><i class="fas fa-users"></i> XI IPS</span></td>
                                <td class="px-4 py-4"><span class="font-medium text-gray-800">Sejarah Indonesia</span></td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-8 h-8 rounded-full object-cover border-2">
                                        <span class="font-medium text-gray-800">Ibu Ratna Sari, S.Hist.</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4"><span class="badge-badge">R201</span></td>
                                <td class="px-4 py-4 text-right">
                                    <button onclick="openModal('modalDetail5')" class="icon-btn icon-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                    <button onclick="openModal('modalEdit5')" class="icon-btn icon-edit" title="Ubah Jadwal"><i class="fas fa-pen"></i></button>
                                </td>
                            </tr>
                            
                            <!-- Tuesday -->
                            <tr class="hover:bg-gray-50 transition-colors slot-morning">
                                <td class="px-4 py-4 text-gray-600"><span class="font-medium">07:00 - 08:30</span></td>
                                <td class="px-4 py-4"><span class="badge-badge">Selasa</span></td>
                                <td class="px-4 py-4"><span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-blue-50 text-blue-700 text-xs font-medium"><i class="fas fa-users"></i> XII IPA</span></td>
                                <td class="px-4 py-4"><span class="font-medium text-gray-800">Kimia</span></td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-8 h-8 rounded-full object-cover border-2">
                                        <span class="font-medium text-gray-800">Bu Dwi Lestari, S.Pd., M.Si.</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4"><span class="badge-badge">Lab Kimia</span></td>
                                <td class="px-4 py-4 text-right">
                                    <button onclick="openModal('modalDetail6')" class="icon-btn icon-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                    <button onclick="openModal('modalEdit6')" class="icon-btn icon-edit" title="Ubah Jadwal"><i class="fas fa-pen"></i></button>
                                </td>
                            </tr>
                            
                            <tr class="hover:bg-gray-50 transition-colors slot-afternoon">
                                <td class="px-4 py-4 text-gray-600"><span class="font-medium">10:00 - 11:30</span></td>
                                <td class="px-4 py-4"><span class="badge-badge">Selasa</span></td>
                                <td class="px-4 py-4"><span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-green-50 text-green-700 text-xs font-medium"><i class="fas fa-users"></i> VII A</span></td>
                                <td class="px-4 py-4"><span class="font-medium text-gray-800">Bahasa Inggris</span></td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2">
                                        <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-8 h-8 rounded-full object-cover border-2">
                                        <span class="font-medium text-gray-800">Mr. John Smith</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4"><span class="badge-badge">R103</span></td>
                                <td class="px-4 py-4 text-right">
                                    <button onclick="openModal('modalDetail7')" class="icon-btn icon-view" title="Lihat Detail"><i class="fas fa-eye"></i></button>
                                    <button onclick="openModal('modalEdit7')" class="icon-btn icon-edit" title="Ubah Jadwal"><i class="fas fa-pen"></i></button>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                
                <!-- Empty State -->
                <div id="emptyState" class="hidden p-8 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Tidak Ada Jadwal</h3>
                    <p class="text-gray-500 mb-6">Tidak ditemukan jadwal untuk kriteria yang dipilih</p>
                    <button onclick="resetFilters()" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors">
                        <i class="fas fa-redo"></i> Reset Filter
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endsection    
    <!-- ================= MODALS ================= -->
    
    <!-- Modal Detail Jadwal -->
    <div id="modalDetail1" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalDetail1')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Detail Jadwal Mengajar</h3>
                    <button onclick="closeModal('modalDetail1')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    
                    <!-- Subject Info -->
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                        <div class="w-16 h-16 rounded-xl bg-primary-100 flex items-center justify-center">
                            <i class="fas fa-book-open text-primary-600 text-2xl"></i>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800">Matematika</h4>
                            <p class="text-sm text-gray-500">Kelas VII A - Semester Ganjil</p>
                        </div>
                    </div>
                    
                    <!-- Schedule Info -->
                    <dl class="space-y-4 text-sm">
                        <div class="grid grid-cols-2 gap-4">
                            <dt class="font-medium text-gray-500">Hari/Tanggal</dt>
                            <dd class="text-gray-800">Senin, {{ now()->isoFormat('D MMMM YYYY') }}</dd>
                            
                            <dt class="font-medium text-gray-500">Waktu</dt>
                            <dd class="text-gray-800">07:00 - 08:30 WIB</dd>
                            
                            <dt class="font-medium text-gray-500">Ruang Kelas</dt>
                            <dd class="text-gray-800">R101</dd>
                            
                            <dt class="font-medium text-gray-500">Status</dt>
                            <dd class="text-gray-800">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-green-100 text-green-700 font-medium">
                                    <span class="status-dot status-active"></span>Ditelaksanakan
                                </span>
                            </dd>
                        </div>
                        
                        <hr class="border-gray-200 my-4">
                        
                        <!-- Teacher Info -->
                        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                            <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-12 h-12 rounded-full object-cover border-2">
                            <div>
                                <p class="font-semibold text-gray-800">Dr. Ahmad Fauzi, M.Pd.</p>
                                <p class="text-sm text-gray-500">NIP: 198501012008011001</p>
                            </div>
                        </div>
                        
                        <!-- Attendance -->
                        <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <i class="fas fa-check-circle text-blue-600 text-xl mt-1"></i>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800">Absensi Siswa</p>
                                <p class="text-sm text-gray-500 mt-1">Hadir: 32/35 | Sakit: 2 | Ijin: 1 | Tidak Hadir: 0</p>
                            </div>
                            <button class="inline-flex items-center gap-1 px-3 py-1 bg-white border border-blue-300 rounded-lg text-blue-600 text-sm font-medium hover:bg-blue-50 transition-colors">
                                <i class="fas fa-edit"></i>Absen
                            </button>
                        </div>
                    </dl>
                </div>
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t flex justify-end gap-3">
                    <button onclick="closeModal('modalDetail1')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Tutup</button>
                    <button onclick="closeModal('modalDetail1')" class="inline-flex items-center justify-center gap-2 px-4 py-2 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">Edit Jadwal</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Edit Jadwal -->
    <div id="modalEdit1" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalEdit1')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Edit Jadwal Mengajar</h3>
                    <button onclick="closeModal('modalEdit1')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <form action="#" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        
                        <!-- Mata Pelajaran -->
                        <div>
                            <label for="mata_pelajaran" class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran <span class="text-red-500">*</span></label>
                            <select id="mata_pelajaran" name="mata_pelajaran" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="Matematika" selected>Matematika</option>
                                <option value="Fisika">Fisika</option>
                                <option value="Kimia">Kimia</option>
                                <option value="Biologi">Biologi</option>
                                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                                <option value="Bahasa Inggris">Bahasa Inggris</option>
                            </select>
                        </div>
                        
                        <!-- Waktu -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai <span class="text-red-500">*</span></label>
                                <input type="time" id="jam_mulai" name="jam_mulai" value="07:00" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                            <div>
                                <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-1">Jam Selesai <span class="text-red-500">*</span></label>
                                <input type="time" id="jam_selesai" name="jam_selesai" value="08:30" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                        </div>
                        
                        <!-- Ruang Kelas -->
                        <div>
                            <label for="ruang_kelas" class="block text-sm font-medium text-gray-700 mb-1">Ruang Kelas <span class="text-red-500">*</span></label>
                            <select id="ruang_kelas" name="ruang_kelas" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="R101" selected>R101</option>
                                <option value="R102">R102</option>
                                <option value="R103">R103</option>
                                <option value="Lab IPA">Lab IPA</option>
                                <option value="Lab Fisika">Lab Fisika</option>
                                <option value="Lab Kimia">Lab Kimia</option>
                            </select>
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Jadwal <span class="text-red-500">*</span></label>
                            <div class="flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status_jadwal" value="dilaksanakan" checked {{ old('status_jadwal', 'dilaksanakan') === 'dilaksanakan' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Ditelaksanakan</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status_jadwal" value="tidak_dilaksanakan" {{ old('status_jadwal') === 'tidak_dilaksanakan' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Tidak Telaksanakan</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status_jadwal" value="diganti" {{ old('status_jadwal') === 'diganti' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Diganti</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Catatan -->
                        <div>
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                            <textarea id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">Belum ada catatan</textarea>
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
    
    <!-- Modal Export Schedule -->
    <div id="modalExportSchedule" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalExportSchedule')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Export Jadwal Mengajar</h3>
                    <button onclick="closeModal('modalExportSchedule')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
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
                                    <span>Sertakan Absensi Siswa</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" checked>
                                    <span>Sertakan Foto Guru</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox">
                                    <span>Catat Keterangan Khusus</span>
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
                        <button onclick="closeModal('modalExportSchedule')" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Batal</button>
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
            const teacherName = document.getElementById('teacher_name').value.toLowerCase();
            const timeFilter = document.getElementById('time_filter').value;
            
            console.log('Filters:', { teacherName, timeFilter });
            
            // Show/Hide empty state
            if (teacherName.length > 0 || timeFilter !== '') {
                showEmptyState(true);
            } else {
                showEmptyState(false);
            }
        }
        
        // Reset Filters
        function resetFilters() {
            document.getElementById('teacher_name').value = '';
            document.getElementById('time_filter').value = '';
            showEmptyState(false);
        }
        
        // Show/Hide Empty State
        function showEmptyState(show) {
            const emptyState = document.getElementById('emptyState');
            const tableBody = document.querySelector('#scheduleContent tbody');
            
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
        
        // Class Tab Switcher
        document.querySelectorAll('.class-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.class-tab').forEach(t => {
                    t.classList.remove('active', 'bg-primary-50', 'text-primary-600');
                    t.classList.add('bg-white', 'text-gray-600');
                });
                
                this.classList.remove('bg-white', 'text-gray-600');
                this.classList.add('active', 'bg-primary-50', 'text-primary-600');
                
                // Add active border to row indicator (visual only)
                document.querySelectorAll('.time-slot-active').forEach(el => el.classList.remove('border-r-4'));
            });
        });
        
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