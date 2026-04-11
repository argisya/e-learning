<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        return view('admin.pengumuman.index');
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function edit()
    {
        return view('admin.pengumuman.edit');
    }
}
