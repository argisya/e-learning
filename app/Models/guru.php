<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $primaryKey = 'nip';

    public $incrementing = true;
    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'nama_guru',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_pernikahan',
        'no_hp',
        'alamat',
        'golongan',
        'masa_kerja', 
        'jabatan',
        'no_sk',
    ];
}