@extends('layouts.app')

@section('title', 'Users')

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
            <form action="" method="POST" enctype="multipart/form-data" novalidate id="createForm" class="p-6 lg:p-8">
                
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
                            <input type="text" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Jadwal Ujian Tengah Semester" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('judul')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                            <select id="kategori" name="kategori" required onchange="updateCategoryDescription(this.value)" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="umum" {{ old('kategori') === 'umum' ? 'selected' : '' }}>Umum</option>
                                <option value="akademik" {{ old('kategori') === 'akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="kegiatan" {{ old('kategori') === 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="undangan" {{ old('kategori') === 'undangan' ? 'selected' : '' }}>Undangan</option>
                                <option value="penting" {{ old('kategori') === 'penting' ? 'selected' : '' }}>Penting</option>
                            </select>
                            <p id="category_description" class="text-xs text-gray-500 mt-1">Pilih kategori untuk menentukan jenis pengumuman</p>
                            @error('kategori')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Prioritas -->
                        <div>
                            <label for="prioritas" class="block text-sm font-medium text-gray-700 mb-1">Prioritas</label>
                            <select id="prioritas" name="prioritas" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="normal" {{ old('prioritas', 'normal') === 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="tinggi" {{ old('prioritas') === 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                <option value="sangat_tinggi" {{ old('prioritas') === 'sangat_tinggi' ? 'selected' : '' }}>Sangat Tinggi</option>
                            </select>
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Publikasi <span class="text-red-500">*</span></label>
                            <div class="flex items-center gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="publish" checked {{ old('status', 'publish') === 'publish' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-1">
                                        <span class="status-dot status-active"></span>
                                        <span class="text-gray-700">Dipublish</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="draft" {{ old('status') === 'draft' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-1">
                                        <span class="status-dot status-inactive"></span>
                                        <span class="text-gray-700">Draft</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="arsip" {{ old('status') === 'arsip' ? 'checked' : '' }}>
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
                <div class="mb-8 pb-8 border-b">
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
                                     required>{{ old('konten') }}</div>
                                <input type="hidden" id="konten_hidden" name="konten" required>
                            </div>
                            @error('konten')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                
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
                            <label for="target_kelas" class="block text-sm font-medium text-gray-700 mb-1">Target Kelas (Opsional)</label>
                            <select id="target_kelas" name="target_kelas[]" multiple class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all" size="4">
                                <option value="all">Semua Kelas</option>
                                <option value="VII_A">VII A</option>
                                <option value="VIII_A">VIII A</option>
                                <option value="IX_A">IX A</option>
                                <option value="X_IPA">X IPA</option>
                                <option value="XI_IPS">XI IPS</option>
                                <option value="XII_IPA">XII IPA</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Tekan Ctrl/Cmd untuk memilih beberapa kelas</p>
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
                            <label for="target_waktu" class="block text-sm font-medium text-gray-700 mb-2">Waktu publikasi otomatis (Opsional)</label>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="schedule_date" class="block text-xs text-gray-500 mb-1">Tanggal</label>
                                    <input type="date" id="schedule_date" name="schedule_date" value="{{ date('Y-m-d') }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                </div>
                                <div>
                                    <label for="schedule_time" class="block text-xs text-gray-500 mb-1">Waktu</label>
                                    <input type="time" id="schedule_time" name="schedule_time" value="08:00" step="900" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
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
                <div class="mb-8 pb-8 border-b">
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
                </div>
                
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
    
    <script>
        // Preview image upload
        function previewImage() {
            const preview = document.getElementById('previewContainer');
            const file = document.querySelector('#banner_image').files[0];
            const reader = new FileReader();
            
            reader.onloadend = function () {
                preview.innerHTML = `<img src="${reader.result}" alt="Preview" class="w-full h-full object-cover rounded-lg">`;
            }
            
            if (file) reader.readAsDataURL(file);
            else preview.innerHTML = '<i class="fas fa-image text-gray-400 text-xl"></i>';
        }
        
        // Format Text in Editor
        function formatText(command, value) {
            document.execCommand(command, false, value);
            document.getElementById('editor_content').focus();
        }
        
        // Update editor content on blur
        document.getElementById('editor_content').addEventListener('blur', function() {
            document.getElementById('konten_hidden').value = this.innerHTML;
        });
        
        // Enable Disable Fields
        function enableDisableFields() {
            const emailChecked = document.getElementById('email_notification').checked;
            const smsChecked = document.getElementById('sms_notification').checked;
            
            if (!emailChecked && !smsChecked) {
                alert('Setidaknya salah satu metode notifikasi harus aktif!');
                document.getElementById('email_notification').checked = true;
            }
        }
        
        // Toggle Schedule
        function toggleSchedule() {
            const scheduleDate = document.getElementById('schedule_date');
            const scheduleTime = document.getElementById('schedule_time');
            const isDisabled = scheduleDate.disabled;
            
            scheduleDate.disabled = !isDisabled;
            scheduleTime.disabled = !isDisabled;
            scheduleDate.style.opacity = isDisabled ? '1' : '0.5';
            scheduleTime.style.opacity = isDisabled ? '1' : '0.5';
        }
        
        // Auto-fill hidden input on submit
        document.getElementById('createForm').addEventListener('submit', function(e) {
            document.getElementById('konten_hidden').value = document.getElementById('editor_content').innerHTML;
        });
        
        // Keyboard Navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close any open modals
                document.querySelectorAll('.modal').forEach(modal => modal.classList.add('hidden'));
            }
            
            if (e.key === 'Enter' && e.target.tagName === 'INPUT' && e.target.id !== 'tags') {
                e.preventDefault();
                document.getElementById('createForm').dispatchEvent(new Event('submit'));
            }
        });
    </script>