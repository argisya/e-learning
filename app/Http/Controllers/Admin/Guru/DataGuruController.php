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
        return view('admin.guru.data.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'required',
            'nip' => 'required|unique:guru',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_pernikahan' => 'required',
            'no_hp' => 'required|unique:guru|min:10|max:15',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|file|max:2048',
        ], $messages = [
            'id_user.required' => 'Nama lengkap harus diisi',
            'nip.required' => 'NIP harus diisi',
            'nip.unique' => 'NIP sudah digunakan',
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
        ]);

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

    public function show(Request $request)
    {
        return view('admin.guru.data.show');
    }

    public function edit(Request $request)
    {
        return view('admin.guru.data.edit', [
            'guru' => DB::table('guru')->join('users', 'guru.id_user', '=', 'users.id_user')->where('guru.nip', $request->nip)->first()
        ]);
    }

    public function update(Request $request)
    {
        $guru = Guru::find($request->nip);
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
        $guru = Guru::find($request->nip);
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
        $autofill =  DB::table('users')->join('roles', 'roles.id_role', '=', 'users.id_role')->where("users.id_role", 2)->where("nama_lengkap", $request->nama_lengkap)->get();
        echo json_encode($autofill);
    }
}
