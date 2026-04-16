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
            <form action="{{ route('admin.siswa.data.store') }}" method="POST" enctype="multipart/form-data" id="createForm" class="p-6 lg:p-8">
                
                @csrf
                @method('POST')
                
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
                            <input type="text" id="nama_lengkap" data-url="{{ route('admin.siswa.data.autofill') }}" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap sesuai ijazah" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
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
                            <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-id-card absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="nisn" name="nisn" value="{{ old('nisn') }}" required pattern="\d{10}" maxlength="10" placeholder="10 digit NISN" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all font-mono">
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
                                    <input type="radio" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', 'L') === 'L' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-primary-500 peer-checked:border-primary-500 peer-checked:bg-primary-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-2 peer-checked:bg-primary-500 peer-checked:text-white transition-colors">
                                            <i class="fas fa-mars text-blue-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Laki-laki</p>
                                    </div>
                                </label>
                                
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') === 'P' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-primary-500 peer-checked:border-primary-500 peer-checked:bg-pink-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-pink-100 flex items-center justify-center mb-2 peer-checked:bg-pink-500 peer-checked:text-white transition-colors">
                                            <i class="fas fa-venus text-pink-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Perempuan</p>
                                    </div>
                                </label>
                            </div>
                            @error('jenis_kelamin')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
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
                            <label for="id_kelas" class="block text-sm font-medium text-gray-700 mb-1">Pilih Kelas <span class="text-red-500">*</span></label>
                            <select id="id_kelas" name="id_kelas" required onchange="generateNIS(this.value)" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelas as $kelas)
                                    <option value="{{ $kelas->id_kelas }}">{{ old('id_kelas') === $kelas->id_kelas ? 'Selected' : '' }} {{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                            @error('id_kelas')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            <p class="text-xs text-gray-500 mt-1">Kelas akan menentukan NIS dan program keahlian</p>
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
                                <option value="Aktif" {{ old('status_pendaftaran', 'Aktif') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ old('status_pendaftaran') === 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
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

                        <!-- Kelas -->
                        <div class="md:col-span-2">
                            <label for="status_keluarga" class="block text-sm font-medium text-gray-700 mb-1">Status Keluarga <span class="text-red-500">*</span></label>
                            <select id="status_keluarga" name="status_keluarga" required onchange="generateNIS(this.value)" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih --</option>
                                    <option value="Anak Kandung"> Anak Kandung</option>
                                    <option value="Anak Tiri"> Anak Tiri</option>
                            </select>
                            @error('status_keluarga')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                            {{-- <p class="text-xs text-gray-500 mt-1">Kelas akan menentukan NIS dan program keahlian</p> --}}
                        </div>
                        
                        <!-- Nama Ayah -->
                        <div>
                            <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_ayah')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Nama Ibu -->
                        <div>
                            <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_ibu')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- No HP Ayah -->
                        <div>
                            <label for="no_hp_ayah" class="block text-sm font-medium text-gray-700 mb-1">No HP Ayah <span class="text-red-500">*</span></label>
                            <input type="tel" id="no_hp_ayah" name="no_hp_ayah" value="{{ old('no_hp_ayah') }}" required placeholder="0812-3456-7890" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- No HP Ibu -->
                        <div>
                            <label for="no_hp_ibu" class="block text-sm font-medium text-gray-700 mb-1">No HP Ibu <span class="text-red-500">*</span></label>
                            <input type="tel" id="no_hp_ibu" name="no_hp_ibu" value="{{ old('no_hp_ibu') }}" required placeholder="0812-3456-7890" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Pekerjaan Ayah -->
                        <div>
                            <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ayah <span class="text-red-500">*</span></label>
                            <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required placeholder="Contoh: PNS" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Pekerjaan Ibu -->
                        <div>
                            <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ibu <span class="text-red-500">*</span></label>
                            <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required placeholder="Contoh: Ibu Rumah Tangga" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Alamat Orang Tua -->
                        <div class="md:col-span-2">
                            <label for="alamat_orangtua" class="block text-sm font-medium text-gray-700 mb-1">Alamat Orang Tua <span class="text-red-500">*</span></label>
                            <textarea id="alamat_orangtua" name="alamat_orangtua" rows="2" required placeholder="Alamat orang tua/wali jika berbeda dengan alamat siswa..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('alamat_orang_tua') }}</textarea>
                        </div>

                        <!-- Nama Wali -->
                        <div>
                            <label for="nama_wali" class="block text-sm font-medium text-gray-700 mb-1">Nama Wali</label>
                            <input type="text" id="nama_wali" name="nama_wali" value="{{ old('nama_wali') }}" autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_wali')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- No HP Wali -->
                        <div>
                            <label for="no_hp_wali" class="block text-sm font-medium text-gray-700 mb-1">No HP Wali</label>
                            <input type="tel" id="no_hp_wali" name="no_hp_wali" value="{{ old('no_hp_wali') }}" placeholder="0812-3456-7890" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>

                        <!-- Pekerjaan Wali -->
                        <div>
                            <label for="pekerjaan_wali" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Wali</label>
                            <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" value="{{ old('pekerjaan_wali') }}" placeholder="Contoh: Ibu Rumah Tangga" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>

                        <!-- Alamat Wali -->
                        <div class="md:col-span-2">
                            <label for="alamat_wali" class="block text-sm font-medium text-gray-700 mb-1">Alamat Wali</label>
                            <textarea id="alamat_wali" name="alamat_wali" rows="2" placeholder="Alamat orang tua/wali jika berbeda dengan alamat siswa..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('alamat_wali') }}</textarea>
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
    
    @push('scripts')
        @vite(['resources/js/modal.js',
                'resources/js/autofill.js',
                'resources/js/validation.js',
        ])
    @endpush