<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Guru;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        return view('admin.kelas.index', [
            'kelas' => DB::table('kelas')->join('guru', 'kelas.nip_wali', '=', 'guru.nip')->join('users', 'guru.id_user', '=', 'users.id_user')->get()
        ]);
    }

    public function create()
    {
        return view('admin.kelas.create', [
            'guru' => DB::table('guru')->join('users', 'guru.id_user', '=', 'users.id_user')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'jenjang_pendidikan' => 'required',
            'jurusan' => 'required',
            'tingkat' => 'required',
            'nip_wali' => 'required|exists:guru,nip',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'tahun_ajaran' => 'required',
            'keterangan' => 'nullable'
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'jenjang_pendidikan' => $request->jenjang_pendidikan,
            'jurusan' => $request->jurusan,
            'tingkat' => $request->tingkat,
            'nip_wali' => $request->nip_wali,
            'status' => $request->status,
            'tahun_ajaran' => $request->tahun_ajaran,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil ditambahkan!');
    }

    public function edit(Request $request)
    {
        return view('admin.kelas.edit', [
            'kelas' => Kelas::findOrFail($request->id_kelas),
            'guru' => Guru::all()
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'jenjang_pendidikan' => 'required',
            'jurusan' => 'required',
            'tingkat' => 'required',
            'nip_wali' => 'required|exists:guru,nip',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'tahun_ajaran' => 'required',
            'keterangan' => 'nullable'
        ]);

        $kelas = Kelas::findOrFail($request->id_kelas);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'jenjang_pendidikan' => $request->jenjang_pendidikan,
            'jurusan' => $request->jurusan,
            'tingkat' => $request->tingkat,
            'nip_wali' => $request->nip_wali,
            'status' => $request->status,
            'tahun_ajaran' => $request->tahun_ajaran,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diperbarui!');
    }

    public function destroy(Request $request)
    {
        $kelas = Kelas::findOrFail($request->id_kelas);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil dihapus!');
    }
}
