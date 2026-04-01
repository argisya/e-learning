<?php

namespace App\Http\Controllers\Admin\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardGuruController extends Controller
{
    public function index()
    {
        return view('admin.guru.dashboard.index');
    }
}
