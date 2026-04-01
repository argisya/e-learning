<?php

namespace App\Http\Controllers\Admin\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardSiswaController extends Controller
{
    public function index()
    {
        return view('admin.siswa.dashboard.index');
    }
}
