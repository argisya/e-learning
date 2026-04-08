@extends('layouts.app')

@section('title', 'Data Guru')

@section('content')
    <div class="min-h-screen py-8 px-4">
        
        <!-- Header -->
        <div class="max-w-3xl mx-auto mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Edit Kelas</h1>
                <p class="text-gray-500 mt-1 text-sm">{{ __('Update data kelas berikut jika diperlukan.') }}</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="openModal('modalViewDetail')" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">
                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                </button>
                <a href="{{ route('admin.kelas.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">
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
            
            <form action="{{ route('admin.kelas.update', ['id_kelas' => $kelas->id_kelas]) }}" method="POST" enctype="multipart/form-data" novalidate id="editForm" class="p-6 lg:p-8">
                
                @csrf
                @method('PUT')
                
                <!-- Profile Section -->
                <div class="flex items-start gap-6 mb-8 pb-8 border-b">
                    <div class="w-20 h-20 rounded-xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center border-2 border-primary-200">
                        <i class="fas fa-school text-3xl text-primary-600"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800">{{ $kelas->nama_kelas }}</h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs {{ $kelas->status === 'aktif' ? 'bg-green-50 text-green-700' : ($kelas->status === 'lulus' ? 'bg-blue-50 text-blue-700' : 'bg-gray-50 text-gray-700') }}">
                                {{ ucfirst($kelas->status) }}
                            </span>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-purple-50 text-purple-700">
                                <i class="fas fa-user-tie"></i> {{ $kelas->wali_kelas ?? 'Belum Ditunjuk' }}
                            </span>
                        </div>
                    </div>
                </div>
                
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
                            <input type="text" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required autocomplete="off" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                            @error('nama_kelas')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <!-- Jenjang Pendidikan -->
                        <div>
                            <label for="jenjang" class="block text-sm font-medium text-gray-700 mb-1">Jenjang Pendidikan <span class="text-red-500">*</span></label>
                            <select id="jenjang" name="jenjang" required onchange="generateCodePreview()" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Jenjang --</option>
                                <option value="SMP" {{ old('jenjang', $kelas->jenjang) === 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA" {{ old('jenjang', $kelas->jenjang) === 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="SMK" {{ old('jenjang', $kelas->jenjang) === 'SMK' ? 'selected' : '' }}>SMK</option>
                            </select>
                            @error('jenjang')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Tingkat/Kelas -->
                        <div>
                            <label for="tingkat" class="block text-sm font-medium text-gray-700 mb-1">Tingkat / Kelas <span class="text-red-500">*</span></label>
                            <select id="tingkat" name="tingkat" required onchange="generateCodePreview()" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Tingkat --</option>
                                <option value="VII" {{ old('tingkat', $kelas->tingkat) === 'VII' ? 'selected' : '' }}>VII</option>
                                <option value="VIII" {{ old('tingkat', $kelas->tingkat) === 'VIII' ? 'selected' : '' }}>VIII</option>
                                <option value="IX" {{ old('tingkat', $kelas->tingkat) === 'IX' ? 'selected' : '' }}>IX</option>
                                <option value="X" {{ old('tingkat', $kelas->tingkat) === 'X' ? 'selected' : '' }}>X</option>
                                <option value="XI" {{ old('tingkat', $kelas->tingkat) === 'XI' ? 'selected' : '' }}>XI</option>
                                <option value="XII" {{ old('tingkat', $kelas->tingkat) === 'XII' ? 'selected' : '' }}>XII</option>
                            </select>
                            @error('tingkat')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Jurusan/Program Keahlian -->
                        <div>
                            <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-1">Jurusan / Program Keahlian</label>
                            <select id="jurusan" name="jurusan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Jurusan --</option>
                                <option value="" {{ old('jurusan', $kelas->jurusan) === null ? 'selected' : '' }}>-- Tanpa Jurusan --</option>
                                <option value="IPA" {{ old('jurusan', $kelas->jurusan) === 'IPA' ? 'selected' : '' }}>IPA</option>
                                <option value="IPS" {{ old('jurusan', $kelas->jurusan) === 'IPS' ? 'selected' : '' }}>IPS</option>
                                <option value="Bahasa" {{ old('jurusan', $kelas->jurusan) === 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                                <option value="Teknik" {{ old('jurusan', $kelas->jurusan) === 'Teknik' ? 'selected' : '' }}>Teknik</option>
                            </select>
                            @error('jurusan')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Tahun Ajaran -->
                        <div>
                            <label for="tahun_ajaran" class="block text-sm font-medium text-gray-700 mb-1">Tahun Ajaran <span class="text-red-500">*</span></label>
                            <select id="tahun_ajaran" name="tahun_ajaran" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Tahun Ajaran --</option>
                                <option value="2024/2025" {{ old('tahun_ajaran', $kelas->tahun_ajaran) === '2024/2025' ? 'selected' : '' }}>2024/2025</option>
                                <option value="2025/2026" {{ old('tahun_ajaran', $kelas->tahun_ajaran) === '2025/2026' ? 'selected' : '' }}>2025/2026</option>
                                <option value="2026/2027" {{ old('tahun_ajaran', $kelas->tahun_ajaran) === '2026/2027' ? 'selected' : '' }}>2026/2027</option>
                            </select>
                            @error('tahun_ajaran')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>
                
                <!-- Section 2: Wali Kelas & Informasi Tambahan -->
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
                            <label for="nip_wali" class="block text-sm font-medium text-gray-700 mb-1">Pilih Wali Kelas <span class="text-red-500">*</span></label>
                            <select id="nip_wali" name="nip_wali" required onchange="loadWaliInfo(this.value)" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">-- Pilih Guru Wali Kelas --</option>
                                <option value="{{ old('nip_wali') }}" disabled selected>Pilih Guru</option>
                                @foreach($guru as $teacher)
                                    <option value="{{ $teacher->nip }}">{{ $teacher->nama_lengkap }} | NIP: {{ $teacher->nip }}</option>
                                @endforeach
                            </select>
                            @error('nip_wali')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Info Wali Kelas Preview -->
                        <!-- <div id="waliInfoPreview" class="hidden p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-info-circle text-blue-600 text-xl mt-1"></i>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-800 text-sm">Informasi Wali Kelas Terpilih</p>
                                    <ul class="text-xs text-gray-500 mt-2 space-y-1">
                                        <li><strong>Nama:</strong> <span class="text-gray-800">Dr. Ahmad Fauzi, M.Pd.</span></li>
                                        <li><strong>NIP:</strong> <span class="text-gray-800">198501012008011001</span></li>
                                        <li><strong>Email:</strong> <span class="text-gray-800">ahmad.fauzi@sekolah.sch.id</span></li>
                                        <li><strong>Status:</strong> <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                            <span class="status-dot status-active"></span>Aktif
                                        </span></li>
                                    </ul>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                
                <!-- Section 3: Status & Catatan -->
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
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="status" value="aktif" {{ old('status', $kelas->status) === 'aktif' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-primary-500 peer-checked:border-primary-500 peer-checked:bg-primary-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mb-2 peer-checked:bg-green-500 peer-checked:text-white transition-colors">
                                            <i class="fas fa-check-circle text-green-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Aktif</p>
                                    </div>
                                </label>
                                
                                <label class="relative cursor-pointer group">
                                    <input type="radio" name="status" value="tidak_aktif" {{ old('status', $kelas->status) === 'tidak_aktif' ? 'checked' : '' }} required class="peer sr-only">
                                    <div class="p-4 border-2 border-gray-200 rounded-lg group-hover:border-gray-400 peer-checked:border-gray-400 peer-checked:bg-gray-50 transition-all">
                                        <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center mb-2 peer-checked:bg-gray-400 peer-checked:text-white transition-colors">
                                            <i class="fas fa-times-circle text-gray-600 text-lg peer-checked:text-white"></i>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 text-center">Tidak Aktif</p>
                                    </div>
                                </label>
                            </div>
                            @error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                        </div>
                        
                        <!-- Keterangan Khusus -->
                        <div class="md:col-span-2">
                            <label for="keterangan_khusus" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Khusus (Opsional)</label>
                            <textarea id="keterangan_khusus" name="keterangan_khusus" rows="3" placeholder="Tambahkan keterangan khusus jika diperlukan..." class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('keterangan_khusus', $kelas->keterangan_khusus) }}</textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="flex flex-col sm:flex-row justify-between gap-3 pt-6 border-t">
                    <button type="button" onclick="openModal('modalDeleteConfirmation')" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors font-medium">
                        <i class="fas fa-trash-alt"></i> Hapus Kelas
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
                    <h3 class="text-lg font-bold">Detail Data Kelas</h3>
                    <button onclick="closeModal('modalViewDetail')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                </div>
                <div class="p-6">
                    
                    <!-- Class Profile -->
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                        <div class="w-16 h-16 rounded-xl bg-primary-100 flex items-center justify-center">
                            <i class="fas fa-school text-3xl text-primary-600"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-800">{{ $kelas->nama_kelas }}</h4>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg badge {{ $kelas->status === 'aktif' ? 'badge-active' : ($kelas->status === 'lulus' ? 'badge-lulus' : 'badge-inactive') }} mt-2">
                                {{ ucfirst($kelas->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Info Grid -->
                    <dl class="space-y-4 text-sm">
                        <div class="grid grid-cols-2 gap-4">
                            <dt class="font-medium text-gray-500">Jenjang</dt>
                            <dd class="text-gray-800"><span class="badge badge-active">{{ $kelas->jenjang ?? '-' }}</span></dd>
                            
                            <dt class="font-medium text-gray-500">Tingkat</dt>
                            <dd class="text-gray-800">{{ $kelas->tingkat ?? '-' }}</dd>
                            
                            <dt class="font-medium text-gray-500">Jurusan</dt>
                            <dd class="text-gray-800">{{ $kelas->jurusan ?? '-' }}</dd>
                            
                            <dt class="font-medium text-gray-500">Tahun Ajaran</dt>
                            <dd class="text-gray-800">{{ $kelas->tahun_ajaran ?? '-' }}</dd>
                            
                            <dt class="font-medium text-gray-500">Wali Kelas</dt>
                            <dd class="text-gray-800">
                                <div class="flex items-center gap-2 mt-1">
                                    <img src="{{ asset('images/avatar.jpg') }}" alt="" class="w-8 h-8 rounded-full object-cover border-2">
                                    <div>
                                        <p class="font-medium text-gray-800">Dr. Ahmad Fauzi, M.Pd.</p>
                                        <p class="text-xs text-gray-500">NIP: 19850101</p>
                                    </div>
                                </div>
                            </dd>
                            
                            <dt class="font-medium text-gray-500">Tanggal Update</dt>
                            <dd class="text-gray-800">{{ \Carbon\Carbon::parse($kelas->updated_at)->isoFormat('D MMMM YYYY HH:mm') }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t flex justify-end gap-3">
                    <button onclick="closeModal('modalViewDetail')" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition-colors font-medium">Tutup</button>
                    <button onclick="closeModal('modalViewDetail')" class="inline-flex items-center justify-center gap-2 px-4 py-2 gradient-bg text-white rounded-lg hover:opacity-90 transition-all font-medium shadow-md">Edit Kelas</button>
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
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Hapus Data Kelas</h3>
                    <p class="text-gray-600 text-sm mb-6">Apakah Anda yakin ingin menghapus data kelas "{{ $kelas->nama_kelas }}"? Tindakan ini tidak dapat dibatalkan!</p>
                    <form action="{{ route('admin.kelas.destroy', ['id_kelas' => $kelas->id_kelas]) }}" method="POST">
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
        
        // Load Wali Kelas Info
        function loadWaliInfo(value) {
            const previewDiv = document.getElementById('waliInfoPreview');
            
            if (value && value !== '') {
                previewDiv.classList.remove('hidden');
            } else {
                previewDiv.classList.add('hidden');
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