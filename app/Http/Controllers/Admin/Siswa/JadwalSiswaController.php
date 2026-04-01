<?php

namespace App\Http\Controllers\Admin\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalSiswaController extends Controller
{
    public function index()
    {
        return view('admin.siswa.jadwal.index');
    }
}
