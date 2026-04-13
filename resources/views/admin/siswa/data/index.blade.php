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
                        <p class="text-2xl font-bold text-gray-800 mt-1">450</p>
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
                        <p class="text-2xl font-bold text-gray-800 mt-1">230</p>
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
                        <p class="text-2xl font-bold text-gray-800 mt-1">220</p>
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
                                        <i class="fas fa-users"></i> {{ $student->id_kelas }}
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
                                        <form action="{{ route('admin.siswa.data.destroy', $student->nis) }}" method="POST" class="inline-flex items-center m-0" onsubmit="return confirm('Apakah Anda yakin?')">
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
    
    <!-- ================= MODALS ================= -->
    
    <!-- Modal View Detail -->
    <div id="modalView1" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalView1')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Detail Data Siswa</h3>
                    <button onclick="closeModal('modalView1')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    
                    <!-- Student Profile -->
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                        <img src="{{ asset('images/avatar.jpg') }}" alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 border-primary-100">
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-800">Ahmad Rizky Pratama</h4>
                            <p class="text-sm text-gray-500">VII A</p>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge badge-active mt-2">
                                <span class="status-dot status-active"></span> Aktif
                            </span>
                        </div>
                    </div>
                    
                    <!-- Info Grid -->
                    <dl class="space-y-4 text-sm">
                        <div class="grid grid-cols-2 gap-4">
                            <dt class="font-medium text-gray-500">NIS</dt>
                            <dd class="text-gray-800 font-mono">2024001</dd>
                            
                            <dt class="font-medium text-gray-500">NISN</dt>
                            <dd class="text-gray-800 font-mono">0012345678</dd>
                            
                            <dt class="font-medium text-gray-500">Jenis Kelamin</dt>
                            <dd class="text-gray-800"><i class="fas fa-mars text-blue-600 mr-1"></i> Laki-laki</dd>
                            
                            <dt class="font-medium text-gray-500">Tanggal Lahir</dt>
                            <dd class="text-gray-800">15 Agustus 2010</dd>
                            
                            <dt class="font-medium text-gray-500">Agama</dt>
                            <dd class="text-gray-800">Islam</dd>
                            
                            <dt class="font-medium text-gray-500">Email</dt>
                            <dd class="text-gray-800">ahmad.rizky@gmail.com</dd>
                            
                            <dt class="font-medium text-gray-500">No. Handphone</dt>
                            <dd class="text-gray-800">+62 812-3456-7890</dd>
                        </div>
                        
                        <div>
                            <dt class="font-medium text-gray-500 mb-1">Alamat Lengkap</dt>
                            <dd class="text-gray-800 text-sm">
                                Jl. Merdeka No. 123, Kelurahan Ciumbuleuit,<br>
                                Kecamatan Coblong, Kota Bandung, Jawa Barat<br>
                                Kode Pos: 40132
                            </dd>
                        </div>
                        
                        <!-- Guardian Info -->
                        <hr class="border-gray-200 my-4">
                        
                        <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <i class="fas fa-home text-blue-600 text-xl mt-1"></i>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800 text-sm">Informasi Orang Tua</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Nama Ayah: Bapak Rizki Pratama<br>
                                    Nama Ibu: Ibu Siti Aminah<br>
                                    Pekerjaan Ayah: Wiraswasta<br>
                                    pekerjaan Ibu: Ibu Rumah Tangga
                                </p>
                            </div>
                        </div>
                    </dl>
                </div>
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t flex justify-end gap-3">
                    <button onclick="closeModal('modalView1')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Tutup</button>
                    <button onclick="closeModal('modalView1')" class="inline-flex items-center justify-center gap-2 px-4 py-2 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">Edit Data</button>
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
                    <h3 class="text-lg font-bold">Edit Data Siswa</h3>
                    <button onclick="closeModal('modalEdit1')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-6">
                        
                        <!-- Foto Siswa -->
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-lg bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-300">
                                <img src="{{ asset('images/avatar.jpg') }}" alt="Foto" class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="flex-1">
                                <label class="cursor-pointer btn-secondary px-4 py-2 w-full">
                                    <input type="file" name="foto_siswa" accept="image/*" class="hidden">
                                    <i class="fas fa-upload mr-2"></i>Ubah Foto
                                </label>
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG | Maksimal: 2MB</p>
                            </div>
                        </div>
                        
                        <!-- Identitas -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Identitas Pribadi</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="nama_lengkap_edit" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" id="nama_lengkap_edit" name="nama_lengkap_edit" value="Ahmad Rizky Pratama" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="nis_edit" class="block text-sm font-medium text-gray-700 mb-1">NIS <span class="text-red-500">*</span></label>
                                    <input type="text" id="nis_edit" name="nis_edit" value="2024001" readonly class="w-full px-4 py-2.5 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-500 cursor-not-allowed">
                                </div>
                                <div>
                                    <label for="nisn_edit" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                                    <input type="text" id="nisn_edit" name="nisn_edit" value="0012345678" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="kelas_edit" class="block text-sm font-medium text-gray-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                                    <select id="kelas_edit" name="kelas_edit" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                        <option value="VII A" selected>VII A</option>
                                        <option value="VII B">VII B</option>
                                        <option value="VIII A">VIII A</option>
                                        <option value="VIII B">VIII B</option>
                                        <option value="IX A">IX A</option>
                                        <option value="X IPA">X IPA</option>
                                        <option value="XI IPS">XI IPS</option>
                                        <option value="XII IPA">XII IPA</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                                    <div class="flex items-center gap-6">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="jenis_kelamin_edit" value="Laki-laki" checked {{ old('jenis_kelamin', 'Laki-laki') === 'Laki-laki' ? 'checked' : '' }}>
                                            <span class="text-gray-700">Laki-laki</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="jenis_kelamin_edit" value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'checked' : '' }}>
                                            <span class="text-gray-700">Perempuan</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label for="tgl_lahir_edit" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                    <input type="date" id="tgl_lahir_edit" name="tgl_lahir_edit" value="2010-08-15" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="agama_edit" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                                    <select id="agama_edit" name="agama_edit" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                        <option value="Islam" selected>Islam</option>
                                        <option value="Kristen Protestan">Kristen Protestan</option>
                                        <option value="Kristen Katolik">Kristen Katolik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Buddha">Buddha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Kontak -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Informasi Kontak</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="email_edit" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                    <input type="email" id="email_edit" name="email_edit" value="ahmad.rizky@gmail.com" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="no_hp_edit" class="block text-sm font-medium text-gray-700 mb-1">No. Handphone</label>
                                    <input type="tel" id="no_hp_edit" name="no_hp_edit" value="+62 812-3456-7890" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="alamat_edit" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                                <textarea id="alamat_edit" name="alamat_edit" rows="2" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">Jl. Merdeka No. 123, Bandung</textarea>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <h3 class="text-sm font-semibold text-gray-700 mb-3 border-b pb-2">Status Akademik</h3>
                            <div>
                                <label for="status_edit" class="block text-sm font-medium text-gray-700 mb-2">Status Siswa <span class="text-red-500">*</span></label>
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
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus Data Siswa</h3>
                    <p class="text-gray-600 text-sm mb-6">Apakah Anda yakin ingin menghapus data siswa ini? Tindakan ini tidak dapat dibatalkan!</p>
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
    
    <!-- Modal Import -->
    <div id="modalImport" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalImport')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Import Data Siswa</h3>
                    <button onclick="closeModal('modalImport')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div>
                            <label for="import_file" class="block text-sm font-medium text-gray-700 mb-2">Pilih File Excel/CSV</label>
                            <div class="flex items-center gap-4">
                                <div class="flex-1">
                                    <label class="cursor-pointer btn-secondary px-4 py-3 w-full text-center">
                                        <input type="file" id="import_file" name="import_file" accept=".xls,.xlsx,.csv" class="hidden">
                                        <i class="fas fa-file-excel mr-2"></i>Pilih File
                                    </label>
                                </div>
                                <div class="flex-1 text-sm text-gray-500 text-center">
                                    <p>Format: XLSX, CSV</p>
                                    <p>Maksimal: 10 MB</p>
                                </div>
                            </div>
                            <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-info-circle text-blue-600 text-xl mt-1"></i>
                                    <div class="flex-1">
                                        <p class="font-medium text-gray-800 text-sm">Template Download</p>
                                        <p class="text-xs text-gray-500 mt-1">Download template format file terlebih dahulu sebelum upload data siswa.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" checked onchange="enableDisableFields()">
                                <span>Update jika data sudah ada</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-1">Centang untuk mengupdate data jika NIS/NISN sudah ada di sistem</p>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="flex justify-end gap-3 pt-6 mt-6 border-t">
                        <button onclick="closeModal('modalImport')" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Batal</button>
                        <button class="inline-flex items-center justify-center gap-2 px-4 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                            <i class="fas fa-upload mr-2"></i>Upload Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Export Student -->
    <div id="modalExportStudent" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalExportStudent')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Export Data Siswa</h3>
                    <button onclick="closeModal('modalExportStudent')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        <div>
                            <label for="format_export_student" class="block text-sm font-medium text-gray-700 mb-2">Format File</label>
                            <select id="format_export_student" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
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
                                    <span>Lampirkan Rekap Nilai Rata-Rata</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox">
                                    <span>Gabar Grafik Statistik Kelas</span>
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
                        <button onclick="closeModal('modalExportStudent')" class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Batal</button>
                        <button class="inline-flex items-center justify-center gap-2 px-4 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                            <i class="fas fa-download mr-2"></i>Export Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
        @vite(['resources/js/modal.js',
                'resources/js/validation.js',
                'resources/js/filter.js',
        ])
    @endpush