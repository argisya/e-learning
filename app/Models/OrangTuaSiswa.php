<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTuaSiswa extends Model
{
    protected $table = 'orangtua_siswa';
    protected $primaryKey = 'id_orangtua';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_user',
        'nama_orangtua',
        'alamat',
        'no_telepon',
    ];
}
