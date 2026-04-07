@extends('layouts.app')

@section('title', 'Tambah Kelas - Admin')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-3xl mx-auto mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Tambah Kelas</h1>
                <p class="text-gray-500 mt-1 text-sm">Isi formulir di bawah ini untuk menambahkan kelas baru ke sistem</p>
            </div>
            <a href="{{ route('admin.kelas.index') }}" class="inline-flex items-center gap-2 text-gray-600 hover:text-primary-600 transition-colors">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        <!-- Content Card -->
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden">
            <form action="" method="POST" enctype="multipart/form-data" novalidate id="createForm" class="p-6 lg:p-8">
                
                @csrf
                
                <!-- Section 1: Identitas Kelas -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-id-card"></i>
                        </span>
                        Identitas Kelas
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Nama Kelas -->
                        <div>
                            <label for="nama_kelas" class="block text-sm font-medium text-gray-700 mb-1">Nama Kelas <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}" placeholder="Contoh: Kelas VII A" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_kelas')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Kode Kelas -->
                        <div>
                            <label for="kode_kelas" class="block text-sm font-medium text-gray-700 mb-1">Kode Kelas <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <i class="fas fa-hashtag absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                                <input type="text" id="kode_kelas" name="kode_kelas" value="{{ old('kode_kelas', 'IT-AF-'. strtoupper($jenjang ?? 'SMP') .'-' . strtoupper($tingkat ?? 'VII') .'-'. strtoupper(date('Y')) ) }}" required autocomplete="off" class="w-full pl-10 pr-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all font-mono text-xs">
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Format otomatis berdasarkan jenjang, tingkat, dan tahun ajaran</p>
                            @error('kode_kelas')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Jenjang Pendidikan -->
                        <div>
                            <label for="jenjang" class="block text-sm font-medium text-gray-700 mb-1">Jenjang Pendidikan <span class="text-red-500">*</span></label>
                            <select id="jenjang" name="jenjang" required onchange="generateCodePreview()" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Jenjang --</option>
                                <option value="SMP" {{ old('jenjang') === 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('jenjang') === 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="SMK" {{ old('jenjang') === 'SMK' ? 'selected' : '' }}>SMK</option>
                            </select>
                            @error('jenjang')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Tingkat/Kelas -->
                        <div>
                            <label for="tingkat" class="block text-sm font-medium text-gray-700 mb-1">Tingkat / Kelas <span class="text-red-500">*</span></label>
                            <select id="tingkat" name="tingkat" required onchange="generateCodePreview()" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Tingkat --</option>
                                <option value="VII" {{ old('tingkat') === 'VII' ? 'selected' : '' }}>VII</option>
                                <option value="VIII" {{ old('tingkat') === 'VIII' ? 'selected' : '' }}>VIII</option>
                                <option value="IX" {{ old('tingkat') === 'IX' ? 'selected' : '' }}>IX</option>
                                <option value="X" {{ old('tingkat') === 'X' ? 'selected' : '' }}>X</option>
                                <option value="XI" {{ old('tingkat') === 'XI' ? 'selected' : '' }}>XI</option>
                                <option value="XII" {{ old('tingkat') === 'XII' ? 'selected' : '' }}>XII</option>
                            </select>
                            @error('tingkat')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Program Keahlian -->
                        <div>
                            <label for="program_keahlian" class="block text-sm font-medium text-gray-700 mb-1">Program Keahlian</label>
                            <select id="program_keahlian" name="program_keahlian" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Program --</option>
                                <option value="IPA" {{ old('program_keahlian') === 'IPA' ? 'selected' : '' }}>IPA</option>
                                <option value="IPS" {{ old('program_keahlian') === 'IPS' ? 'selected' : '' }}>IPS</option>
                                <option value="Bahasa" {{ old('program_keahlian') === 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                                <option value="Teknik" {{ old('program_keahlian') === 'Teknik' ? 'selected' : '' }}>Teknik</option>
                            </select>
                        </div>
                        
                        <!-- Jurusan -->
                        <div>
                            <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan / Jurusan</label>
                            <input type="text" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" placeholder="Contoh: MIPA" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                    </div>
                </div>
                
                <!-- Section 2: Ruang & Jadwal -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-calendar-check"></i>
                        </span>
                        Ruang & Jadwal
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Ruang Kelas -->
                        <div>
                            <label for="ruang_kelas" class="block text-sm font-medium text-gray-700 mb-1">Ruang Kelas <span class="text-red-500">*</span></label>
                            <input type="text" id="ruang_kelas" name="ruang_kelas" value="{{ old('ruang_kelas') }}" placeholder="Contoh: R101" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all uppercase">
                            @error('ruang_kelas')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Kapasitas Ruangan -->
                        <div>
                            <label for="kapasitas_ruangan" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas Ruangan</label>
                            <input type="number" id="kapasitas_ruangan" name="kapasitas_ruangan" value="{{ old('kapasitas_ruangan', 35) }}" min="1" max="100" placeholder="Jumlah maksimal siswa" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            <p class="text-xs text-gray-500 mt-1">Sesuai daya tampung ruangan</p>
                        </div>
                        
                        <!-- Jam Pelajaran Mulai -->
                        <div>
                            <label for="jam_pelajar_mulai" class="block text-sm font-medium text-gray-700 mb-1">Jam Pelajaran Mulai</label>
                            <input type="time" id="jam_pelajar_mulai" name="jam_pelajar_mulai" value="{{ old('jam_pelajar_mulai', '07:00') }}" step="900" min="06:00" max="23:00" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Jam Pelajaran Selesai -->
                        <div>
                            <label for="jam_pelajar_selesai" class="block text-sm font-medium text-gray-700 mb-1">Jam Pelajaran Selesai</label>
                            <input type="time" id="jam_pelajar_selesai" name="jam_pelajar_selesai" value="{{ old('jam_pelajar_selesai', '15:00') }}" step="900" min="06:00" max="23:00" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        
                        <!-- Hari Operasional -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Hari Operasional <span class="text-gray-500 font-normal">(Opsional)</span></label>
                            <div class="flex flex-wrap gap-3">
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                                    <label class="flex items-center gap-2 cursor-pointer px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors">
                                        <input type="checkbox" name="hari_operasional[]" value="{{ $day }}" {{ old('hari_operasional') && in_array($day, old('hari_operasional', [])) ? 'checked' : '' }} class="rounded text-primary-500 focus:ring-primary-500">
                                        <span class="text-sm text-gray-700">{{ $day }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Section 3: Wali Kelas -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-user-tie"></i>
                        </span>
                        Wali Kelas
                    </h2>
                    
                    <div class="space-y-4">
                        
                        <!-- Pilih Wali Kelas -->
                        <div>
                            <label for="wali_kelas" class="block text-sm font-medium text-gray-700 mb-1">Pilih Wali Kelas <span class="text-red-500">*</span></label>
                            <select id="wali_kelas" name="wali_kelas" required onchange="loadWaliInfo(this.value)" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Guru Wali Kelas --</option>
                                <option value="{{ old('wali_kelas') }}" disabled selected>Pilih Guru</option>
                                @foreach(range(1, 20) as $teacherId)
                                    <option value="{{ $teacherId }}">{{ old('wali_kelas') }} Dr. Ahmad Fauzi, M.Pd. | NIP: 198501012008011001</option>
                                    <option value="{{ $teacherId + 1 }}">Bu Siti Aminah, S.Pd. | NIP: 198906022013012002</option>
                                    <option value="{{ $teacherId + 2 }}">Pak Budi Santoso, M.Si. | NIP: 199201022014011003</option>
                                @endforeach
                            </select>
                            @error('wali_kelas')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Info Wali Kelas Preview -->
                        <div id="waliInfoPreview" class="hidden p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-info-circle text-blue-600 text-xl mt-1"></i>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800 text-sm">Informasi Wali Kelas Terpilih</p>
                                    <ul class="text-xs text-gray-500 mt-2 space-y-1">
                                        <li><strong>Nama:</strong> <span class="text-gray-800">Dr. Ahmad Fauzi, M.Pd.</span></li>
                                        <li><strong>NIP:</strong> <span class="text-gray-800">198501012008011001</span></li>
                                        <li><strong>Status:</strong> <span class="badge badge-active"><span class="status-dot status-active"></span> Aktif</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Section 4: Status & Catatan -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm">
                            <i class="fas fa-toggle-on"></i>
                        </span>
                        Status & Catatan
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Status Kelas -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Kelas <span class="text-red-500">*</span></label>
                            <select id="status_kelas" name="status_kelas" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="aktif" {{ old('status_kelas', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ old('status_kelas') === 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="lulus" {{ old('status_kelas') === 'lulus' ? 'selected' : '' }}>Lulus</option>
                            </select>
                            @error('status_kelas')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Tahun Ajaran -->
                        <div>
                            <label for="tahun_ajaran" class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran <span class="text-red-500">*</span></label>
                            <select id="tahun_ajaran" name="tahun_ajaran" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                <option value="2024/2025" {{ old('tahun_ajaran') === '2024/2025' ? 'selected' : '' }}>2024/2025</option>
                                <option value="2025/2026" {{ old('tahun_ajaran') === '2025/2026' ? 'selected' : '' }}>2025/2026</option>
                                <option value="2026/2027" {{ old('tahun_ajaran') === '2026/2027' ? 'selected' : '' }}>2026/2027</option>
                            </select>
                            @error('tahun_ajaran')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Keterangan Khusus -->
                        <div class="md:col-span-2">
                            <label for="keterangan_khusus" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Khusus (Opsional)</label>
                            <textarea id="keterangan_khusus" name="keterangan_khusus" rows="3" placeholder="Tambahkan keterangan khusus jika diperlukan..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('keterangan_khusus') }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t">
                    <a href="{{ route('admin.kelas.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">
                        <i class="fas fa-save"></i> Simpan Kelas
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
    
    <script>
        // Generate Code Preview on Input Change
        function generateCodePreview() {
            const jenjang = document.getElementById('jenjang').value || '{{ strtolower(old('jenjang', 'SMP')) }}';
            const tingkat = document.getElementById('tingkat').value || '{{ strtolower(old('tingkat', 'VII')) }}';
            const tahunAjaran = document.getElementById('tahun_ajaran').value || '2024';
            
            const previewText = `IT-AF-${jenjang.toUpperCase()}-${tingkat.toUpperCase()}-${tahunAjaran}`;
            document.getElementById('kode_kelas').value = previewText;
        }
        
        // Load Wali Kelas Info
        function loadWaliInfo(value) {
            const previewDiv = document.getElementById('waliInfoPreview');
            
            if (value) {
                previewDiv.classList.remove('hidden');
            } else {
                previewDiv.classList.add('hidden');
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
            
            if (!isValid) {
                e.preventDefault();
                alert('Harap lengkapi semua field yang wajib diisi!');
            }
        });
        
        // Auto-generate code on page load
        window.addEventListener('DOMContentLoaded', generateCodePreview);
    </script>