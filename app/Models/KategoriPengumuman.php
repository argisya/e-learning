<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPengumuman extends Model
{
    protected $table = 'kategori_pengumuman';
    protected $primaryKey = 'id_kategori';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];
}
