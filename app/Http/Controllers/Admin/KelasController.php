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
            'guru' => Guru::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'nip_wali' => 'required|exists:guru,nip',
            'ruangan' => 'required',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'nip_wali' => $request->nip_wali,
            'ruangan' => $request->ruangan,
            'status' => $request->status
        ]);

        return redirect('admin.kelas.index')->with('success', 'Data kelas berhasil ditambahkan!');
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
            'nip_wali' => 'required|exists:guru,nip',
            'ruangan' => 'required',
            'status' => 'required|in:Aktif,Tidak Aktif'
        ]);

        $kelas = Kelas::findOrFail($request->id_kelas);

        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'nip_wali' => $request->nip_wali,
            'ruangan' => $request->ruangan,
            'status' => $request->status
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
