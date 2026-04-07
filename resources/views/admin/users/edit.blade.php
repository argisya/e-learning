@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-3xl mx-auto mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Edit User</h1>
                <p class="text-gray-500 mt-1 text-sm">{{ __('Update data users berikut jika diperlukan.') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openModal('modalViewDetail')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">
                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                </button>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">
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
            
            <form action="" method="POST" enctype="multipart/form-data" novalidate id="editForm" class="p-6 lg:p-8">
                
                @csrf
                @method('PUT')
                
                
                <!-- Section 1: Informasi Akun -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        Informasi Akun
                    </h2>
                    
                    <div class="space-y-6">
                        
                        <!-- Nama Lengkap -->
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $users->nama_lengkap) }}" placeholder="Masukkan nama lengkap sesuai KTP" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_lengkap')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-users absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="username" name="username" value="{{ old('username', $users->username) }}" placeholder="Pilih username unik" required autocomplete="off" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter, hanya huruf dan angka</p>
                            @error('username')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="email" id="email" name="email" value="{{ old('email', $users->email) }}" placeholder="nama@email.com" required autocomplete="email" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            </div>
                            @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        
                        <!-- Status Akun -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Akun <span class="text-red-500">*</span></label>
                            <div class="flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="active" {{ old('status', $users->status) === 'active' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-1">
                                        <span class="status-dot status-active"></span>
                                        <span class="text-gray-700">Aktif</span>
                                    </div>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="status" value="inactive" {{ old('status', $users->status) === 'inactive' ? 'checked' : '' }}>
                                    <div class="flex items-center gap-1">
                                        <span class="status-dot status-inactive"></span>
                                        <span class="text-gray-700">Tidak Aktif</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role / Peran <span class="text-red-500">*</span></label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        
                        <!-- Admin -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="admin" {{ old('role', $users->role) === 'admin' ? 'checked' : '' }} required onchange="showAdditionalFields(this.value)">
                            <div class="p-4 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-all group {{ old('role', $users->role) === 'admin' ? 'border-primary-500 bg-primary-50' : '' }}">
                                <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center mb-2 group-hover:bg-red-500 group-hover:text-white transition-colors {{ old('role', $users->role) === 'admin' ? 'bg-red-500 text-white' : 'text-red-600' }}">
                                    <i class="fas fa-users-shield text-lg"></i>
                                </div>
                                <p class="text-sm font-medium text-gray-700 text-center">Administrator</p>
                            </div>
                        </label>
                        
                        <!-- Guru -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="guru" {{ old('role', $users->role) === 'guru' ? 'checked' : '' }} required onchange="showAdditionalFields(this.value)">
                            <div class="p-4 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-all group {{ old('role', $users->role) === 'guru' ? 'border-primary-500 bg-primary-50' : '' }}">
                                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-2 group-hover:bg-blue-500 group-hover:text-white transition-colors {{ old('role', $users->role) === 'guru' ? 'bg-blue-500 text-white' : 'text-blue-600' }}">
                                    <i class="fas fa-chalkboard-teacher text-lg"></i>
                                </div>
                                <p class="text-sm font-medium text-gray-700 text-center">Guru</p>
                            </div>
                        </label>
                        
                        <!-- Siswa -->
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="siswa" {{ old('role', $users->role) === 'siswa' ? 'checked' : '' }} required onchange="showAdditionalFields(this.value)">
                            <div class="p-4 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-all group {{ old('role', $users->role) === 'siswa' ? 'border-primary-500 bg-primary-50' : '' }}">
                                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mb-2 group-hover:bg-green-500 group-hover:text-white transition-colors {{ old('role', $users->role) === 'siswa' ? 'bg-green-500 text-white' : 'text-green-600' }}">
                                    <i class="fas fa-users-graduate text-lg"></i>
                                </div>
                                <p class="text-sm font-medium text-gray-700 text-center">Siswa</p>
                            </div>
                        </label>
                    </div>
                </div>
                <!-- Section 2: Pengaturan Password -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-key"></i>
                        </span>
                        Atur Password Baru
                    </h2>
                    
                    <div class="space-y-6">
                        
                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
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
                                <input type="password" id="password" name="password" placeholder="Min. 8 karakter, gabungan huruf & angka" autocomplete="new-password" onkeyup="checkStrength(this.value)" class="w-full pl-10 pr-12 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
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
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password baru" autocomplete="new-password" onkeyup="verifyPasswordMatch(this.value)" class="w-full pl-10 pr-10 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                                <i id="matchIcon" class="fas fa-check absolute right-3 top-1/2 -translate-y-1/2 text-green-500 hidden"></i>
                                <i id="unmatchIcon" class="fas fa-times absolute right-3 top-1/2 -translate-y-1/2 text-red-500 hidden"></i>
                            </div>
                        </div>
                        
                        <!-- Keep Same Password -->
                        <div class="flex items-center gap-2 p-4 bg-gray-50 rounded-lg">
                            <input type="checkbox" id="keep_same" checked onchange="disableNewPasswordFields(this.checked)">
                            <label for="keep_same" class="font-medium text-gray-800">Simpan Password Sama Seperti Sebelumnya</label>
                        </div>
                    </div>
                </div>
                
                <!-- Section 3: Pengaturan Tambahan -->
                <div id="additionalSettings" class="mb-8 pb-8 border-b hidden">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-cog"></i>
                        </span>
                        Pengaturan Tambahan
                    </h2>
                    
                    <div class="space-y-6">
                        
                        <!-- Kirim Email Perubahan -->
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <input type="checkbox" id="send_email_change" checked onchange="enableDisableFields()">
                            <div class="flex-1">
                                <label for="send_email_change" class="font-medium text-gray-800">Kirim Email Notifikasi Perubahan</label>
                                <p class="text-sm text-gray-500 mt-1">Kirim email ke users mengenai perubahan yang dilakukan</p>
                            </div>
                        </div>
                        
                        <!-- Subject Email -->
                        <div id="subjectEmailField" class="opacity-100 transition-opacity">
                            <label for="email_subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek Email</label>
                            <input type="text" id="email_subject" value="Notifikasi Perubahan Data User" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Email Body -->
                        <div id="bodyEmailField" class="opacity-100 transition-opacity">
                            <label for="email_body" class="block text-sm font-medium text-gray-700 mb-1">Isi Email</label>
                            <textarea id="email_body" rows="3" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">Yang terhormat {{ $users->nama_lengkap }},

