<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $primaryKey = 'id_mapel';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_mapel',
        'kode_mapel',
        'deskripsi',
    ];
}
