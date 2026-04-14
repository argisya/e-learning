<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengumuman;
class PengumumanController extends Controller
{
    public function index()
    {
        return view('admin.pengumuman.index', [
            'pengumuman' => Pengumuman::select('pengumuman.*', 'users.nama_lengkap', 'kategori_pengumuman.nama_kategori')
                ->join('users', 'pengumuman.id_pembuat', '=', 'users.id_user')
                ->join('kategori_pengumuman', 'pengumuman.id_kategori', '=', 'kategori_pengumuman.id_kategori')
                ->get()
        ]);
    }

    public function create()
    {
        return view('admin.pengumuman.create', [
            'kategori_pengumuman' => DB::table('kategori_pengumuman')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
            'prioritas' => 'required|in:Normal,Tinggi,Sangat Tinggi',
            'target' => 'required|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after_or_equal:waktu_mulai',
            'tanggal_publikasi' => 'nullable|date',
            'waktu_publikasi' => 'nullable|date_format:H:i',
            'status' => 'required|in:Publish,Draft,Arsip',
            'id_kategori' => 'required|exists:kategori_pengumuman,id_kategori'
        ]);

        $validatedData['id_pembuat'] = session('id_user');

        Pengumuman::create($validatedData);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dibuat!');
    }

    public function edit(Request $request)
    {
        return view('admin.pengumuman.edit', [
            'pengumuman' =>  Pengumuman::select('pengumuman.*', 'users.nama_lengkap', 'kategori_pengumuman.nama_kategori')
                ->join('users', 'pengumuman.id_pembuat', '=', 'users.id_user')
                ->join('kategori_pengumuman', 'pengumuman.id_kategori', '=', 'kategori_pengumuman.id_kategori')
                ->where('pengumuman.id_pengumuman', $request->id_pengumuman)
                ->first(),
            'kategori_pengumuman' => KategoriPengumuman::all()
        ]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $pengumuman = Pengumuman::findOrFail($request->id_pengumuman);

        $validatedData = $request->validate([
            'judul_pengumuman' => 'required|string|max:255',
            'isi_pengumuman' => 'required|string',
            'prioritas' => 'required|in:Normal,Tinggi,Sangat Tinggi',
            'target' => 'required|string|max:255',
            'tanggal_mulai' => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'nullable|date_format:H:i',
            'waktu_selesai' => 'nullable|date_format:H:i|after_or_equal:waktu_mulai',
            'tanggal_publikasi' => 'nullable|date',
            'waktu_publikasi' => 'nullable|date_format:H:i',
            'status' => 'required|in:Publish,Draft,Arsip',
            'id_kategori' => 'required|exists:kategori_pengumuman,id_kategori'
        ]);

        $validatedData['id_pembuat'] = session('id_user');

        $pengumuman->update($validatedData);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui!');
    }

        public function destroy(Request $request)
        {
            $pengumuman = Pengumuman::findOrFail($request->id_pengumuman);
            $pengumuman->delete();
    
            return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus!');
        }
}
