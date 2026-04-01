<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        // $this->middleware(function($request, $next){
        //     if(session()->has('email')){
        //         return redirect()->route('transaksi.index')->with('login_alert', '<div class="alert alert-danger" role="alert">Harap Logout terlebih dahulu!</div>');
        //     }
        //     return $next($request);
        // });

        return view('auth.login',[
            'title' => 'E-Learning',
        ]);
    }

    public function loginProcess(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

      // Cari user berdasarkan username
        $checkData = User::where('username', $request->username)->first();
        $getData = User::where('username', $request->username);

        if($getData->count() > 0){

            $admin = $getData->first();

                if($checkData->id_role == 1){

                    if (Hash::check($request->password, $admin->password)) {

                        session([
                            'id_user' => $admin->id_user,
                            'id_role' => $admin->id_role,
                            'username' => $admin->username,
                            'email' => $admin->email,
                            'nama_role' => $admin->roles->nama_role
                        ]);
                        return redirect()->route('admin.dashboard.index');

                    }else{

                        return redirect()->back()->with('login_alert', '<div class="alert alert-danger" role="alert">Password salah!</div>');

                    }

                }elseif($checkData->id_role == 2){

                    if($getData->count() > 0){

                        $guru = $getData->first();

                        if($checkData->id_role == 2){

                            if (Hash::check($request->password, $guru->password)) {

                                session([
                                    'id_guru' => $guru->id_guru,
                                    'id_role' => $guru->id_role,
                                    'username' => $guru->username,
                                    'email' => $guru->email,
                                    'nama_role' => $guru->roles->nama_role
                                ]);
                                return redirect()->route('guru.dashboard.index');

                            }else{

                                return redirect()->back()->with('login_alert', '<div class="alert alert-danger" role="alert">Password salah!</div>');

                            }

                        }else{

                            return redirect()->back()->with('login_alert', '<div class="alert alert-danger" role="alert">Akun tidak terdaftar!</div>');

                        }

                    }else{

                        return redirect()->back()->with('login_alert', '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>');
                        
                    }

                }else{
                    if($getData->count() > 0){

                        $siswa = $getData->first();

                        if($checkData->id_role == 3){

                            if (Hash::check($request->password, $siswa->password)) {

                                session([
                                    'id_siswa' => $siswa->id_siswa,
                                    'id_role' => $siswa->id_role,
                                    'username' => $siswa->username,
                                    'email' => $siswa->email,
                                    'nama_role' => $siswa->roles->nama_role
                                ]);
                                return redirect()->route('siswa.dashboard.index');

                            }else{

                                return redirect()->back()->with('login_alert', '<div class="alert alert-danger" role="alert">Password salah!</div>');

                            }

                        }else{

                            return redirect()->back()->with('login_alert', '<div class="alert alert-danger" role="alert">Akun tidak terdaftar!</div>');

                        }
                    }else{

                        return redirect()->back()->with('login_alert', '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>');
                        
                    }
                }

        }else{

            return redirect()->back()->with('login_alert', '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>');

        }

    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login.index')->with('login_alert', '<div class="alert alert-success" role="alert">Berhasil Logout.</div>');
    }
}