Kami ingin memberitahukan bahwa ada perubahan pada akun Anda di sistem E-Learning Platform.

Detail perubahan:
Role: {{ ucfirst(old('role', $users->role)) }}
Status: {{ ucfirst(old('status', $users->status)) }}

Jika ada pertanyaan atau ketidaksesuaian, silakan hubungi administrator.

Terima kasih,
Tim E-Learning</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 pt-6 border-t">
                    <button type="button" onclick="openModal('modalDeleteConfirmation')" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium">
                        <i class="fas fa-trash-alt"></i> Hapus User
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
            <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md sm:w-full modal-content">
                <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                    <h3 class="text-lg font-bold">Detail User</h3>
                    <button onclick="closeModal('modalViewDetail')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                        <img src="{{ asset($users->foto ?? 'images/avatar.jpg') }}" alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 border-primary-100">
                        <div>
                            <h4 class="text-xl font-bold text-gray-800">{{ $users->nama_lengkap }}</h4>
                            <span class="badge badge-{{ $users->role === 'admin' ? 'admin' : ($users->role === 'guru' ? 'guru' : ($users->role === 'siswa' ? 'siswa' : 'staff')) }}">
                                <i class="fas fa-users-{{ $users->role === 'admin' ? 'shield' : ($users->role === 'guru' ? 'chalkboard-teacher' : ($users->role === 'siswa' ? 'graduate' : 'tag')) }}"></i>
                                {{ ucfirst($users->role) }}
                            </span>
                            <p class="text-xs text-gray-400 mt-1">ID: {{ $users->id }}</p>
                        </div>
                    </div>
                    <dl class="space-y-4 text-sm">
                        <div class="grid grid-cols-2 gap-4">
                            <dt class="font-medium text-gray-500">Username</dt>
                            <dd class="text-gray-800">{{ $users->username }}</dd>
                            
                            <dt class="font-medium text-gray-500">Email</dt>
                            <dd class="text-gray-800">{{ $users->email }}</dd>
                            
                            <dt class="font-medium text-gray-500">Status</dt>
                            <dd class="text-gray-800">
                                <span class="inline-flex items-center gap-1">
                                    <span class="status-dot {{ $users->status === 'active' ? 'status-active' : 'status-inactive' }}"></span>
                                    {{ ucfirst($users->status) }}
                                </span>
                            </dd>
                            
                            <dt class="font-medium text-gray-500">Dibuat</dt>
                            <dd class="text-gray-800">{{ \Carbon\Carbon::parse($users->created_at)->isoFormat('D MMMM YYYY') }}</dd>
                            
                            <dt class="font-medium text-gray-500">Terakhir Update</dt>
                            <dd class="text-gray-800">{{ \Carbon\Carbon::parse($users->updated_at)->isoFormat('D MMMM YYYY HH:mm') }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t flex justify-end gap-3">
                    <button onclick="closeModal('modalViewDetail')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Tutup</button>
                    <button onclick="closeModal('modalViewDetail')" class="inline-flex items-center justify-center gap-2 px-4 py-2 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">Edit User</button>
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
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus User</h3>
                    <p class="text-gray-600 text-sm mb-6">Apakah Anda yakin ingin menghapus users "{{ $users->nama_lengkap }}"? Tindakan ini tidak dapat dibatalkan!</p>
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-center gap-3">
                            <button type="button" onclick="closeModal('modalDeleteConfirmation')" class="flex-1 px-4 py-2.5 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Batal</button>
                            <button type="submit" class="flex-1 px-4 py-2.5 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-medium">Hapus User</button>
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
        
        // Show Additional Fields Based on Role Selection
        function showAdditionalFields(role) {
            const additionalSection = document.getElementById('additionalSettings');
            additionalSection.classList.remove('hidden');
        }
        
        // Enable/Disable Email Fields
        function enableDisableFields() {
            const sendEmail = document.getElementById('send_email_change').checked;
            const subjectField = document.getElementById('subjectEmailField');
            const bodyField = document.getElementById('bodyEmailField');
            
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
            
            // Check password fields if not keeping same
            const keepSame = document.getElementById('keep_same').checked;
            if (!keepSame) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                
                if (password !== confirmPassword && confirmPassword !== '') {
                    hasError = true;
                    isValid = false;
                    alert('Password tidak cocok!');
                }
                
                if (password.length < 8) {
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