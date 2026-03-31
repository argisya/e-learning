<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalUjian extends Model
{
    protected $table = 'jadwal_ujian';
    protected $primaryKey = 'id_jadwal';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_mapel',
        'tanggal_ujian',
        'waktu_mulai',
        'waktu_selesai',
        'ruangan',
    ];
}
