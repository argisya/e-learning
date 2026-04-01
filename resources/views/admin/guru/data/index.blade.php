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
            <a href="" class="btn-primary btn-action px-4 py-2">
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
                            <th scope="col" class="px-6 py-3 text-right hidden lg:table-cell">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach(range(1, 10) as $index)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-600">{{ $index }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/avatar.jpg') }}" alt="" 
                                         class="w-10 h-10 rounded-full object-cover border-2">
                                    <div>
                                        <p class="font-medium text-gray-800">Dr. Ahmad Fauzi, M.Pd.</p>
                                        <p class="text-xs text-gray-500">Guru Matematika</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700 font-mono text-xs">198501012008011001</td>
                            <td class="px-6 py-4 text-gray-700">Bandung, 15 Januari 1985</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-blue-50 text-blue-700">
                                    <i class="fas fa-mars"></i> Laki-laki
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">Islam</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-green-50 text-green-700">
                                    <i class="fas fa-ring"></i> Menikah
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">+62 812-3456-7890</td>
                            <td class="px-6 py-4 text-right hidden lg:table-cell">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="icon-btn icon-view" onclick="openModal('modalView{{ $index }}')" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="icon-btn icon-edit" onclick="openModal('modalEdit{{ $index }}')" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="icon-btn icon-delete" onclick="confirmDelete({{ $index }})" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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
                        @foreach(range(1, 10) as $index)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-600">{{ $index }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset('images/avatar.jpg') }}" alt="" 
                                         class="w-10 h-10 rounded-full object-cover border-2">
                                    <div>
                                        <p class="font-medium text-gray-800">Dr. Ahmad Fauzi, M.Pd.</p>
                                        <p class="text-xs text-gray-500">NIP: 198501012008011001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-700 font-mono text-xs">198501012008011001</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-blue-50 text-blue-700 font-medium">
                                    <i class="fas fa-check-circle"></i> PNS
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700">17 tahun 3 bulan</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-purple-50 text-purple-700 font-medium">
                                    <i class="fas fa-chalkboard-teacher"></i> Kepala Seksi Kurikulum
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-700 text-xs">SK: 012/SKB/PD/2020<br>tgl: 15-06-2020</td>
                            <td class="px-6 py-4 text-right hidden lg:table-cell">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="icon-btn icon-view" onclick="openModal('modalViewPeg{{ $index }}')" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="icon-btn icon-edit" onclick="openModal('modalEditPeg{{ $index }}')" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="icon-btn icon-delete" onclick="confirmDelete({{ $index }})" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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

<!-- ================= MODALS ================= -->

