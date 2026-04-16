<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'orangtua';
    protected $primaryKey = 'id_orangtua';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nama_orangtua',
        'no_hp_orangtua',
        'pekerjaan_orangtua',
        'alamat_orangtua'
    ];

    public function siswa()
    {
        return $this->hasMany(OrangTuaSiswa::class, 'id_orangtua', 'id_orangtua');
    }
}
