<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Mapel;

class Rapor extends Model
{
    protected $table = 'rapor';
    protected $primaryKey = 'id_rapor';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_siswa',
        'id_kelas',
        'id_mapel',
        'nilai_rapor',
        'semester',
        'tahun_ajaran',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'nis');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }
}