<!-- Modal View Detail (Identitas) -->
<div id="modalView1" class="modal fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalView1')"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-gradient-to-r from-primary-500 to-secondary-500 px-4 py-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-white" id="modal-title">Detail Data Guru</h3>
                    <button onclick="closeModal('modalView1')" class="text-white hover:text-gray-200 focus:outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="px-4 py-5">
                <!-- User Info -->
                <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                    <img src="{{ asset('images/avatar.jpg') }}" alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 border-primary-100">
                    <div>
                        <h4 class="text-xl font-bold text-gray-800">Dr. Ahmad Fauzi, M.Pd.</h4>
                        <p class="text-sm text-gray-500">Guru Matematika</p>
                        <p class="text-xs text-gray-400">NIP: 198501012008011001</p>
                    </div>
                </div>
                
                <!-- Data Table -->
                <dl class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                        <dd class="text-sm text-gray-800">Laki-laki</dd>
                        
                        <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                        <dd class="text-sm text-gray-800">15 Januari 1985</dd>
                        
                        <dt class="text-sm font-medium text-gray-500">Tempat Lahir</dt>
                        <dd class="text-sm text-gray-800">Bandung</dd>
                        
                        <dt class="text-sm font-medium text-gray-500">Agama</dt>
                        <dd class="text-sm text-gray-800">Islam</dd>
                        
                        <dt class="text-sm font-medium text-gray-500">Status Pernikahan</dt>
                        <dd class="text-sm text-gray-800">Menikah</dd>
                        
                        <dt class="text-sm font-medium text-gray-500">No HP</dt>
                        <dd class="text-sm text-gray-800">+62 812-3456-7890</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500 mb-1">Alamat</dt>
                        <dd class="text-sm text-gray-800">Jl. Merdeka No. 123, Kota Bandung, Jawa Barat 40111</dd>
                    </div>
                </dl>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button onclick="closeModal('modalView1')" class="btn-primary w-full sm:w-auto">Tutup</button>
                <button class="mt-3 w-full inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Edit Data</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div id="modalEdit1" class="modal fixed inset-0 z-[100] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75" onclick="closeModal('modalEdit1')"></div>
        <div class="relative bg-white rounded-xl max-w-3xl w-full mx-4">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <h3 class="text-lg font-bold text-gray-800">Edit Data Guru</h3>
                <button onclick="closeModal('modalEdit1')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Lengkap -->
                    <div class="form-group">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama" class="input-field" value="Dr. Ahmad Fauzi, M.Pd." required>
                    </div>
                    
                    <!-- NIP -->
                    <div class="form-group">
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP <span class="text-red-500">*</span></label>
                        <input type="text" id="nip" class="input-field" value="198501012008011001" readonly>
                    </div>
                    
                    <!-- Tempat Lahir -->
                    <div class="form-group">
                        <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" class="input-field" value="Bandung">
                    </div>
                    
                    <!-- Tanggal Lahir -->
                    <div class="form-group">
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" class="input-field" value="1985-01-15">
                    </div>
                    
                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="jk" class="form-radio" checked>
                                <span>Laki-laki</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="jk" class="form-radio">
                                <span>Perempuan</span>
                            </label>
                        </div>
                    </div>
                    
                    <!-- Agama -->
                    <div class="form-group">
                        <label for="agama" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                        <select id="agama" class="form-select">
                            <option value="Islam" selected>Islam</option>
                            <option value="Kristen Protestan">Kristen Protestan</option>
                            <option value="Kristen Katolik">Kristen Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                    </div>
                    
                    <!-- Status Perkawinan -->
                    <div class="form-group">
                        <label for="status_perkawinan" class="block text-sm font-medium text-gray-700 mb-1">Status Perkawinan</label>
                        <select id="status_perkawinan" class="form-select">
                            <option value="Belum Kawin">Belum Kawin</option>
                            <option value="Kawin" selected>Menikah</option>
                            <option value="Cerai Hidup">Cerai Hidup</option>
                            <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                    </div>
                    
                    <!-- No HP -->
                    <div class="form-group">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No. Handphone</label>
                        <input type="tel" id="no_hp" class="input-field" value="+62 812-3456-7890">
                    </div>
                    
                    <!-- Alamat -->
                    <div class="form-group col-span-1 md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                        <textarea id="alamat" class="input-field" rows="3">Jl. Merdeka No. 123, Kota Bandung, Jawa Barat 40111</textarea>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex justify-end gap-3 mt-8 pt-6 border-t">
                    <button type="button" onclick="closeModal('modalEdit1')" class="btn-secondary">Batal</button>
                    <button type="submit" class="btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Confirmation Delete -->
<div id="modalDelete" class="modal fixed inset-0 z-[100] hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75" onclick="closeModal('modalDelete')"></div>
        <div class="relative bg-white rounded-xl max-w-md w-full mx-4 p-6">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Konfirmasi Hapus Data</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data guru ini? Data tidak dapat dikembalikan setelah dihapus.</p>
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-center gap-3">
                        <button type="button" onclick="closeModal('modalDelete')" class="btn-secondary">Batal</button>
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-2.5 rounded-lg transition-colors">Ya, Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Switch Tab
function switchTab(tabName) {
    // Hide all panels
    document.getElementById('panel-identitas').classList.add('hidden');
    document.getElementById('panel-pegawai').classList.add('hidden');
    
    // Remove active state from buttons
    document.getElementById('tab-identitas').classList.remove('active');
    document.getElementById('tab-pegawai').classList.remove('active');
    
    // Show selected panel
    document.getElementById('panel-' + tabName).classList.remove('hidden');
    document.getElementById('tab-' + tabName).classList.add('active');
}

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
    openModal('modalDelete');
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal.open').forEach(modal => {
            modal.classList.add('hidden');
        });
    }
});

// Filter Form (Mock)
document.querySelector('[onclick="openModal(\'modalFilter\')"]').addEventListener('click', () => {
    alert('Filter dialog akan dibuka di sini');
});
</script>
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