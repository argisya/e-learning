@extends('layouts.app')

@section('title', 'Users')

@section('content')

    <div class="min-h-screen py-8 px-4">
        
        <!-- Header Simple -->
        <div class="max-w-4xl mx-auto mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Edit Data Guru</h1>
                <p class="text-gray-500 mt-1 text-sm">{{ __('Update data berikut jika diperlukan.') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openModal('modalViewDetail')" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-eye"></i> Lihat Detail
                </button>
                <a href="{{ route('admin.guru.data.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        
        <!-- Content Card -->
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="relative h-1 bg-gray-200">
                <div class="absolute left-0 top-0 h-full gradient-bg" style="width: 70%"></div>
            </div>
            
            <form action="{{ route('admin.guru.data.update', $guru->nip) }}" method="POST" enctype="multipart/form-data" id="editForm" class="p-6 lg:p-8">
                
                @csrf
                @method('PUT')
                
                <!-- Section 1: Identitas -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm"><i class="fas fa-user-circle"></i></span>
                        Data Identitas Pribadi
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="hidden" id="id_user" name="id_user" value="{{ $guru->id_user }}" required>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ $guru->nama_lengkap }}" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP / NKK</label>
                            <input type="text" id="nip" name="nip" value="{{ $guru->nip }}" readonly class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg bg-gray-100 cursor-not-allowed text-gray-500">
                        </div>
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ $guru->tempat_lahir }}" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ $guru->tanggal_lahir }}" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <div class="flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="L" {{ $guru->jenis_kelamin === 'L' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="P" {{ $guru->jenis_kelamin === 'P' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Perempuan</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label for="agama" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <select id="agama" name="agama" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                @foreach(['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $religion)
                                    <option value="{{ $religion }}" {{ $guru->agama === $religion ? 'selected' : '' }}> {{ $religion }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status_pernikahan" class="block text-sm font-medium text-gray-700 mb-1">Status Pernikahan</label>
                            <select id="status_pernikahan" name="status_pernikahan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="Belum Kawin" >Belum Kawin</option>
                                <option value="Kawin" >Menikah</option>
                                <option value="Cerai Hidup" >Cerai Hidup</option>
                                <option value="Cerai Mati" >Cerai Mati</option>
                            </select>
                        </div>
                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone</label>
                            <input type="tel" id="no_hp" name="no_hp" value="{{ $guru->no_hp }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" value="{{ $guru->alamat }}" rows="3" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none"></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Section 2: Kepegawaian -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm"><i class="fas fa-briefcase"></i></span>
                        Data Kepegawaian & Jabatan
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- <div>
                            <label for="status_kepagawaian" class="block text-sm font-medium text-gray-700 mb-1">Status Kepegawaian</label>
                            <select id="status_kepagawaian" name="status_kepagawaian" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="PNS">Pegawai Negeri Sipil</option>
                                <option value="PPPK">PPPK</option>
                                <option value="TKS">Tenaga Kontrak Sekolah</option>
                                <option value="Honorer">Honorer Daerah</option>
                            </select>
                        </div> --}}
                        <!-- Bidang Studi -->
                        <div>
                            <label for="bidang_studi" class="block text-sm font-medium text-gray-700 mb-1">Bidang Studi</label>
                            <input type="text" id="bidang_studi" name="bidang_studi" value="{{ old('bidang_studi') ?? $guru->bidang_studi }}" placeholder="Contoh: Guru Matematika" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                            <select id="jabatan" name="jabatan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">Tidak ada</option>
                                <option value="Kepala Sekolah" >Kepala Sekolah</option>
                                <option value="Wakil Kepala Sekolah" >Wakil Kepala Sekolah</option>
                                <option value="Guru BK" >Guru BK</option>
                                <option value="Koordinator" >Koordinator</option>
                            </select>
                        </div>
                        <div>
                            <label for="no_sk" class="block text-sm font-medium text-gray-700 mb-1">Nomor SK Jabatan</label>
                            <input type="text" id="no_sk" name="no_sk" value="{{ old('no_sk') ?? $guru->no_sk }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        {{-- <div>
                            <label for="tanggal_sk_jabatan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal SK Jabatan</label>
                            <input type="date" id="tanggal_sk_jabatan" name="tanggal_sk_jabatan" value="" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div> --}}
                        <div>
                            <label for="masa_kerja" class="block text-sm font-medium text-gray-700 mb-1">Masa Kerja (Tahun)</label>
                            <input type="number" id="masa_kerja" name="masa_kerja" value="" min="0" max="50" step="0.5" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label for="golongan" class="block text-sm font-medium text-gray-700 mb-1">Pangkat / Golongan</label>
                            <select id="golongan" name="golongan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="Penata Muda III/a" >Penata Muda III/a</option>
                                <option value="Penata Muda II/3b" >Penata Muda II/3b</option>
                                <option value="Penata Muda Tingkat I III/c" >Penata Muda Tingkat I III/c</option>
                                <option value="Penata III/d" >Penata III/d</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 pt-6 border-t">
                    <button type="button" onclick="openModal('modalDeleteConfirmation')" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium">
                        <i class="fas fa-trash-alt"></i> Hapus Data
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @endsection
    
    @push('scripts')
        @vite(['resources/js/modal.js',
                'resources/js/pass_verif.js',
                'resources/js/validation.js',
        ])
    @endpush