<?php

namespace App\Http\Controllers\Admin\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Siswa;
use App\Models\Kelas;

class DataSiswaController extends Controller
{
    public function index()
    {
        return view('admin.siswa.data.index', [
            'siswa' => DB::table('siswa')->leftJoin('users', 'siswa.id_user', '=', 'users.id_user')->leftJoin('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->get(),
            'total_siswa' => Siswa::count(),
            'total_siswa_laki' => Siswa::where('jenis_kelamin', 'L')->count(),
            'total_siswa_perempuan' => Siswa::where('jenis_kelamin', 'P')->count()
        ]);
    }

    public function create()
    {
        return view('admin.siswa.data.create', [
            'users' => DB::table('users')->join('roles', 'roles.id_role', '=', 'users.id_role')->where("users.id_role", 3)->get(),
            'kelas' => Kelas::all()
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_user' => 'required',
            'nis' => 'required|unique:siswa',
            'id_kelas' => 'required',
            'nisn' => 'required|unique:siswa',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_keluarga' => 'required',
            'no_hp' => 'required|unique:siswa|min:10|max:15',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|file|max:2048',
        ], $messages = [
            'id_user.required' => 'Nama lengkap harus diisi',
            'nis.required' => 'NIS harus diisi',
            'nis.unique' => 'NIS sudah digunakan',
            'id_kelas.required' => 'Kelas harus dipilih',
            'nisn.required' => 'NISN harus diisi',
            'nisn.unique' => 'NISN sudah digunakan',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'agama.required' => 'Agama harus dipilih',
            'status_keluarga.required' => 'Status keluarga harus dipilih',
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
            $directory = 'storage/siswa/';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validateData['foto'] = $originalFileName;
        }else{
            $validateData['foto'] = 'default.png';
        }

        Siswa::create($validateData, $messages);

        return redirect()->route('admin.siswa.data.index')->with('success', 'Siswa created successfully.');
    }

    public function edit(Request $request)
    {
        return view('admin.siswa.data.edit', [
            'siswa' => Siswa::findOrFail($request->nis),
            'kelas' => Kelas::all()
        ]);
    }

    public function update(Request $request)
    {
        $siswa = Siswa::findOrFail($request->nis);
        $rules = [
            'id_user' => 'required',
            'id_kelas' => 'required',
            'nisn' => 'required|unique:siswa,nisn,' . $request->nis . ',nis',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'status_keluarga' => 'required',
            'no_hp' => 'required|min:10|max:15|unique:siswa,no_hp,' . $request->nis . ',nis',
            'alamat' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|file|max:2048',
        ];
        $messages = [
            'id_user.required' => 'Nama lengkap harus diisi',
            'id_kelas.required' => 'Kelas harus dipilih',
            'nisn.required' => 'NISN harus diisi',
            'nisn.unique' => 'NISN sudah digunakan',
            'tempat_lahir.required' => 'Tempat lahir harus diisi',
            'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih',
            'agama.required' => 'Agama harus dipilih',
            'status_keluarga.required' => 'Status keluarga harus dipilih',
            'no_hp.required' => 'No HP harus diisi',
            'no_hp.unique' => 'No HP sudah digunakan',
            'alamat.required' => 'Alamat harus diisi',
            'foto.image' => 'File yang diunggah harus berupa gambar',
            'foto.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg',
            'foto.max' => 'Ukuran gambar maksimal 2MB',
        ];
        $validatedData = $request->validate($rules, $messages);

        if($request->file('foto')){
            if($siswa->foto){
                $oldImagePath = public_path('storage/siswa/') . $siswa->foto;
                if(file_exists($oldImagePath)){
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/siswa/';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);
            $validatedData['foto'] = $originalFileName;
        }elseif($siswa->foto){
            $validatedData['foto'] = 'default.png';
        }

        $siswa->update($validatedData);

        return redirect()->route('admin.siswa.data.index')->with('success', 'Siswa updated successfully.');
    }

    public function destroy(Request $request)
    {
        $siswa = Siswa::findOrFail($request->nis);
        if($siswa->foto){
            $oldImagePath = public_path('storage/siswa/') . $siswa->foto;
            if(file_exists($oldImagePath)){
                unlink($oldImagePath);
            }
        }
        $siswa->delete();
        return redirect()->route('admin.siswa.data.index')->with('success', 'Siswa deleted successfully.');
    }

    public function autofill(Request $request){
        $query = $request->get('q', '');
        $siswa = DB::table('users')
            ->join('roles', 'users.id_role', '=', 'roles.id_role')
            ->where('users.nama_lengkap', 'like', '%' . $query . '%')
            ->where('users.id_role', 3)
            ->select('users.nama_lengkap', 'users.id_user', 'users.username')
            ->get();
        return response()->json($siswa);
    }
}
