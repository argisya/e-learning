@extends('layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')

    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-4xl mx-auto mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Tambah Pengumuman</h1>
                <p class="text-gray-500 mt-1 text-sm">Buat pengumuman baru untuk dipublikasikan kepada guru dan siswa</p>
            </div>
            <a href="{{ route('admin.pengumuman.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-primary-600 transition-colors">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <!-- Content Card -->
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden">
            <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data" id="createForm" class="p-6 lg:p-8">
                
                @csrf
                
                <!-- Section 1: Informasi Pengumuman -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        Informasi Dasar
                    </h2>
                    
                    <div class="space-y-6">
                        
                        <!-- Judul -->
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Pengumuman <span class="text-red-500">*</span></label>
                            <input type="text" id="judul" name="judul_pengumuman" value="{{ old('judul_pengumuman') }}" placeholder="Contoh: Jadwal Ujian Tengah Semester" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('judul_pengumuman')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        {{-- Isi --}}
                        <div>
                            <label for="isi" class="block text-sm font-medium text-gray-700 mb-1">Isi Pengumuman <span class="text-red-500">*</span></label>
                            <textarea id="isi" name="isi_pengumuman" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all" contenteditable="true">{{ old('isi_pengumuman') }}</textarea>
                            @error('isi_pengumuman')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                            <select id="kategori" name="kategori" required onchange="updateCategoryDescription(this.value)" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Kategori --</option>
                                        <option value="Umumm" {{ old('id_kategori') === 'Umumm' ? 'selected' : '' }}>Umum</option>
                                        <option value="Akademik" {{ old('id_kategori') === 'Akademik' ? 'selected' : '' }}>Akademik</option>
                                        <option value="Kegiatan" {{ old('id_kategori') === 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                        <option value="Undangan" {{ old('id_kategori') === 'Undangan' ? 'selected' : '' }}>Undangan</option>
                                        <option value="Penting" {{ old('id_kategori') === 'Penting' ? 'selected' : '' }}>Penting</option>
                                </select>
                            <p id="category_description" class="text-xs text-gray-500 mt-1">Pilih kategori untuk menentukan jenis pengumuman</p>
                            @error('id_kategori')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Prioritas -->
                        <div>
                            <label for="prioritas" class="block text-sm font-medium text-gray-700 mb-1">Prioritas</label>
                            <select id="prioritas" name="prioritas" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="Normal" {{ old('prioritas', 'Normal') === 'Normal' ? 'selected' : '' }}>Normal</option>
                                <option value="Tinggi" {{ old('prioritas') === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                <option value="Sangat Tinggi" {{ old('prioritas') === 'Sangat Tinggi' ? 'selected' : '' }}>Sangat Tinggi</option>
                            </select>
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Publikasi <span class="text-red-500">*</span></label>
                            <div class="flex items-center gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="Publish" checked {{ old('status', 'Publish') === 'Publish' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-1">
                                        <span class="status-dot status-active"></span>
                                        <span class="text-gray-700">Publish</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="Draft" {{ old('status') === 'Draft' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-1">
                                        <span class="status-dot status-inactive"></span>
                                        <span class="text-gray-700">Draft</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="Arsip" {{ old('status') === 'Arsip' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-1">
                                        <span class="status-dot status-inactive"></span>
                                        <span class="text-gray-700">Arsip</span>
                                    </div>
                                </label>
                            </div>
                            @error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                
                <!-- Section 2: Konten Pengumuman -->
                {{-- <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-file-alt"></i>
                        </span>
                        Isi Pengumuman
                    </h2>
                    
                    <div class="space-y-6">
                        
                        <!-- Banner Gambar -->
                        <div>
                            <label for="banner_image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Banner (Opsional)</label>
                            <div class="flex items-center gap-4">
                                <div id="previewContainer" class="w-32 h-20 rounded-lg bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-300">
                                    <i class="fas fa-image text-gray-400 text-xl"></i>
                                </div>
                                <div class="flex-1">
                                    <label class="cursor-pointer btn-secondary px-4 py-2 w-full text-center">
                                        <input type="file" id="banner_image" name="banner_image" accept="image/*" onchange="previewImage()" class="hidden">
                                        <i class="fas fa-upload mr-2"></i>Pilih File
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG | Maksimal: 5MB</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Text Editor -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Konten Pengumuman <span class="text-red-500">*</span></label>
                            <div class="editor-container">
                                <div class="editor-toolbar">
                                    <button type="button" class="editor-button" onclick="formatText('bold')" title="Bold">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="editor-button" onclick="formatText('italic')" title="Italic">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="editor-button" onclick="formatText('underline')" title="Underline">
                                        <i class="fas fa-underline"></i>
                                    </button>
                                    <button type="button" class="editor-button" onclick="formatText('strikeThrough')" title="Strike Through">
                                        <i class="fas fa-strikethrough"></i>
                                    </button>
                                    <div class="w-px h-6 bg-gray-300 mx-1"></div>
                                    <button type="button" class="editor-button" onclick="formatText('insertUnorderedList')" title="Bullet List">
                                        <i class="fas fa-list-ul"></i>
                                    </button>
                                    <button type="button" class="editor-button" onclick="formatText('insertOrderedList')" title="Numbered List">
                                        <i class="fas fa-list-ol"></i>
                                    </button>
                                    <div class="w-px h-6 bg-gray-300 mx-1"></div>
                                    <button type="button" class="editor-button" onclick="formatText('formatBlock', 'p')" title="Paragraph">
                                        <i class="fas fa-paragraph"></i>
                                    </button>
                                    <button type="button" class="editor-button" onclick="formatText('formatBlock', 'h3')" title="Heading">
                                        <i class="fas fa-heading"></i>
                                    </button>
                                    <button type="button" class="editor-button" onclick="formatText('indent')" title="Indent">
                                        <i class="fas fa-indent"></i>
                                    </button>
                                    <button type="button" class="editor-button" onclick="formatText('outdent')" title="Outdent">
                                        <i class="fas fa-outdent"></i>
                                    </button>
                                </div>
                                <div id="editor_content" 
                                     class="editor-content" 
                                     contenteditable="true"
                                     data-placeholder="Ketik isi pengumuman di sini..."
                                     required>{{ old('isi_pengumuman') }}</div>
                                <input type="hidden" id="konten_hidden" name="isi_pengumuman" required>
                            </div>
                            @error('isi_pengumuman')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div> --}}
                
                <!-- Section 3: Target Audiens -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-users"></i>
                        </span>
                        Target Audiens
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Target Kelas -->
                        <div>
                            <label for="target" class="block text-sm font-medium text-gray-700 mb-1">Target Kelas <span class="text-red-500">*</span></label>
                            <select id="target" name="target" required onchange="updateCategoryDescription(this.value)" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Target --</option>
                                    <option value="Semua Kelas">Semua Kelas</option>
                                    <option value="VII A">VII A</option>
                                    <option value="VIII A">VIII A</option>
                                    <option value="IX A">IX A</option>
                                    <option value="X IPA">X IPA</option>
                                    <option value="XI IPS">XI IPS</option>
                                    <option value="XII IPA">XII IPA</option>
                                </select>
                            <p id="target" class="text-xs text-gray-500 mt-1">Pilih Target untuk menentukan target pengumuman</p>
                            @error('target')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Notifikasi Email/SMS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Metode Notifikasi</label>
                            <div class="space-y-3">
                                <label class="flex items-center gap-2 cursor-pointer p-3 bg-gray-50 rounded-lg">
                                    <input type="checkbox" id="email_notification" checked onchange="enableDisableFields()">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-envelope text-blue-600"></i>
                                            <span class="font-medium text-gray-800">Email</span>
                                        </div>
                                        <p class="text-xs text-gray-500">Kirim notifikasi via email</p>
                                    </div>
                                </label>
                                
                                <label class="flex items-center gap-2 cursor-pointer p-3 bg-gray-50 rounded-lg">
                                    <input type="checkbox" id="sms_notification" checked onchange="enableDisableFields()">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-phone text-green-600"></i>
                                            <span class="font-medium text-gray-800">SMS/WA</span>
                                        </div>
                                        <p class="text-xs text-gray-500">Kirim notifikasi via SMS/WA</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Target Waktu -->
                        <div class="md:col-span-2">
                            <label for="target_waktu" class="block text-sm font-medium text-gray-700 mb-2">Waktu Acara</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="schedule_date" class="block text-xs text-gray-500 mb-1">Tanggal Mulai</label>
                                    <input type="date" id="schedule_date" name="tanggal_mulai" value="{{ date('Y-m-d') }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="schedule_time" class="block text-xs text-gray-500 mb-1">Waktu Mulai</label>
                                    <input type="time" id="schedule_time" name="waktu_mulai" value="08:00" step="900" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="schedule_date" class="block text-xs text-gray-500 mb-1">Tanggal Selesai</label>
                                    <input type="date" id="schedule_date" name="tanggal_selesai" value="{{ date('Y-m-d') }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="schedule_time" class="block text-xs text-gray-500 mb-1">Waktu Selesai</label>
                                    <input type="time" id="schedule_time" name="waktu_selesai" value="17:00" step="900" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                            </div>
                            {{-- <div id="scheduleToggle" class="flex items-center gap-2 mt-3 cursor-pointer p-2 bg-blue-50 rounded-lg border border-blue-200" onclick="toggleSchedule()">
                                <i class="fas fa-clock text-blue-600"></i>
                                <span class="text-sm font-medium text-gray-700">Atur jadwal publikasi otomatis</span>
                            </div> --}}
                        </div>

                        <!-- Target Waktu -->
                        <div class="md:col-span-2">
                            <label for="target_waktu" class="block text-sm font-medium text-gray-700 mb-2">Waktu publikasi otomatis (Opsional)</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="tanggal_publikasi" class="block text-xs text-gray-500 mb-1">Tanggal Mulai</label>
                                    <input type="date" id="tanggal_publikasi" name="tanggal_publikasi" value="{{ date('Y-m-d') }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="waktu_publikasi" class="block text-xs text-gray-500 mb-1">Waktu Mulai</label>
                                    <input type="time" id="waktu_publikasi" name="waktu_publikasi" value="08:00" step="900" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                            </div>
                            <div id="scheduleToggle" class="flex items-center gap-2 mt-3 cursor-pointer p-2 bg-blue-50 rounded-lg border border-blue-200" onclick="toggleSchedule()">
                                <i class="fas fa-clock text-blue-600"></i>
                                <span class="text-sm font-medium text-gray-700">Atur jadwal publikasi otomatis</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Section 4: Tags & Metadata -->
                {{-- <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-tags"></i>
                        </span>
                        Tag & Metadata
                    </h2>
                    
                    <div class="space-y-6">
                        
                        <!-- Tags -->
                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700 mb-1">Tags (Pisahkan dengan koma)</label>
                            <input type="text" id="tags" name="tags" value="{{ old('tags') }}" placeholder="ujian, uts, semester" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            <p class="text-xs text-gray-500 mt-1">Max 5 tags</p>
                        </div>
                        
                        <!-- Keterangan Tambahan -->
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan (Opsional)</label>
                            <textarea id="keterangan" name="keterangan" rows="2" placeholder="Tambahkan keterangan khusus jika diperlukan..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                </div> --}}
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t">
                    <a href="{{ route('admin.pengumuman.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                        <i class="fas fa-save"></i> Simpan Pengumuman
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
    
    @push('scripts')
        @vite([
                'resources/js/pass_verif.js',
                'resources/js/validation.js',
        ])
    @endpush