<?php

namespace App\Http\Controllers\Admin\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ImageHelper;
use App\Models\Guru;

class DataGuruController extends Controller
{
    public function index()
    {
        return view('admin.guru.data.index', [
            'guru' => DB::table('guru')->join('users', 'guru.id_user', '=', 'users.id_user')->get()
        ]);
    }

    public function create()
    {
        return view('admin.guru.data.create', [
            'users' => DB::table('users')->join('roles', 'roles.id_role', '=', 'users.id_role')->where("users.id_role", 2)->get()
        ]);
    }

    public function store(Request $request)
    {
        $user = DB::table('users')
        ->where('nama_lengkap', $request->nama_lengkap)
        ->first();

        if (!$user) {
            return back()->withErrors(['nama_lengkap' => 'Nama lengkap tidak ditemukan'])->withInput();
        }

        $validatedData = $request->validate([
            'nip' => 'required',
            'id_user' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_pernikahan' => 'required',
            'no_hp' => 'required|unique:guru|min:10|max:15',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|file|max:2048',
            'bidang_studi' => 'required',
            'golongan' => 'required',
            'masa_kerja' => 'required',
            'jabatan' => 'required',
            'no_sk' => 'required',
        ], $messages = [
            'id_user.required' => 'Nama lengkap harus diisi',
            'nip.required' => 'NIP harus diisi',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'agama.required' => 'Agama harus dipilih',
            'status_pernikahan.required' => 'Status pernikahan harus dipilih',
            'no_hp.required' => 'No HP harus diisi',
            'no_hp.unique' => 'No HP sudah digunakan',
            'alamat.required' => 'Alamat harus diisi',
            'foto.image' => 'File yang diunggah harus berupa gambar',
            'foto.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
            'golongan.required' => 'Golongan harus diisi',
            'masa_kerja.required' => 'Masa kerja harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'no_sk.required' => 'No SK harus diisi',

        ]);

        $validatedData['id_user'] = $user->id_user;
        
        if($request->file('foto')){
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/guru/';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        }else{
            $validatedData['foto'] = 'default.png';
        }

        Guru::create($validatedData, $messages);
        return redirect()->route('admin.guru.data.index')->with('success', 'Data guru berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        return view('admin.guru.data.edit', [
            'guru' =>  DB::table('guru')
            ->join('users', 'guru.id_user', '=', 'users.id_user')
            ->select('guru.*', 'users.nama_lengkap')
            ->where('guru.nip', $request->nip)
            ->first()
        ]);
    }

    public function update(Request $request)
    {
        $guru = Guru::findOrFail($request->nip);
        $rules = [
            'id_user' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_pernikahan' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|file|max:2048',
            'bidang_studi' => 'required',
            'golongan' => 'required',
            'masa_kerja' => 'required',
            'jabatan' => 'required',
            'no_sk' => 'required',
        ];
        $messages = [
            'id_user.required' => 'Nama lengkap harus diisi',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'agama.required' => 'Agama harus dipilih',
            'status_pernikahan.required' => 'Status pernikahan harus dipilih',
            'no_hp.required' => 'No HP harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'foto.image' => 'File yang diunggah harus berupa gambar',
            'foto.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
            'bidang_studi.required' => 'Bidang studi harus diisi',
            'golongan.required' => 'Golongan harus diisi',
            'masa_kerja.required' => 'Masa kerja harus diisi',
            'jabatan.required' => 'Jabatan harus diisi',
            'no_sk.required' => 'No SK harus diisi',
        ];
        $validatedData = $request->validate($rules, $messages);

        if($request->file('foto')){
            if($guru->foto){
                $oldImagePath = public_path('storage/guru/') . $guru->foto;
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/guru/';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        }elseif($guru->foto){
            $validatedData['foto'] = 'default.png';
        }

        $guru->update($validatedData);
        return redirect()->route('admin.guru.data.index')->with('success', 'Data guru berhasil diupdate');
    }

    public function destroy(Request $request)
    {
        $guru = Guru::findOrFail($request->nip);
        if($guru->foto){
            $oldImagePath = public_path('storage/guru/') . $guru->foto;
            if(file_exists($oldImagePath)){
                unlink($oldImagePath);
            }
        }
        $guru->delete();
        return redirect()->route('admin.guru.data.index')->with('success', 'Data guru berhasil dihapus');
    }

    public function autofill(Request $request){
        $query = $request->get('q', '');
        $guru = DB::table('users')
            ->join('roles', 'users.id_role', '=', 'roles.id_role')
            ->where('users.nama_lengkap', 'like', '%' . $query . '%')
            ->where('users.id_role', 2)
            ->select('users.nama_lengkap', 'users.id_user', 'users.username')
            ->get();
        return response()->json($guru);
    }
}
