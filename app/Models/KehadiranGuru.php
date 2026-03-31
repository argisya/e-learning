<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KehadiranGuru extends Model
{
    protected $table = 'kehadiran_guru';
    protected $primaryKey = 'id_kehadiran';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id_guru',
        'tanggal',
        'status',
    ];

}
