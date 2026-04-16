<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTuaSiswa extends Model
{
    protected $table = 'orangtuasiswa';
    protected $primaryKey = 'id_orangtua_siswa';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nis',
        'id_orangtua',
        'status_hubungan'
    ];
}
