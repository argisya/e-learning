<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Guru - E-Learning</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = { theme: { extend: { colors: { primary: { 50: '#f0f4ff', 100: '#e0eaff', 200: '#c7d7fe', 300: '#a4bcfd', 400: '#8098f9', 500: '#667eea', 600: '#5a67d8', 700: '#4c51bf', 800: '#434190', 900: '#3c366b' } } } } }
    </script>
    
    <style>
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    </style>
</head>
<body class="bg-gray-50 font-sans">
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
                <a href="{{ route('data-guru.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-gray-700 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        
        <!-- Content Card -->
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="relative h-1 bg-gray-200">
                <div class="absolute left-0 top-0 h-full gradient-bg" style="width: 70%"></div>
            </div>
            
            <form action="{{ route('data-guru.update', ['id' => $teacher->id]) }}" method="POST" enctype="multipart/form-data" novalidate id="editForm" class="p-6 lg:p-8">
                
                @csrf
                @method('PUT')
                
                <!-- Profile Photo -->
                <div class="flex flex-col sm:flex-row items-start gap-6 mb-8 pb-8 border-b">
                    <div class="relative">
                        <img src="{{ asset($teacher->foto ?? 'images/avatar.jpg') }}" alt="Profile" class="w-24 h-24 rounded-xl object-cover border-4 border-primary-100">
                        <label class="absolute bottom-0 right-0 w-8 h-8 gradient-bg rounded-full flex items-center justify-center cursor-pointer hover:opacity-90 transition-opacity text-white" title="Ubah Foto">
                            <i class="fas fa-camera text-sm"></i>
                            <input type="file" name="foto_update" accept="image/*" class="hidden">
                        </label>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800">{{ $teacher->nama_lengkap }}</h3>
                        <p class="text-gray-500 text-sm font-mono">{{ $teacher->nip }}</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-blue-50 text-blue-700 font-medium">
                                <i class="fas fa-check-circle"></i> {{ ucfirst($teacher->status_kepagawaian) }}
                            </span>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-purple-50 text-purple-700 font-medium">
                                <i class="fas fa-chalkboard-teacher"></i> {{ ucfirst($teacher->nomenklatur) }}
                            </span>
                        </div>
                    </div>
                </div>
                
                <!-- Section 1: Identitas -->
                <div class="mb-8 pb-8 border-b">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-lg bg-primary-100 flex items-center justify-center text-primary-600 text-sm"><i class="fas fa-user-circle"></i></span>
                        Data Identitas Pribadi
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $teacher->nama_lengkap) }}" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP / NKK</label>
                            <input type="text" id="nip" name="nip" value="{{ old('nip', $teacher->nip) }}" readonly class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg bg-gray-100 cursor-not-allowed text-gray-500">
                        </div>
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $teacher->tempat_lahir) }}" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $teacher->tanggal_lahir) }}" required class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <div class="flex items-center gap-6">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" {{ old('jenis_kelamin', $teacher->jenis_kelamin) === 'Laki-laki' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" {{ old('jenis_kelamin', $teacher->jenis_kelamin) === 'Perempuan' ? 'checked' : '' }}>
                                    <span class="text-gray-700">Perempuan</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label for="agama" class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <select id="agama" name="agama" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                @foreach(['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $religion)
                                    <option value="{{ $religion }}" {{ old('agama', $teacher->agama) === $religion ? 'selected' : '' }}>{{ ucfirst($religion) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status_pernikahan" class="block text-sm font-medium text-gray-700 mb-1">Status Pernikahan</label>
                            <select id="status_pernikahan" name="status_pernikahan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="Belum Kawin" {{ old('status_pernikahan', $teacher->status_pernikahan) === 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="Kawin" {{ old('status_pernikahan', $teacher->status_pernikahan) === 'Kawin' ? 'selected' : '' }}>Menikah</option>
                                <option value="Cerai Hidup" {{ old('status_pernikahan', $teacher->status_pernikahan) === 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="Cerai Mati" {{ old('status_pernikahan', $teacher->status_pernikahan) === 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                            </select>
                        </div>
                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Handphone</label>
                            <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp', $teacher->no_hp) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div class="md:col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" rows="3" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all resize-none">{{ old('alamat', $teacher->alamat) }}</textarea>
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
                        <div>
                            <label for="status_kepagawaian" class="block text-sm font-medium text-gray-700 mb-1">Status Kepegawaian</label>
                            <select id="status_kepagawaian" name="status_kepagawaian" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="PNS" {{ old('status_kepagawaian', $teacher->status_kepagawaian) === 'PNS' ? 'selected' : '' }}>Pegawai Negeri Sipil</option>
                                <option value="PPPK" {{ old('status_kepagawaian', $teacher->status_kepagawaian) === 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                <option value="TKS" {{ old('status_kepagawaian', $teacher->status_kepagawaian) === 'TKS' ? 'selected' : '' }}>Tenaga Kontrak Sekolah</option>
                                <option value="Honorer" {{ old('status_kepagawaian', $teacher->status_kepagawaian) === 'Honorer' ? 'selected' : '' }}>Honorer Daerah</option>
                            </select>
                        </div>
                        <div>
                            <label for="nomenklatur" class="block text-sm font-medium text-gray-700 mb-1">Nomenklatur</label>
                            <input type="text" id="nomenklatur" name="nomenklatur" value="{{ old('nomenklatur', $teacher->nomenklatur) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label for="jabatan_struktural" class="block text-sm font-medium text-gray-700 mb-1">Jabatan Struktural</label>
                            <select id="jabatan_struktural" name="jabatan_struktural" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="">Tidak ada</option>
                                <option value="Kepala Sekolah" {{ old('jabatan_struktural', $teacher->jabatan_struktural) === 'Kepala Sekolah' ? 'selected' : '' }}>Kepala Sekolah</option>
                                <option value="Wakil Kepala Sekolah" {{ old('jabatan_struktural', $teacher->jabatan_struktural) === 'Wakil Kepala Sekolah' ? 'selected' : '' }}>Wakil Kepala Sekolah</option>
                                <option value="Guru BK" {{ old('jabatan_struktural', $teacher->jabatan_struktural) === 'Guru BK' ? 'selected' : '' }}>Guru BK</option>
                                <option value="Koordinator" {{ old('jabatan_struktural', $teacher->jabatan_struktural) === 'Koordinator' ? 'selected' : '' }}>Koordinator</option>
                            </select>
                        </div>
                        <div>
                            <label for="nomor_sk_jabatan" class="block text-sm font-medium text-gray-700 mb-1">Nomor SK Jabatan</label>
                            <input type="text" id="nomor_sk_jabatan" name="nomor_sk_jabatan" value="{{ old('nomor_sk_jabatan', $teacher->nomor_sk_jabatan) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label for="tanggal_sk_jabatan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal SK Jabatan</label>
                            <input type="date" id="tanggal_sk_jabatan" name="tanggal_sk_jabatan" value="{{ old('tanggal_sk_jabatan', $teacher->tanggal_sk_jabatan) }}" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label for="masa_kerja" class="block text-sm font-medium text-gray-700 mb-1">Masa Kerja (Tahun)</label>
                            <input type="number" id="masa_kerja" name="masa_kerja" value="{{ old('masa_kerja', $teacher->masa_kerja) }}" min="0" max="50" step="0.5" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all">
                        </div>
                        <div>
                            <label for="pangkat_golongan" class="block text-sm font-medium text-gray-700 mb-1">Pangkat / Golongan</label>
                            <select id="pangkat_golongan" name="pangkat_golongan" class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-lg focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none transition-all appearance-none bg-white">
                                <option value="Penata Muda III/a" {{ old('pangkat_golongan', $teacher->pangkat_golongan) === 'Penata Muda III/a' ? 'selected' : '' }}>Penata Muda III/a</option>
                                <option value="Penata Muda II/3b" {{ old('pangkat_golongan', $teacher->pangkat_golongan) === 'Penata Muda II/3b' ? 'selected' : '' }}>Penata Muda II/3b</option>
                                <option value="Penata Muda Tingkat I III/c" {{ old('pangkat_golongan', $teacher->pangkat_golongan) === 'Penata Muda Tingkat I III/c' ? 'selected' : '' }}>Penata Muda Tingkat I III/c</option>
                                <option value="Penata III/d" {{ old('pangkat_golongan', $teacher->pangkat_golongan) === 'Penata III/d' ? 'selected' : '' }}>Penata III/d</option>
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
        
        <!-- Modal View Detail -->
        <div id="modalViewDetail" class="fixed inset-0 z-[100] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeModal('modalViewDetail')"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full max-h-[90vh] overflow-y-auto">
                    <div class="sticky top-0 bg-gradient-to-r from-primary-500 to-secondary-500 px-6 py-4 text-white flex items-center justify-between">
                        <h3 class="text-lg font-bold">Detail Data Guru</h3>
                        <button onclick="closeModal('modalViewDetail')" class="hover:text-gray-200"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                            <img src="{{ asset($teacher->foto ?? 'images/avatar.jpg') }}" alt="Profile" class="w-20 h-20 rounded-full object-cover border-4 border-primary-100">
                            <div>
                                <h4 class="text-xl font-bold text-gray-800">{{ $teacher->nama_lengkap }}</h4>
                                <p class="text-sm text-gray-500">{{ $teacher->nomenklatur }}</p>
                                <p class="text-xs text-gray-400">NIP: {{ $teacher->nip }}</p>
                            </div>
                        </div>
                        <dl class="space-y-4 text-sm">
                            <div class="grid grid-cols-2 gap-4">
                                <dt class="font-medium text-gray-500">Tanggal Lahir</dt>
                                <dd class="text-gray-800">{{ \Carbon\Carbon::parse($teacher->tanggal_lahir)->isoFormat('D MMMM YYYY') }}</dd>
                                
                                <dt class="font-medium text-gray-500">Tempat Lahir</dt>
                                <dd class="text-gray-800">{{ $teacher->tempat_lahir }}</dd>
                                
                                <dt class="font-medium text-gray-500">Jenis Kelamin</dt>
                                <dd class="text-gray-800">{{ $teacher->jenis_kelamin }}</dd>
                                
                                <dt class="font-medium text-gray-500">Agama</dt>
                                <dd class="text-gray-800">{{ $teacher->agama }}</dd>
                                
                                <dt class="font-medium text-gray-500">Status Pernikahan</dt>
                                <dd class="text-gray-800">{{ $teacher->status_pernikahan }}</dd>
                                
                                <dt class="font-medium text-gray-500">No HP</dt>
                                <dd class="text-gray-800">{{ $teacher->no_hp }}</dd>
                            </div>
                            
                            <div class="pt-4 border-t">
                                <dt class="font-medium text-gray-500">Status Kepegawaian</dt>
                                <dd class="text-gray-800">{{ $teacher->status_kepagawaian }}</dd>
                                
                                <dt class="font-medium text-gray-500">Masa Kerja</dt>
                                <dd class="text-gray-800">{{ $teacher->masa_kerja }} Tahun</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="sticky bottom-0 bg-gray-50 px-6 py-4 border-t">
                        <button onclick="closeModal('modalViewDetail')" class="gradient-bg text-white w-full px-4 py-2.5 rounded-lg hover:opacity-90 transition-all font-medium">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Delete Confirmation -->
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
                        <p class="text-gray-600 text-sm mb-6">Data guru akan dihapus permanen. Tindakan ini tidak dapat dibatalkan!</p>
                        <form action="{{ route('data-guru.destroy', ['id' => $teacher->id]) }}" method="POST">
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
    
    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
        
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }
    </script>
</body>
</html>