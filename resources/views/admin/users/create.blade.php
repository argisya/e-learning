@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
<div class="min-h-screen py-8 px-4">
    
    <!-- Header -->
    <div class="max-w-3xl mx-auto mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Tambah User Baru</h1>
            <p class="text-gray-500 mt-1 text-sm">Isi formulir di bawah ini untuk menambahkan pengguna baru ke sistem</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-primary-600 transition-colors">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    
    <!-- Content Card -->
    <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden">
        <form action="" method="POST" novalidate id="createForm" class="p-6 lg:p-8">
            
            @csrf
            
            <!-- Section 1: Information Account -->
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
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap sesuai KTP" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        @error('nama_lengkap')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i class="fas fa-user absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="Pilih username unik" required autocomplete="off" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Minimal 6 karakter, hanya huruf dan angka</p>
                        @error('username')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="password" id="password" name="password" placeholder="Min. 8 karakter, gabungan huruf & angka" required autocomplete="new-password" onkeyup="checkStrength(this.value)" class="w-full pl-10 pr-12 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            <div id="strengthMeter" class="strength-meter hidden"></div>
                        </div>
                        <div class="flex items-center gap-2 mt-2">
                            <span id="strengthText" class="text-xs font-medium"></span>
                            <label class="flex items-center gap-1 cursor-pointer text-xs text-gray-600">
                                <input type="checkbox" onchange="togglePasswordVisibility('password', this)">
                                Lihat Password
                            </label>
                        </div>
                        @error('password')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    
                    <!-- Konfirmasi Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i class="fas fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password yang sama" required autocomplete="new-password" onkeyup="verifyPasswordMatch(this.value)" class="w-full pl-10 pr-10 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            <i id="matchIcon" class="fas fa-check absolute right-3 top-1/2 -translate-y-1/2 text-green-500 hidden"></i>
                            <i id="unmatchIcon" class="fas fa-times absolute right-3 top-1/2 -translate-y-1/2 text-red-500 hidden"></i>
                        </div>
                        @error('password_confirmation')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <i class="fas fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                    
                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2 ">Role / Peran <span class="text-red-500">*</span></label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            
                            <!-- Role Admin -->
                            <label class="relative cursor-pointer ">
                                <input type="radio" name="role" value="admin" {{ old('role') === 'admin' ? 'checked' : '' }} required onchange="showAdditionalFields(this.value)">
                                <div class="p-4 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center mb-2 group-hover:bg-red-500 group-hover:text-white transition-colors">
                                        <i class="fas fa-user-shield text-red-600 text-lg group-hover:text-white"></i>
                                    </div>
                                    <p class="text-sm font-medium text-gray-700 text-center">Administrator</p>
                                </div>
                            </label>
                            
                            <!-- Role Guru -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="guru" {{ old('role') === 'guru' ? 'checked' : '' }} required onchange="showAdditionalFields(this.value)">
                                <div class="p-4 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mb-2 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                                        <i class="fas fa-chalkboard-teacher text-blue-600 text-lg group-hover:text-white"></i>
                                    </div>
                                    <p class="text-sm font-medium text-gray-700 text-center">Guru</p>
                                </div>
                            </label>
                            
                            <!-- Role Siswa -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="role" value="siswa" {{ old('role') === 'siswa' ? 'checked' : '' }} required onchange="showAdditionalFields(this.value)">
                                <div class="p-4 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-all group">
                                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mb-2 group-hover:bg-green-500 group-hover:text-white transition-colors">
                                        <i class="fas fa-user-graduate text-green-600 text-lg group-hover:text-white"></i>
                                    </div>
                                    <p class="text-sm font-medium text-gray-700 text-center">Siswa</p>
                                </div>
                            </label>
                            
                        </div>
                        <p class="text-xs text-gray-500 mt-2">* Pilih role untuk menentukan hak akses user</p>
                    </div>
                    
                    <!-- Status Akun -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status Akun <span class="text-red-500">*</span></label>
                        <div class="flex items-center gap-6">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status" value="active" checked {{ old('status', 'active') === 'active' ? 'checked' : '' }}>
                                <div class="flex items-center gap-1">
                                    <span class="status-dot status-active"></span>
                                    <span class="text-gray-700">Aktif</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="status" value="inactive" {{ old('status') === 'inactive' ? 'checked' : '' }}>
                                <div class="flex items-center gap-1">
                                    <span class="status-dot status-inactive"></span>
                                    <span class="text-gray-700">Tidak Aktif</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
                <!-- Section 2: Additional Settings -->
                <div id="additionalSettings" class="mb-8 pb-8 border-b hidden">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-cog"></i>
                        </span>
                        Pengaturan Tambahan
                    </h2>
                    
                    <div class="space-y-6">
                        
                        <!-- Kirim Email Invitation -->
                        <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-lg">
                            <input type="checkbox" id="send_email" checked onchange="enableDisableFields()">
                            <div class="flex-1">
                                <label for="send_email" class="font-medium text-gray-800">Kirim Email Undangan</label>
                                <p class="text-sm text-gray-500 mt-1">Kirim email undangan login ke alamat email user</p>
                            </div>
                        </div>
                        
                        <!-- Subject Email -->
                        <div id="subjectEmailField" class="opacity-100 transition-opacity">
                            <label for="email_subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek Email</label>
                            <input type="text" id="email_subject" value="Undangan Login - E-Learning Platform" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Email Body -->
                        <div id="bodyEmailField" class="opacity-100 transition-opacity">
                            <label for="email_body" class="block text-sm font-medium text-gray-700 mb-1">Isi Email</label>
                            <textarea id="email_body" rows="3" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">Selamat datang di E-Learning Platform!

Gunakan kredensial berikut untuk login:
Username: [username_anda]
Tempat login: https://platform.sekolah.sch.id/login

Jika ada pertanyaan, hubungi administrator.

Terima kasih,
Tim E-Learning</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                        <i class="fas fa-save"></i> Simpan User
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
    
    <script>
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
            
            // Uncomment below to hide/show section based on role
            // if (role === 'admin') {
            //     additionalSection.classList.remove('hidden');
            // } else {
            //     additionalSection.classList.add('hidden');
            // }
            
            additionalSection.classList.remove('hidden');
        }
        
        // Enable/Disable Email Fields
        function enableDisableFields() {
            const sendEmail = document.getElementById('send_email').checked;
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
            }
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        });
    </script>
</body>
</html>