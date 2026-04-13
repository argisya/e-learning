@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-3xl mx-auto mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Edit Data Siswa</h1>
                <p class="text-gray-500 mt-1 text-sm">{{ __('Update data siswa berikut jika diperlukan.') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openModal('modalViewDetail')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">
                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                </button>
                <a href="{{ route('admin.siswa.data.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
        
        <!-- Content Card -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden">
            
            <!-- Progress Bar -->
            <div class="relative h-1 bg-gray-200">
                <div class="absolute left-0 top-0 h-full gradient-bg" style="width: 70%"></div>
            </div>
            
            <form action="{{ route('admin.siswa.data.update', ['nis' => $siswa->nis]) }}" method="POST" enctype="multipart/form-data" novalidate id="editForm" class="p-6 lg:p-8">
                
                @csrf
                @method('PUT')
                
                <!-- Profile Section -->
                <div class="flex flex-col sm:flex-row items-start gap-6 mb-8 pb-8 border-b">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800">{{ $siswa->nama_lengkap }}</h3>
                        <p class="text-gray-500 text-sm font-mono">{{ $siswa->nis ?? 'NIS-NISN' }} | {{ $siswa->nisn ?? '' }}</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs {{ $siswa->status_pendaftaran === 'aktif' ? 'bg-green-50 text-green-700' : ($siswa->status_pendaftaran === 'lulus' ? 'bg-blue-50 text-blue-700' : 'bg-gray-50 text-gray-700') }}">
                                <span class="status-dot {{ $siswa->status_pendaftaran === 'aktif' ? 'status-active' : 'status-inactive' }}"></span>
                                {{ ucfirst($siswa->status_pendaftaran) }}
                            </span>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-purple-50 text-purple-700">
                                <i class="fas fa-users"></i> Kelas {{ $siswa->kelas->nama_kelas ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>
                
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
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_lengkap')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- NIS -->
                        <div>
                            <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">NIS <span class="text-gray-500 font-normal">(Tidak Dapat Diedit)</span></label>
                            <div class="relative">
                                <i class="fas fa-hashtag absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="nis" value="{{ $siswa->nis ?? '-' }}" readonly class="w-full pl-10 pr-4 py-2.5 bg-gray-100 border-2 border-gray-200 rounded-lg text-gray-500 cursor-not-allowed font-mono text-xs">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">NIS bersifat permanen dan tidak dapat diubah</p>
                        </div>
                        
                        <!-- NISN -->
                        <div>
                            <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN</label>
                            <div class="relative">
                                <i class="fas fa-id-card absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="nisn" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" pattern="\d{10}" maxlength="10" placeholder="10 digit NISN" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all font-mono">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Min. 10 digit angka</p>
                        </div>
                        
                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('tempat_lahir')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $siswa->tanggal_lahir) }}" required max="{{ date('Y-m-d', strtotime('-14 years')) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('tanggal_lahir')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="gender" value="Laki-laki" {{ old('gender', $siswa->gender) === 'Laki-laki' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-primary-500 peer-checked:border-primary-500 peer-checked:bg-primary-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-2 peer-checked:bg-primary-500 peer-checked:text-white transition-colors">
                                            <i class="fas fa-mars text-blue-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Laki-laki</p>
                                    </div>
                                </label>
                                
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="gender" value="Perempuan" {{ old('gender', $siswa->gender) === 'Perempuan' ? 'checked' : '' }} required class="peer sr-only">
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
                                <option value="Islam" {{ old('agama', $siswa->agama) === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen Protestan" {{ old('agama', $siswa->agama) === 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                <option value="Kristen Katolik" {{ old('agama', $siswa->agama) === 'Kristen Katolik' ? 'selected' : '' }}>Kristen Katolik</option>
                                <option value="Hindu" {{ old('agama', $siswa->agama) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama', $siswa->agama) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama', $siswa->agama) === 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
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
                                    <option value="{{ $classId }}" {{ old('kelas_id', $siswa->kelas_id) == $classId ? 'selected' : '' }}>
                                        Kelas VII A
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Program Keahlian -->
                        <div>
                            <label for="program_keahlian" class="block text-sm font-medium text-gray-700 mb-1">Program Keahlian</label>
                            <select id="program_keahlian" name="program_keahlian" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Auto Detect --</option>
                                <option value="IPA" {{ old('program_keahlian', $siswa->program_keahlian) === 'IPA' ? 'selected' : '' }}>IPA</option>
                                <option value="IPS" {{ old('program_keahlian', $siswa->program_keahlian) === 'IPS' ? 'selected' : '' }}>IPS</option>
                                <option value="Bahasa" {{ old('program_keahlian', $siswa->program_keahlian) === 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                            </select>
                        </div>
                        
                        <!-- Tahun Masuk -->
                        <div>
                            <label for="tahun_masuk" class="block text-sm font-medium text-gray-700 mb-1">Tahun Masuk <span class="text-red-500">*</span></label>
                            <input type="number" id="tahun_masuk" name="tahun_masuk" value="{{ old('tahun_masuk', $siswa->tahun_masuk ?? date('Y')) }}" min="2000" max="{{ date('Y') + 5 }}" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('tahun_masuk')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Status Pendaftaran -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Pendaftaran <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="status_pendaftaran" value="aktif" {{ old('status_pendaftaran', $siswa->status_pendaftaran) === 'aktif' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-primary-500 peer-checked:border-primary-500 peer-checked:bg-primary-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mb-2 peer-checked:bg-green-500 peer-checked:text-white transition-colors">
                                            <i class="fas fa-check-circle text-green-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Aktif</p>
                                    </div>
                                </label>
                                
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="status_pendaftaran" value="non_aktif" {{ old('status_pendaftaran', $siswa->status_pendaftaran) === 'non_aktif' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-gray-400 peer-checked:border-gray-400 peer-checked:bg-gray-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center mb-2 peer-checked:bg-gray-400 peer-checked:text-white transition-colors">
                                            <i class="fas fa-times-circle text-gray-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Non-Aktif</p>
                                    </div>
                                </label>
                                
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="status_pendaftaran" value="lulus" {{ old('status_pendaftaran', $siswa->status_pendaftaran) === 'lulus' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-2 peer-checked:bg-blue-500 peer-checked:text-white transition-colors">
                                            <i class="fas fa-graduation-cap text-blue-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Lulus</p>
                                    </div>
                                </label>
                            </div>
                            @error('status_pendaftaran')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
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
                                <input type="email" id="email" name="email" value="{{ old('email', $siswa->email) }}" required autocomplete="email" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Nomor Handphone -->
                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-phone absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}" placeholder="0812-3456-7890" required autocomplete="tel" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                            @error('no_hp')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Alamat Lengkap -->
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap sesuai KTP/KK" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('alamat', $siswa->alamat) }}</textarea>
                            @error('alamat')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- RT/RW -->
                        <div>
                            <label for="rt_rw" class="block text-sm font-medium text-gray-700 mb-1">RT / RW</label>
                            <div class="flex items-center gap-2">
                                <input type="text" id="rt" name="rt" value="{{ old('rt', $siswa->rt) }}" placeholder="001" class="flex-1 px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all uppercase">
                                <span class="text-gray-500">/</span>
                                <input type="text" id="rw" name="rw" value="{{ old('rw', $siswa->rw) }}" placeholder="002" class="flex-1 px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all uppercase">
                            </div>
                        </div>
                        
                        <!-- Kelurahan/Desa -->
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700 mb-1">Kelurahan/Desa</label>
                            <input type="text" id="kelurahan" name="kelurahan" value="{{ old('kelurahan', $siswa->kelurahan) }}" placeholder="Nama kelurahan/desa" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Kecamatan -->
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                            <input type="text" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $siswa->kecamatan) }}" placeholder="Nama kecamatan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Kota/Kabupaten -->
                        <div>
                            <label for="kota_kabupaten" class="block text-sm font-medium text-gray-700 mb-1">Kota/Kabupaten</label>
                            <input type="text" id="kota_kabupaten" name="kota_kabupaten" value="{{ old('kota_kabupaten', $siswa->kota_kabupaten) ?: 'Bandung' }}" placeholder="Nama kota/kabupaten" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Provinsi -->
                        <div>
                            <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                            <input type="text" id="provinsi" name="provinsi" value="{{ old('provinsi', $siswa->provinsi) ?: 'Jawa Barat' }}" placeholder="Nama provinsi" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Kode Pos -->
                        <div>
                            <label for="kode_pos" class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                            <input type="text" id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $siswa->kode_pos) }}" placeholder="12345" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all uppercase font-mono">
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
                            <input type="text" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah', $siswa->nama_ayah) }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_ayah')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- No HP Ayah -->
                        <div>
                            <label for="no_hp_ayah" class="block text-sm font-medium text-gray-700 mb-1">No HP Ayah</label>
                            <input type="tel" id="no_hp_ayah" name="no_hp_ayah" value="{{ old('no_hp_ayah', $siswa->no_hp_ayah) }}" placeholder="0812-3456-7890" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Nama Ibu -->
                        <div>
                            <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu', $siswa->nama_ibu) }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_ibu')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- No HP Ibu -->
                        <div>
                            <label for="no_hp_ibu" class="block text-sm font-medium text-gray-700 mb-1">No HP Ibu</label>
                            <input type="tel" id="no_hp_ibu" name="no_hp_ibu" value="{{ old('no_hp_ibu', $siswa->no_hp_ibu) }}" placeholder="0812-3456-7890" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Pekerjaan Ayah -->
                        <div>
                            <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ayah</label>
                            <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah', $siswa->pekerjaan_ayah) }}" placeholder="Contoh: PNS" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Pekerjaan Ibu -->
                        <div>
                            <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ibu</label>
                            <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu', $siswa->pekerjaan_ibu) }}" placeholder="Contoh: Ibu Rumah Tangga" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Alamat Orang Tua -->
                        <div class="md:col-span-2">
                            <label for="alamat_orang_tua" class="block text-sm font-medium text-gray-700 mb-1">Alamat Orang Tua</label>
                            <textarea id="alamat_orang_tua" name="alamat_orang_tua" rows="2" placeholder="Alamat orang tua/wali jika berbeda dengan alamat siswa..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('alamat_orang_tua', $siswa->alamat_orang_tua) }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Section 5: Akun & Password -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-key"></i>
                        </span>
                        Akun & Password
                    </h2>
                    
                    <div class="space-y-6">
                        
                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="username" name="username" value="{{ old('username', $siswa->username) }}" required autocomplete="off" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Username login ke sistem e-learning</p>
                            @error('username')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini <span class="text-gray-500 font-normal">(Opsional)</span></label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="password" id="current_password" name="current_password" placeholder="Masukkan password saat ini" autocomplete="current-password" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Wajib diisi jika ingin mengubah password</p>
                        </div>
                        
                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru <span class="text-gray-500 font-normal">(Opsional)</span></label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="password" id="password" name="password" placeholder="Min. 8 karakter" onkeyup="checkStrength(this.value)" class="w-full pl-10 pr-12 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                <div id="strengthMeter" class="strength-meter hidden"></div>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <span id="strengthText" class="text-xs font-medium"></span>
                                <label class="flex items-center gap-1 cursor-pointer text-xs text-gray-600">
                                    <input type="checkbox" onchange="togglePasswordVisibility('password', this)"> Lihat Password
                                </label>
                            </div>
                        </div>
                        
                        <!-- Konfirmasi Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password <span class="text-gray-500 font-normal">(Opsional)</span></label>
                            <div class="relative">
                                <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" onkeyup="verifyPasswordMatch(this.value)" class="w-full pl-10 pr-10 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                <i id="matchIcon" class="fas fa-check absolute right-3 top-1/2 -translate-y-1/2 text-green-500 hidden"></i>
                                <i id="unmatchIcon" class="fas fa-times absolute right-3 top-1/2 -translate-y-1/2 text-red-500 hidden"></i>
                            </div>
                        </div>
                        
                        <!-- Keep Same Password -->
                        <div>
                            <label class="flex items-center gap-2 cursor-pointer p-3 bg-gray-50 rounded-lg">
                                <input type="checkbox" id="keep_same_password" checked onchange="disableNewPasswordFields(this.checked)">
                                <span class="text-sm font-medium text-gray-700">Simpan Password Sama Seperti Sebelumnya</span>
                            </label>
                        </div>
                        
                        <!-- Email Invitation Options -->
                        <div class="flex items-center gap-2 cursor-pointer p-3 bg-gray-50 rounded-lg">
                            <input type="checkbox" id="send_email_notification" checked onchange="enableDisableFields()">
                            <span class="text-sm font-medium text-gray-700">Kirim Email Notifikasi Perubahan</span>
                        </div>
                        
                        <!-- Subject Email (Conditional) -->
                        <div id="subjectEmailField" class="opacity-100 transition-opacity">
                            <label for="email_subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek Email</label>
                            <input type="text" id="email_subject" name="email_subject" value="Notifikasi Perubahan Data Siswa - {{ $siswa->nama_lengkap }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Body Email (Conditional) -->
                        <div id="bodyEmailField" class="opacity-100 transition-opacity">
                            <label for="email_body" class="block text-sm font-medium text-gray-700 mb-1">Isi Email</label>
                            <textarea id="email_body" name="email_body" rows="3" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('email_body', 'Selamat siang,\n\nKami menginformasikan bahwa ada perubahan pada data akun Anda di sistem E-Learning Platform.\n\nJika ada pertanyaan atau ketidaksesuaian, silakan hubungi administrator.\n\nTerima kasih,\nTim E-Learning') }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 pt-6 border-t">
                    <button type="button" onclick="openModal('modalDeleteConfirmation')" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium">
                        <i class="fas fa-trash-alt"></i> Hapus Data Siswa
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
    
    <!-- ================= MODALS ================= -->
    
    <!-- Modal View Detail -->
    <div id="modalViewDetail" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalViewDetail')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Detail Data Siswa</h3>
                    <button onclick="closeModal('modalViewDetail')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    
                    <!-- Student Profile -->
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                        <img src="{{ asset($siswa->foto ?? 'images/avatar.jpg') }}" alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 border-primary-100">
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-800">{{ $siswa->nama_lengkap }}</h4>
                            <p class="text-sm text-gray-500">{{ $siswa->nis ?? '-' }} | {{ $siswa->nisn ?? '-' }}</p>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge {{ $siswa->status_pendaftaran === 'aktif' ? 'badge-active' : ($siswa->status_pendaftaran === 'lulus' ? 'badge-lulus' : 'badge-inactive') }} mt-2">
                                <span class="status-dot {{ $siswa->status_pendaftaran === 'aktif' ? 'status-active' : 'status-inactive' }}"></span>
                                {{ ucfirst($siswa->status_pendaftaran) }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Info Grid -->
                    <dl class="space-y-4 text-sm">
                        <div class="grid grid-cols-2 gap-4">
                            <dt class="font-medium text-gray-500">Kelas</dt>
                            <dd class="text-gray-800">{{ $siswa->kelas->nama_kelas ?? '-' }}</dd>
                            
                            <dt class="font-medium text-gray-500">Tanggal Lahir</dt>
                            <dd class="text-gray-800">{{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</dd>
                            
                            <dt class="font-medium text-gray-500">Agama</dt>
                            <dd class="text-gray-800">{{ $siswa->agama ?? '-' }}</dd>
                            
                            <dt class="font-medium text-gray-500">Email</dt>
                            <dd class="text-gray-800">{{ $siswa->email ?? '-' }}</dd>
                            
                            <dt class="font-medium text-gray-500">No. Handphone</dt>
                            <dd class="text-gray-800">{{ $siswa->no_hp ?? '-' }}</dd>
                            
                            <dt class="font-medium text-gray-500">Status</dt>
                            <dd class="text-gray-800">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge {{ $siswa->status_pendaftaran === 'aktif' ? 'badge-active' : ($siswa->status_pendaftaran === 'lulus' ? 'badge-lulus' : 'badge-inactive') }}">
                                    <span class="status-dot {{ $siswa->status_pendaftaran === 'aktif' ? 'status-active' : 'status-inactive' }}"></span>
                                    {{ ucfirst($siswa->status_pendaftaran) }}
                                </span>
                            </dd>
                        </div>
                        
                        <!-- Guardian Info -->
                        <hr class="border-gray-200 my-4">
                        
                        <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <i class="fas fa-home text-blue-600 text-xl mt-1"></i>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800 text-sm">Informasi Orang Tua</p>
                                <ul class="text-xs text-gray-500 mt-2 space-y-1">
                                    <li><i class="fas fa-male text-blue-600"></i> <strong>Ayah:</strong> {{ $siswa->nama_ayah ?? '-' }}</li>
                                    <li><i class="fas fa-female text-blue-600"></i> <strong>Ibu:</strong> {{ $siswa->nama_ibu ?? '-' }}</li>
                                    <li><i class="fas fa-calendar-day text-blue-600"></i> <strong>Tahun Masuk:</strong> {{ $siswa->tahun_masuk ?? '-' }}</li>
                                </ul>
                            </div>
                        </div>
                    </dl>
                </div>
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t flex justify-end gap-3">
                    <button onclick="closeModal('modalViewDetail')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Tutup</button>
                    <button onclick="closeModal('modalViewDetail')" class="inline-flex items-center justify-center gap-2 px-4 py-2 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">Edit Data</button>
                </div>
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
                    <p class="text-gray-600 text-sm mb-6">Apakah Anda yakin ingin menghapus data siswa "{{ $siswa->nama_lengkap }}"? Tindakan ini tidak dapat dibatalkan!</p>
                    <form action="" method="POST">
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
    
    <script>
        // Close Modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        
        // Open Modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
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
        
        // Disable New Password Fields
        function disableNewPasswordFields(keepSame) {
            const passwordField = document.getElementById('password');
            const confirmField = document.getElementById('password_confirmation');
            
            passwordField.disabled = keepSame;
            confirmField.disabled = keepSame;
            
            if (keepSame) {
                passwordField.style.opacity = '0.5';
                confirmField.style.opacity = '0.5';
            } else {
                passwordField.style.opacity = '1';
                confirmField.style.opacity = '1';
            }
        }
        
        // Enable Disable Email Fields
        function enableDisableFields() {
            const sendEmail = document.getElementById('send_email_notification').checked;
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
        document.getElementById('editForm').addEventListener('submit', function(e) {
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
            
            // Check password validation
            const keepSame = document.getElementById('keep_same_password').checked;
            if (!keepSame) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                
                if (password !== confirmPassword && confirmPassword !== '') {
                    hasError = true;
                    isValid = false;
                    alert('Password tidak cocok!');
                }
                
                if (password.length > 0 && password.length < 8) {
                    hasError = true;
                    isValid = false;
                    alert('Password minimal 8 karakter!');
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        });
        
        // Keyboard Navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal').forEach(modal => modal.classList.add('hidden'));
            }
        });
    </script>