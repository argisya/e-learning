@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-4xl mx-auto mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Edit Pengumuman</h1>
                <p class="text-gray-500 mt-1 text-sm">{{ __('Update pengumuman berikut jika diperlukan.') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openModal('modalViewDetail')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">
                    <i class="fas fa-eye mr-2"></i>Lihat Preview
                </button>
                <a href="{{ route('pengumuman.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
        
        <!-- Content Card -->
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden">
            
            <!-- Progress Bar -->
            <div class="relative h-1 bg-gray-200">
                <div class="absolute left-0 top-0 h-full gradient-bg" style="width: 70%"></div>
            </div>
            
            <form action="{{ route('pengumuman.update', ['id' => $announcement->id]) }}" method="POST" enctype="multipart/form-data" novalidate id="editForm" class="p-6 lg:p-8">
                
                @csrf
                @method('PUT')
                
                <!-- Profile Section -->
                <div class="flex items-start gap-6 mb-8 pb-8 border-b">
                    <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center border-2 border-primary-200">
                        <i class="fas fa-bullhorn text-3xl text-primary-600"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800">{{ $announcement->judul }}</h3>
                        <p class="text-gray-500 text-sm">{{ \Carbon\Carbon::parse($announcement->created_at)->isoFormat('D MMMM YYYY') }}</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs {{ $announcement->status === 'publish' ? 'bg-green-50 text-green-700' : ($announcement->status === 'draft' ? 'bg-yellow-50 text-yellow-700' : 'bg-gray-50 text-gray-700') }}">
                                {{ ucfirst($announcement->status) }}
                            </span>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-purple-50 text-purple-700">
                                <i class="fas fa-tag"></i> {{ ucfirst($announcement->kategori) }}
                            </span>
                        </div>
                    </div>
                </div>
                
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
                            <input type="text" id="judul" name="judul" value="{{ old('judul', $announcement->judul) }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('judul')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                            <select id="kategori" name="kategori" required onchange="updateCategoryDescription(this.value)" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="umum" {{ old('kategori', $announcement->kategori) === 'umum' ? 'selected' : '' }}>Umum</option>
                                <option value="akademik" {{ old('kategori', $announcement->kategori) === 'akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="kegiatan" {{ old('kategori', $announcement->kategori) === 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                <option value="undangan" {{ old('kategori', $announcement->kategori) === 'undangan' ? 'selected' : '' }}>Undangan</option>
                                <option value="penting" {{ old('kategori', $announcement->kategori) === 'penting' ? 'selected' : '' }}>Penting</option>
                            </select>
                            @error('kategori')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Prioritas -->
                        <div>
                            <label for="prioritas" class="block text-sm font-medium text-gray-700 mb-1">Prioritas</label>
                            <select id="prioritas" name="prioritas" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="normal" {{ old('prioritas', $announcement->prioritas ?? 'normal') === 'normal' ? 'selected' : '' }}>Normal</option>
                                <option value="tinggi" {{ old('prioritas', $announcement->prioritas) === 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                <option value="sangat_tinggi" {{ old('prioritas', $announcement->prioritas) === 'sangat_tinggi' ? 'selected' : '' }}>Sangat Tinggi</option>
                            </select>
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Publikasi <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="status" value="publish" {{ old('status', $announcement->status) === 'publish' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-primary-500 peer-checked:border-primary-500 peer-checked:bg-primary-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mb-2 peer-checked:bg-green-500 peer-checked:text-white transition-colors">
                                            <i class="fas fa-check-circle text-green-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Dipublish</p>
                                    </div>
                                </label>
                                
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="status" value="draft" {{ old('status', $announcement->status) === 'draft' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-gray-400 peer-checked:border-gray-400 peer-checked:bg-gray-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center mb-2 peer-checked:bg-yellow-400 peer-checked:text-white transition-colors">
                                            <i class="fas fa-pencil-alt text-yellow-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Draft</p>
                                    </div>
                                </label>
                                
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="status" value="arsip" {{ old('status', $announcement->status) === 'arsip' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-gray-400 peer-checked:border-gray-400 peer-checked:bg-gray-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center mb-2 peer-checked:bg-gray-400 peer-checked:text-white transition-colors">
                                            <i class="fas fa-archive text-gray-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Arsip</p>
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
                            <label for="banner_image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Banner</label>
                            <div class="flex items-center gap-4">
                                @if($announcement->banner_image)
                                    <img src="{{ asset('storage/' . $announcement->banner_image) }}" alt="Banner" class="w-32 h-20 rounded-lg object-cover border-2">
                                @else
                                    <div class="w-32 h-20 rounded-lg bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-300">
                                        <i class="fas fa-image text-gray-400 text-xl"></i>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <label class="cursor-pointer btn-secondary px-4 py-2 w-full text-center">
                                        <input type="file" id="banner_image" name="banner_image" accept="image/*" onchange="previewImage()" class="hidden">
                                        <i class="fas fa-upload mr-2"></i>Ubah Banner
                                    </label>
                                    @if($announcement->banner_image)
                                        <label class="cursor-pointer text-red-500 px-4 py-2 w-full text-center border-2 border-transparent hover:border-red-500">
                                            <input type="hidden" id="remove_banner" name="remove_banner" value="0">
                                            <i class="fas fa-trash"></i>Hapus Banner Saat Ini
                                        </label>
                                    @endif
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
                                     data-placeholder="Ketik isi pengumuman di sini...">{{ old('konten', $announcement->konten) }}</div>
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
                                <option value="all" {{ (in_array('all', old('target_kelas', [])) || in_array('all', json_decode($announcement->target_kelas ?? '[]'))) ? 'selected' : '' }}>Semua Kelas</option>
                                <option value="VII_A" {{ (in_array('VII_A', old('target_kelas', [])) || in_array('VII_A', json_decode($announcement->target_kelas ?? '[]'))) ? 'selected' : '' }}>VII A</option>
                                <option value="VIII_A" {{ (in_array('VIII_A', old('target_kelas', [])) || in_array('VIII_A', json_decode($announcement->target_kelas ?? '[]'))) ? 'selected' : '' }}>VIII A</option>
                                <option value="IX_A" {{ (in_array('IX_A', old('target_kelas', [])) || in_array('IX_A', json_decode($announcement->target_kelas ?? '[]'))) ? 'selected' : '' }}>IX A</option>
                                <option value="X_IPA" {{ (in_array('X_IPA', old('target_kelas', [])) || in_array('X_IPA', json_decode($announcement->target_kelas ?? '[]'))) ? 'selected' : '' }}>X IPA</option>
                                <option value="XI_IPS" {{ (in_array('XI_IPS', old('target_kelas', [])) || in_array('XI_IPS', json_decode($announcement->target_kelas ?? '[]'))) ? 'selected' : '' }}>XI IPS</option>
                                <option value="XII_IPA" {{ (in_array('XII_IPA', old('target_kelas', [])) || in_array('XII_IPA', json_decode($announcement->target_kelas ?? '[]'))) ? 'selected' : '' }}>XII IPA</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Tekan Ctrl/Cmd untuk memilih beberapa kelas</p>
                        </div>
                        
                        <!-- Notifikasi Email/SMS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Metode Notifikasi</label>
                            <div class="space-y-3">
                                <label class="flex items-center gap-2 cursor-pointer p-3 bg-gray-50 rounded-lg">
                                    <input type="checkbox" id="email_notification" {{ old('email_notification', 1) === 1 || isset(json_decode($announcement->notification_settings)['email']) ? 'checked' : '' }} onchange="enableDisableFields()">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-envelope text-blue-600"></i>
                                            <span class="font-medium text-gray-800">Email</span>
                                        </div>
                                        <p class="text-xs text-gray-500">Kirim notifikasi via email</p>
                                    </div>
                                </label>
                                
                                <label class="flex items-center gap-2 cursor-pointer p-3 bg-gray-50 rounded-lg">
                                    <input type="checkbox" id="sms_notification" {{ old('sms_notification', 1) === 1 || isset(json_decode($announcement->notification_settings)['sms']) ? 'checked' : '' }} onchange="enableDisableFields()">
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
                                    <input type="date" id="schedule_date" name="schedule_date" value="{{ old('schedule_date', $announcement->scheduled_date) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all" {{ !isset($announcement->scheduled_date) ? 'disabled' : '' }}>
                                </div>
                                <div>
                                    <label for="schedule_time" class="block text-xs text-gray-500 mb-1">Waktu</label>
                                    <input type="time" id="schedule_time" name="schedule_time" value="{{ old('schedule_time', $announcement->scheduled_time) }}" step="900" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all" {{ !isset($announcement->scheduled_date) ? 'disabled' : '' }}>
                                </div>
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
                            <input type="text" id="tags" name="tags" value="{{ old('tags', $announcement->tags) }}" placeholder="ujian, uts, semester" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            <p class="text-xs text-gray-500 mt-1">Max 5 tags</p>
                        </div>
                        
                        <!-- Keterangan Tambahan -->
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Tambahan (Opsional)</label>
                            <textarea id="keterangan" name="keterangan" rows="2" placeholder="Tambahkan keterangan khusus jika diperlukan..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('keterangan', $announcement->keterangan) }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 pt-6 border-t">
                    <button type="button" onclick="openModal('modalDeleteConfirmation')" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium">
                        <i class="fas fa-trash-alt"></i> Hapus Pengumuman
                    </button>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- ================= MODALS ================= -->
    
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
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus Pengumuman</h3>
                    <p class="text-gray-600 text-sm mb-6">Apakah Anda yakin ingin menghapus pengumuman "{{ $announcement->judul }}"? Tindakan ini tidak dapat dibatalkan!</p>
                    <form action="{{ route('pengumuman.destroy', ['id' => $announcement->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-center gap-3">
                            <button type="button" onclick="closeModal('modalDeleteConfirmation')" class="flex-1 px-4 py-2.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Batal</button>
                            <button type="submit" class="flex-1 px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium">Hapus Pengumuman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Preview image upload
        function previewImage() {
            const file = document.querySelector('#banner_image').files[0];
            const reader = new FileReader();
            
            if (file) {
                reader.onload = function(e) {
                    location.reload(); // Reload page to show new banner
                };
                reader.readAsDataURL(file);
            }
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
        
        // Auto-fill hidden input on submit
        document.getElementById('editForm').addEventListener('submit', function(e) {
            document.getElementById('konten_hidden').value = document.getElementById('editor_content').innerHTML;
        });
        
        // Close Modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        
        // Open Modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
        
        // Keyboard Navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal').forEach(modal => modal.classList.add('hidden'));
            }
        });
    </script>