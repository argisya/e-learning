<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PengumumanController extends Controller
{
    public function index()
    {
        return view('admin.pengumuman.index', [
            'pengumuman' => DB::table('pengumuman')->join('users', 'pengumuman.id_pembuat', '=', 'users.id_user')->get()
        ]);
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
