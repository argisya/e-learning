<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'judul_pengumuman',
        'isi_pengumuman',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'tanggal_publikasi',
        'waktu_publikasi',
        'status',
        'prioritas',
        'target',
        'kategori',
        'id_pembuat'
    ];
}
