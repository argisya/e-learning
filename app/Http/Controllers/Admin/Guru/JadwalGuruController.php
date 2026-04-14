<?php

namespace App\Http\Controllers\Admin\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalGuruController extends Controller
{
    public function index()
    {
        return view('admin.guru.jadwal.index', [
            'jadwal' => DB::table('jadwal')->join('guru', 'jadwal.nip', '=', 'guru.nip')->join('kelas', 'jadwal.id_kelas', '=', 'kelas.id_kelas')->join('mapel', 'jadwal.id_mapel', '=', 'mapel.id_mapel')
        ]);
    }
}
