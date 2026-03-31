<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_siswa',
        'id_mapel',
        'nilai_angka',
        'nilai_huruf',
    ];
}
