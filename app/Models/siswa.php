<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';

    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'id_kelas',
        'nisn',
        'nama_siswa',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_keluarga',
        'no_hp',
        'alamat',
    ];
}
