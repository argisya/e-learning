<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\JadwalUjian;
use App\Models\KategoriPengumuman;
use App\Models\KehadiranGuru;
use App\Models\KehadiranSiswa;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\OrangTuaSiswa;
use App\Models\Pengumuman;
use App\Models\Rapor;
use App\Models\Roles;
use App\Models\Siswa;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Roles first
        $adminRole = Roles::create([
            'nama_role' => 'Admin'
        ]);

        $guruRole = Roles::create([
            'nama_role' => 'Guru'
        ]);

        $siswaRole = Roles::create([
            'nama_role' => 'Siswa'
        ]);

        $orangtuaRole = Roles::create([
            'nama_role' => 'Orang Tua'
        ]);

        // Create Users for Guru and Siswa
        $userAdmin = User::create([
            'id_role' => $adminRole->id_role,
            'nama_lengkap' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('password123'),
            'email' => 'admin@gmail.com',
            'status' => 'Aktif'
        ]);

        $userGuru = User::create([
            'id_role' => $guruRole->id_role,
            'nama_lengkap' => 'Guru',
            'username' => 'guru',
            'password' => bcrypt('password123'),
            'email' => 'guru@gmail.com',
            'status' => 'Aktif'
        ]);

        $userSiswa = User::create([
            'id_role' => $siswaRole->id_role,
            'nama_lengkap' => 'Siswa',
            'username' => 'siswa',
            'password' => bcrypt('password123'),
            'email' => 'siswa@gmail.com',
            'status' => 'Aktif'
        ]);

        // Create Guru
        $guru = Guru::create([
            'nip' => 'NIP001',
            'id_user' => $userGuru->id_user,
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1980-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'status_pernikahan' => 'Menikah',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 123, Jakarta',
            'foto' => null,
            'golongan' => 'IV/a',
            'masa_kerja' => '10',
            'jabatan' => 'Guru Matematika',
            'no_sk' => 'SK123456'
        ]);

        // Create Kelas
        $kelas = Kelas::create([
            'id_kelas' => 1,
            'nip_wali' => 'NIP001',
            'nama_kelas' => '10A',
            'ruangan' => 'R.101',
            'status' => 'Aktif'
        ]);

        // Create Mapel
        $mapel = Mapel::create([
            'id_mapel' => 1,
            'nama_mapel' => 'Matematika'
        ]);

        // Create Siswa with string NIS as primary key
        $siswa = Siswa::create([
            'nis' => 'NIS001',
            'id_user' => $userSiswa->id_user,
            'id_kelas' => $kelas->id_kelas,
            'nisn' => 1234567890,
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2005-05-15',
            'jenis_kelamin' => 'P',
            'agama' => 'Kristen',
            'status_keluarga' => 'Anak Kandung',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Sudirman No. 456, Bandung'
        ]);

        // Create Jadwal (using nip and jam)
        Jadwal::create([
            'nip' => 'NIP001',
            'id_kelas' => $kelas->id_kelas,
            'id_mapel' => $mapel->id_mapel,
            'hari' => 'Senin',
            'jam' => '08:00:00'
        ]);

        // Create JadwalUjian
        JadwalUjian::create([
            'id_mapel' => $mapel->id_mapel,
            'tanggal' => '2024-12-01',
            'waktu' => '09:00:00',
            'durasi' => 120,
            'ruangan' => 'Aula',
            'nip_pengawas' => 'NIP001',
            'status' => 'Terjadwal'
        ]);

        // Create Pengumuman first
        $pengumuman = Pengumuman::create([
            'id_pembuat' => $userGuru->id_user,
            'judul_pengumuman' => 'Libur Sekolah',
            'isi_pengumuman' => 'Sekolah akan libur pada tanggal 25 Desember 2024 hingga 1 Januari 2025.',
            'tanggal_pengumuman' => '2024-11-01',
            'status' => 'Aktif'
        ]);

        // Create KategoriPengumuman after Pengumuman
        KategoriPengumuman::create([
            'id_pengumuman' => $pengumuman->id_pengumuman,
            'id_role' => $siswaRole->id_role
        ]);

        // Create KehadiranGuru (using nip instead of id_guru)
        KehadiranGuru::create([
            'nip' => 'NIP001',
            'tanggal' => '2024-11-01',
            'id_kelas' => $kelas->id_kelas,
            'id_mapel' => $mapel->id_mapel,
            'status' => 'Hadir',
            'keterangan' => 'Hadir tepat waktu'
        ]);

        // Create KehadiranSiswa (using nis instead of id_siswa)
        KehadiranSiswa::create([
            'nis' => 'NIS001',
            'id_kelas' => $kelas->id_kelas,
            'id_mapel' => $mapel->id_mapel,
            'tanggal' => '2024-11-01',
            'status' => 'Hadir',
            'keterangan' => 'Hadir tepat waktu'
        ]);

        // Create Rapor (using nis instead of id_siswa)
        $rapor = Rapor::create([
            'id_rapor' => 1,
            'nis' => 'NIS001',
            'semester' => '1',
            'tahun' => '2024'
        ]);

        // Create Nilai (requires id_rapor)
        Nilai::create([
            'id_rapor' => $rapor->id_rapor,
            'id_mapel' => $mapel->id_mapel,
            'nilai_pengetahuan' => 85.00,
            'nilai_keterampilan' => 80.00,
            'nilai_akhir' => 82.50,
            'catatan' => 'Bagus'
        ]);

        // Create OrangTuaSiswa (using nis instead of id_siswa)
        OrangTuaSiswa::create([
            'nis' => 'NIS001',
            'nama_wali' => 'Budi Santoso',
            'status_hubungan' => 'Ayah',
            'pekerjaan' => 'Karyawan Swasta',
            'no_hp' => '081234567890',
            'alamat_wali' => 'Jl. Sudirman No. 456, Bandung'
        ]);
        
    }
}
