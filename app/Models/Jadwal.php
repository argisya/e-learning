<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'id_jadwal';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_mapel',
        'id_guru',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];
}
