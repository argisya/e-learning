<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KehadiranSiswa extends Model
{
    protected $table = 'kehadiran_siswa';
    protected $primaryKey = 'id_kehadiran';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_siswa',
        'tanggal',
        'status',
    ];

}
