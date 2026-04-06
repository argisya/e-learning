<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'users' => DB::table('users')->join('roles', 'users.id_role', '=', 'roles.id_role')->get(),
            'total_users' => User::count(),
            'total_admins' => User::where('id_role', 1)->count(),
            'total_guru' => User::where('id_role', 2)->count(),
            'total_siswa' => User::where('id_role', 3)->count()
        ]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
            'id_role' => 'required|exists:roles,id_role',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'status' => 'Aktif',
            'id_role' => $request->id_role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(Request $request)
    {
        return view('admin.users.edit', [
            'users' => User::findOrFail($request->id_user),
            'roles' => Role::all()
        ]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->id_user);

        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:users,username,' . $request->id_user,
            'email' => 'required|email|unique:users,email,' . $request->id_user,
            'id_role' => 'required|exists:roles,id_role',
        ]);

        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'status' => $request->status,
            'id_role' => $request->id_role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->id_user);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

}