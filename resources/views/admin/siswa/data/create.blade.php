@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-3xl mx-auto mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Tambah Siswa</h1>
                <p class="text-gray-500 mt-1 text-sm">Isi formulir di bawah ini untuk menambahkan siswa baru ke sistem</p>
            </div>
            <a href="{{ route('admin.siswa.data.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-primary-600 transition-colors">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <!-- Content Card -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden">
            <form action="{{ route('admin.siswa.data.store') }}" method="POST" enctype="multipart/form-data" novalidate id="createForm" class="p-6 lg:p-8">
                
                @csrf
                
                <!-- Section 1: Identitas Pribadi -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-user-circle"></i>
                        </span>
                        Identitas Pribadi
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Nama Lengkap -->
                        <div class="md:col-span-2">
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="hidden" id="id_user" name="id_user" value="{{ old('id_user') }}" required>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap sesuai ijazah" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_lengkap')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- NIS -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">NIS <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="text" id="username" name="nis" value="{{ old('username') }}" placeholder="08 digit angka" required maxlength="18" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all font-mono">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">NIS akan di-generate otomatis berdasarkan tahun ajaran</p>
                            @error('username')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- NISN -->
                        <div>
                            <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                            <div class="relative">
                                <i class="fas fa-id-card absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}" pattern="\d{10}" maxlength="10" placeholder="10 digit NISN" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all font-mono">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Min. 10 digit angka</p>
                        </div>
                        
                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('tempat_lahir')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required max="{{ date('Y-m-d', strtotime('-14 years')) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('tanggal_lahir')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="gender" value="Laki-laki" {{ old('gender', 'Laki-laki') === 'Laki-laki' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-primary-500 peer-checked:border-primary-500 peer-checked:bg-primary-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-2 peer-checked:bg-primary-500 peer-checked:text-white transition-colors">
                                            <i class="fas fa-mars text-blue-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Laki-laki</p>
                                    </div>
                                </label>
                                
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="gender" value="Perempuan" {{ old('gender') === 'Perempuan' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-primary-500 peer-checked:border-primary-500 peer-checked:bg-pink-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-pink-100 flex items-center justify-center mb-2 peer-checked:bg-pink-500 peer-checked:text-white transition-colors">
                                            <i class="fas fa-venus text-pink-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Perempuan</p>
                                    </div>
                                </label>
                            </div>
                            @error('gender')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Agama -->
                        <div>
                            <label for="agama" class="block text-sm font-medium text-gray-700 mb-1">Agama <span class="text-red-500">*</span></label>
                            <select id="agama" name="agama" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Agama --</option>
                                <option value="Islam" {{ old('agama') === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen Protestan" {{ old('agama') === 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                <option value="Kristen Katolik" {{ old('agama') === 'Kristen Katolik' ? 'selected' : '' }}>Kristen Katolik</option>
                                <option value="Hindu" {{ old('agama') === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                            @error('agama')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                
                <!-- Section 2: Informasi Akademik -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-book"></i>
                        </span>
                        Informasi Akademik
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Kelas -->
                        <div>
                            <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kelas <span class="text-red-500">*</span></label>
                            <select id="kelas_id" name="kelas_id" required onchange="generateNIS(this.value)" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach(range(1, 12) as $classId)
                                    <option value="{{ $classId }}">{{ old('kelas_id') === $classId ? 'Selected' : '' }} Kelas VII A</option>
                                @endforeach
                            </select>
                            @error('kelas_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            <p class="text-xs text-gray-500 mt-1">Kelas akan menentukan NIS dan program keahlian</p>
                        </div>
                        
                        <!-- Program Keahlian -->
                        <div>
                            <label for="program_keahlian" class="block text-sm font-medium text-gray-700 mb-1">Program Keahlian</label>
                            <select id="program_keahlian" name="program_keahlian" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Auto Detect --</option>
                                <option value="IPA" {{ old('program_keahlian') === 'IPA' ? 'selected' : '' }}>IPA</option>
                                <option value="IPS" {{ old('program_keahlian') === 'IPS' ? 'selected' : '' }}>IPS</option>
                                <option value="Bahasa" {{ old('program_keahlian') === 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                            </select>
                        </div>
                        
                        <!-- Tahun Masuk -->
                        <div>
                            <label for="tahun_masuk" class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk <span class="text-red-500">*</span></label>
                            <input type="number" id="tahun_masuk" name="tahun_masuk" value="{{ old('tahun_masuk', date('Y')) }}" min="2000" max="{{ date('Y') + 5 }}" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('tahun_masuk')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Status Pendaftaran -->
                        <div>
                            <label for="status_pendaftaran" class="block text-sm font-medium text-gray-700 mb-1">Status Pendaftaran <span class="text-red-500">*</span></label>
                            <select id="status_pendaftaran" name="status_pendaftaran" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="aktif" {{ old('status_pendaftaran', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="non_aktif" {{ old('status_pendaftaran') === 'non_aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Section 3: Kontak & Alamat -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-envelope"></i>
                        </span>
                        Kontak & Alamat
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Nomor Handphone -->
                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="0812-3456-7890" required autocomplete="tel" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                            @error('no_hp')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Alamat Lengkap -->
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap sesuai KTP/KK" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('alamat') }}</textarea>
                            @error('alamat')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- RT/RW -->
                        <div>
                            <label for="rt_rw" class="block text-sm font-medium text-gray-700 mb-1">RT / RW</label>
                            <div class="flex items-center gap-2">
                                <input type="text" id="rt" name="rt" value="{{ old('rt') }}" placeholder="001" class="flex-1 px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all uppercase">
                                <span class="text-gray-500">/</span>
                                <input type="text" id="rw" name="rw" value="{{ old('rw') }}" placeholder="002" class="flex-1 px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all uppercase">
                            </div>
                        </div>
                        
                        <!-- Kelurahan/Desa -->
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700 mb-1">Kelurahan/Desa</label>
                            <input type="text" id="kelurahan" name="kelurahan" value="{{ old('kelurahan') }}" placeholder="Nama kelurahan/desa" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Kecamatan -->
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                            <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}" placeholder="Nama kecamatan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Kota/Kabupaten -->
                        <div>
                            <label for="kota_kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten</label>
                            <input type="text" id="kota_kabupaten" name="kota_kabupaten" value="{{ old('kota_kabupaten', 'Bandung') }}" placeholder="Nama kota/kabupaten" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Provinsi -->
                        <div>
                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                            <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi', 'Jawa Barat') }}" placeholder="Nama provinsi" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Kode Pos -->
                        <div>
                            <label for="kode_pos" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                            <input type="text" id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" placeholder="12345" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all uppercase font-mono">
                        </div>
                    </div>
                </div>
                
                <!-- Section 4: Informasi Orang Tua -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-home"></i>
                        </span>
                        Informasi Orang Tua/Wali
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Nama Ayah -->
                        <div>
                            <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_ayah')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- No HP Ayah -->
                        <div>
                            <label for="no_hp_ayah" class="block text-sm font-medium text-gray-700 mb-1">No HP Ayah</label>
                            <input type="tel" id="no_hp_ayah" name="no_hp_ayah" value="{{ old('no_hp_ayah') }}" placeholder="0812-3456-7890" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Nama Ibu -->
                        <div>
                            <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_ibu')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- No HP Ibu -->
                        <div>
                            <label for="no_hp_ibu" class="block text-sm font-medium text-gray-700 mb-1">No HP Ibu</label>
                            <input type="tel" id="no_hp_ibu" name="no_hp_ibu" value="{{ old('no_hp_ibu') }}" placeholder="0812-3456-7890" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Pekerjaan Ayah -->
                        <div>
                            <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ayah</label>
                            <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" placeholder="Contoh: PNS" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Pekerjaan Ibu -->
                        <div>
                            <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ibu</label>
                            <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" placeholder="Contoh: Ibu Rumah Tangga" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Alamat Orang Tua -->
                        <div class="md:col-span-2">
                            <label for="alamat_orang_tua" class="block text-sm font-medium text-gray-700 mb-1">Alamat Orang Tua</label>
                            <textarea id="alamat_orang_tua" name="alamat_orang_tua" rows="2" placeholder="Alamat orang tua/wali jika berbeda dengan alamat siswa..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('alamat_orang_tua') }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Section 5: Foto Profil & Password -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-camera"></i>
                        </span>
                        Foto Profil & Akun
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Username -->
                        
                        
                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="password" id="password" name="password" placeholder="Min. 8 karakter" required autocomplete="new-password" onkeyup="checkStrength(this.value)" class="w-full pl-10 pr-12 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                <div id="strengthMeter" class="strength-meter hidden"></div>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <span id="strengthText" class="text-xs font-medium"></span>
                                <label class="flex items-center gap-1 cursor-pointer text-xs text-gray-600">
                                    <input type="checkbox" onchange="togglePasswordVisibility('password', this)"> Lihat Password
                                </label>
                            </div>
                            @error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required autocomplete="new-password" onkeyup="verifyPasswordMatch(this.value)" class="w-full pl-10 pr-10 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                <i id="matchIcon" class="fas fa-check absolute right-3 top-1/2 -translate-y-1/2 text-green-500 hidden"></i>
                                <i id="unmatchIcon" class="fas fa-times absolute right-3 top-1/2 -translate-y-1/2 text-red-500 hidden"></i>
                            </div>
                            @error('password_confirmation')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Kirim Email & Password -->
                        <div>
                            <label class="flex items-center gap-2 cursor-pointer p-3 bg-gray-50 rounded-lg">
                                <input type="checkbox" id="kirim_invitation" checked onchange="enableDisableFields()">
                                <span class="text-sm font-medium text-gray-700">Kirim Email Undangan Login</span>
                            </label>
                            <p class="text-xs text-gray-500 mt-1">Send email invitation to student's email address</p>
                        </div>
                        
                        <!-- Subject Email -->
                        <div id="subjectEmailField" class="opacity-100 transition-opacity md:col-span-1">
                            <label for="email_subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek Email</label>
                            <input type="text" id="email_subject" name="email_subject" value="Undangan Login - E-Learning Platform" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Body Email -->
                        <div id="bodyEmailField" class="opacity-100 transition-opacity md:col-span-1">
                            <label for="email_body" class="block text-sm font-medium text-gray-700 mb-1">Isi Email</label>
                            <textarea id="email_body" name="email_body" rows="2" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">Selamat datang di E-Learning Platform!

Gunakan kredensial berikut untuk login:
Username: [username_anda]

Silakan segera ubah password Anda setelah login.

Terima kasih,
Tim E-Learning</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t">
                    <a href="{{ route('admin.siswa.data.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                        <i class="fas fa-save"></i> Simpan Siswa
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
    
    <script>
        // Preview file upload
        function previewFile() {
            const preview = document.getElementById('previewContainer');
            const file = document.querySelector('#foto_siswa').files[0];
            const reader = new FileReader();
            
            reader.onloadend = function () {
                preview.innerHTML = `<img src="${reader.result}" alt="Preview" class="w-full h-full object-cover rounded-xl">`;
            }
            
            if (file) reader.readAsDataURL(file);
            else preview.innerHTML = '<i class="fas fa-camera text-gray-400 text-2xl"></i>';
        }
        
        // Generate NIS from Class Selection
        function generateNIS(classValue) {
            if (classValue && classValue !== '') {
                const nisInput = document.getElementById('nis');
                const year = new Date().getFullYear();
                const random = Math.floor(Math.random() * 900) + 100;
                nisInput.value = `${year}${random}`;
            }
        }

        // Autocomplete untuk Nama Lengkap
        const namaLengkapInput = document.getElementById('nama_lengkap');
        const usernameInput = document.getElementById('username');
        const idUserInput = document.getElementById('id_user');
        let debounceTimer;
        let dropdown = null;

        // Buat dropdown element
        function createDropdown() {
            if (dropdown) return;
            dropdown = document.createElement('div');
            dropdown.className = 'absolute z-10 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto mt-1';
            dropdown.style.display = 'none';
            namaLengkapInput.parentNode.style.position = 'relative';
            namaLengkapInput.parentNode.appendChild(dropdown);
        }

        // Tampilkan dropdown dengan data
        function showDropdown(data) {
            if (!dropdown) createDropdown();
            dropdown.innerHTML = '';
            if (data.length === 0) {
                dropdown.style.display = 'none';
                return;
            }
            data.forEach(item => {
                const div = document.createElement('div');
                div.className = 'px-4 py-2 hover:bg-gray-100 cursor-pointer';
                div.textContent = item.nama_lengkap;
                div.addEventListener('click', () => {
                    namaLengkapInput.value = item.nama_lengkap;
                    usernameInput.value = item.username;
                    idUserInput.value = item.id_user;
                    dropdown.style.display = 'none';
                });
                dropdown.appendChild(div);
            });
            dropdown.style.display = 'block';
        }

        // Sembunyikan dropdown
        function hideDropdown() {
            if (dropdown) dropdown.style.display = 'none';
        }

        // Fetch data dari server
        async function fetchAutocomplete(query) {
            try {
                const response = await fetch(`{{ route('admin.siswa.data.autofill') }}?q=${encodeURIComponent(query)}`);
                const data = await response.json();
                showDropdown(data);
            } catch (error) {
                console.error('Error fetching autocomplete data:', error);
            }
        }

        // Event listener untuk input
        namaLengkapInput.addEventListener('input', function() {
            const query = this.value.trim();
            clearTimeout(debounceTimer);
            if (query.length < 2) {
                hideDropdown();
                return;
            }
            debounceTimer = setTimeout(() => {
                fetchAutocomplete(query);
            }, 300);
        });

        // Sembunyikan dropdown saat klik di luar
        document.addEventListener('click', function(e) {
            if (!namaLengkapInput.contains(e.target) && (!dropdown || !dropdown.contains(e.target))) {
                hideDropdown();
            }
        });
        
        // Password Strength Checker
        function checkStrength(password) {
            const meter = document.getElementById('strengthMeter');
            const text = document.getElementById('strengthText');
            
            if (!password || password.length === 0) {
                meter.classList.add('hidden');
                text.textContent = '';
                return;
            }
            
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z\d]/.test(password)) strength++;
            
            meter.classList.remove('hidden');
            
            if (strength <= 2) {
                meter.className = 'strength-meter weak';
                text.textContent = 'Lemah';
                text.className = 'text-xs font-medium text-red-600';
            } else if (strength <= 4) {
                meter.className = 'strength-meter medium';
                text.textContent = 'Sedang';
                text.className = 'text-xs font-medium text-orange-500';
            } else {
                meter.className = 'strength-meter strong';
                text.textContent = 'Kuat';
                text.className = 'text-xs font-medium text-green-600';
            }
        }
        
        // Password Match Verification
        function verifyPasswordMatch(confirmPassword) {
            const password = document.getElementById('password').value;
            const matchIcon = document.getElementById('matchIcon');
            const unmatchIcon = document.getElementById('unmatchIcon');
            
            if (confirmPassword === '') {
                matchIcon.classList.add('hidden');
                unmatchIcon.classList.add('hidden');
                return;
            }
            
            if (password === confirmPassword) {
                matchIcon.classList.remove('hidden');
                unmatchIcon.classList.add('hidden');
            } else {
                matchIcon.classList.add('hidden');
                unmatchIcon.classList.remove('hidden');
            }
        }
        
        // Toggle Password Visibility
        function togglePasswordVisibility(fieldId, checkbox) {
            const input = document.getElementById(fieldId);
            input.type = checkbox.checked ? 'text' : 'password';
        }
        
        // Enable Disable Email Fields
        function enableDisableFields() {
            const sendEmail = document.getElementById('kirim_invitation').checked;
            const subjectField = document.getElementById('subjectEmailField');
            const bodyField = document.getElementById('email_body');
            
            subjectField.style.opacity = sendEmail ? '1' : '0.5';
            bodyField.style.opacity = sendEmail ? '1' : '0.5';
            
            if (!sendEmail) {
                subjectField.querySelector('input').disabled = true;
                bodyField.querySelector('textarea').disabled = true;
            } else {
                subjectField.querySelector('input').disabled = false;
                bodyField.querySelector('textarea').disabled = false;
            }
        }
        
        // Form Validation
        document.getElementById('createForm').addEventListener('submit', function(e) {
            const inputs = this.querySelectorAll('[required]');
            let isValid = true;
            let hasError = false;
            
            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    isValid = false;
                    input.classList.add('border-red-500');
                    setTimeout(() => input.classList.remove('border-red-500'), 1000);
                    hasError = true;
                } else {
                    input.classList.remove('border-red-500');
                }
            });
            
            // Check password match
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            if (password !== confirmPassword && confirmPassword !== '') {
                hasError = true;
                isValid = false;
                alert('Password tidak cocok!');
            }
            
            // Check password length
            if (password.length > 0 && password.length < 8) {
                hasError = true;
                isValid = false;
                alert('Password minimal 8 karakter!');
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        });
    </script>