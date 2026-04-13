@extends('layouts.app')

@section('title', 'Tambah Kelas - Admin')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header Simple -->
        <div class="max-w-4xl mx-auto mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Tambah Data Guru</h1>
                <p class="text-gray-500 mt-1 text-sm">Isi formulir di bawah ini untuk menambahkan guru baru</p>
            </div>
            <a href="{{ route('admin.guru.data.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-primary-600 transition-colors">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <!-- Content Card -->
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden">
            <form action="{{ route('admin.guru.data.store') }}" method="POST" enctype="multipart/form-data" id="createForm" class="p-6 lg:p-8">
                
                @csrf
                
                <!-- Section 1: Identitas Pribadi -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-user-circle"></i>
                        </span>
                        Data Identitas Pribadi
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="hidden" id="id_user" name="id_user" value="{{ old('id_user') }}" required>
                            <input type="text" id="nama_lengkap" data-url="{{ route('admin.guru.data.autofill') }}" placeholder="Masukkan nama lengkap sesuai ijazah" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_lengkap')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- NIP -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">NIP / NKK <span class="text-red-500">*</span></label>
                            <input type="text" id="username" name="nip"  value="{{ old('username') }}" placeholder="06 digit angka" required maxlength="18" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all font-mono">
                            @error('username')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('tempat_lahir')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required max="{{ date('Y-m-d', strtotime('-16 years')) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('tanggal_lahir')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Jenis Kelamin -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div class="flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="L" checked {{ old('jenis_kelamin', 'L') === 'L' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', 'P') === 'P' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Perempuan</span>
                                </label>
                            </div>
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
                        
                        <!-- Status Pernikahan -->
                        <div>
                            <label for="status_pernikahan" class="block text-sm font-medium text-gray-700 mb-1">Status Pernikahan</label>
                            <select id="status_pernikahan" name="status_pernikahan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Status --</option>
                                <option value="Belum Kawin" {{ old('status_pernikahan') === 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_pernikahan') === 'Kawin' ? 'selected' : '' }}>Menikah</option>
                                <option value="Cerai Hidup" {{ old('status_pernikahan') === 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_pernikahan') === 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>
                        
                        <!-- No HP -->
                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone</label>
                            <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 0812-3456-7890" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Alamat -->
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap sesuai KTP/KK" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('alamat') }}</textarea>
                        </div>
                        
                        <!-- Foto -->
                        <div class="md:col-span-2">
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto Profil <span class="text-gray-500 font-normal">(Opsional)</span></label>
                            <div class="flex items-center gap-4">
                                <div id="previewContainer" class="w-24 h-24 rounded-lg bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-300">
                                    <i class="fas fa-camera text-gray-400 text-2xl"></i>
                                </div>
                                <div class="flex-1">
                                    <label class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-gray-50 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                                        <input type="file" id="foto" name="foto" accept="image/*" onchange="previewFile()" class="hidden">
                                        <i class="fas fa-upload"></i> Pilih File
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG | Maksimal: 2MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Section 2: Kepegawaian -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-briefcase"></i>
                        </span>
                        Data Kepegawaian & Jabatan
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Status Kepegawaian -->
                        {{-- <div>
                            <label for="status_kepagawaian" class="block text-sm font-medium text-gray-700 mb-1">Status Kepegawaian <span class="text-red-500">*</span></label>
                            <select id="status_kepagawaian" name="status_kepagawaian" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Status --</option>
                                <option value="PNS" {{ old('status_kepagawaian') === 'PNS' ? 'selected' : '' }}>Pegawai Negeri Sipil</option>
                                <option value="PPPK" {{ old('status_kepagawaian') === 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                <option value="TKS" {{ old('status_kepagawaian') === 'TKS' ? 'selected' : '' }}>Tenaga Kontrak Sekolah</option>
                                <option value="Honorer" {{ old('status_kepagawaian') === 'Honorer' ? 'selected' : '' }}>Honorer Daerah</option>
                            </select>
                            @error('status_kepagawaian')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div> --}}
                        
                        <!-- Bidang Studi -->
                        <div>
                            <label for="bidang_studi" class="block text-sm font-medium text-gray-700 mb-1">Bidang Studi</label>
                            <input type="text" id="bidang_studi" name="bidang_studi" value="{{ old('bidang_studi') }}" placeholder="Contoh: Guru Matematika" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Jabatan Struktural -->
                        <div>
                            <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan Struktural</label>
                            <select id="jabatan" name="jabatan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">Tidak ada</option>
                                <option value="Kepala Sekolah" {{ old('jabatan') === 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                                <option value="Wakil Kepala Sekolah" {{ old('jabatan') === 'Wakil Kepala Sekolah' ? 'selected' : '' }}>Wakil Kepala Sekolah</option>
                                <option value="Guru BK" {{ old('jabatan') === 'Guru BK' ? 'selected' : '' }}>Guru BK</option>
                                <option value="Koordinator" {{ old('jabatan') === 'Koordinator' ? 'selected' : '' }}>Koordinator</option>
                            </select>
                        </div>
                        
                        <!-- Nomor SK Jabatan -->
                        <div>
                            <label for="no_sk" class="block text-sm font-medium text-gray-700 mb-1">Nomor SK Jabatan</label>
                            <input type="text" id="no_sk" name="no_sk" value="{{ old('no_sk') }}" placeholder="012/SKB/XXX/2024" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Masa Kerja -->
                        <div>
                            <label for="masa_kerja" class="block text-sm font-medium text-gray-700 mb-1">Masa Kerja Awal (Tahun)</label>
                            <input type="number" id="masa_kerja" name="masa_kerja" value="{{ old('masa_kerja') }}" min="0" max="50" step="0.5" placeholder="Contoh: 8.5" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Pangkat / Golongan -->
                        <div>
                            <label for="golongan" class="block text-sm font-medium text-gray-700 mb-1">Pangkat / Golongan</label>
                            <select id="golongan" name="golongan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Pangkat --</option>
                                <option value="Penata Muda III/a" {{ old('golongan') === 'Penata Muda III/a' ? 'selected' : '' }}>Penata Muda III/a</option>
                                <option value="Penata Muda II/3b" {{ old('golongan') === 'Penata Muda II/3b' ? 'selected' : '' }}>Penata Muda II/3b</option>
                                <option value="Penata Muda Tingkat I III/c" {{ old('golongan') === 'Penata Muda Tingkat I III/c' ? 'selected' : '' }}>Penata Muda Tingkat I III/c</option>
                                <option value="Penata III/d" {{ old('golongan') === 'Penata III/d' ? 'selected' : '' }}>Penata III/d</option>
                                <option value="Penata Tk I IV/a" {{ old('golongan') === 'Penata Tk I IV/a' ? 'selected' : '' }}>Penata Tk I IV/a</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t">
                    <a href="{{ route('admin.guru.data.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Delete Confirmation Modal -->
        <div id="modalDeleteConfirmation" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalDeleteConfirmation')"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full">
                    <div class="px-6 py-6 text-center">
                        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus Data</h3>
                        <p class="text-gray-600 text-sm mb-6">Apakah Anda yakin ingin menghapus data guru ini? Tindakan ini tidak dapat dibatalkan!</p>
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="flex justify-center gap-3">
                                <button type="button" onclick="closeModal('modalDeleteConfirmation')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium">Hapus Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    
    <style>
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    </style>
    
    @push('scripts')
        @vite(['resources/js/modal.js',
                'resources/js/autofill.js',
                'resources/js/validation.js',
        ])
    @endpush