<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nis',
        'id_user',
        'id_kelas',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_keluarga',
        'status_pendaftaran',
        'no_hp',
        'alamat',
        'tahun_masuk',
        'foto',
    ];
}
