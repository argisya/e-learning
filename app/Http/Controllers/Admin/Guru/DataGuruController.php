<?php

namespace App\Http\Controllers\Admin\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataGuruController extends Controller
{
    public function index()
    {
        return view('admin.guru.data.index');
    }

    public function create()
    {
        return view('admin.guru.data.create');
    }

    public function store(Request $request)
    {
        $nip = $request->nip;
        $nama_lengkap = $request->nama_lengkap;
        $tempat_lahir = $request->tempat_lahir;
        $tanggal_lahir = $request->tanggal_lahir;
        $jenis_kelamin = $request->jenis_kelamin;
        $agama = $request->agama;
        $status_pernikahan = $request->status_pernikahan;
        $no_hp = $request->no_hp;
        $email = $request->email;
        $alamat = $request->alamat;

        $check = $request->validate([
            'nama_lengkap' => 'required',
            'nip' => 'required|unique:guru',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_pernikahan' => 'required',
            'no_hp' => 'required|unique:gurus',
            'email' => 'required|email|unique:gurus',
            'alamat' => 'required'
        ]);

        $cari = Guru::where('nip', $nip)->first();

        if($cari == null){
            $guru = new Guru();
            $guru->nama_lengkap = $nama_lengkap;
            $guru->nip = $nip;
            $guru->tempat_lahir = $tempat_lahir;
            $guru->tanggal_lahir = $tanggal_lahir;
            $guru->jenis_kelamin = $jenis_kelamin;
            $guru->agama = $agama;
            $guru->status_pernikahan = $status_pernikahan;
            $guru->no_hp = $no_hp;
            $guru->email = $email;
            $guru->alamat = $alamat;
            $guru->save();

            return redirect()->route('admin.guru.data.index')->with('success', 'Data guru berhasil ditambahkan');
        } else {
            return redirect()->route('admin.guru.data.index')->with('error', 'Data guru sudah ada');
        }
    }

    public function show($id)
    {
        return view('admin.guru.data.show');
    }

    public function edit($nip)
    {
        return view('admin.guru.data.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
