<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    public function login_action(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput()
                ->with('failed', 'Lengkapi isian form dengan benar.');
        }

        // Cari user berdasarkan email dan password (tanpa hash)
        $user = User::where([
            'email' => $request->email,
            'password' => $request->password, // Tidak menggunakan hash
        ])->first();

        // Jika user ditemukan
        if ($user) {
            $this->setSession($user);
            return redirect('admin/home')->with('success', 'Login berhasil.');
        }

        // Jika login gagal
        return redirect('login')
            ->withInput()
            ->with('failed', 'Email atau password salah.');
    }

    private function setSession($user)
    {
        // Simpan data user ke dalam session
        Session::put('user', [
            'id' => $user->id,
            'nama' => $user->nama_lengkap,
            'email' => $user->email,
            'role' => $user->role,
        ]);
    }

    public function logout_action()
    {
        Session::flush();
        return redirect('/')->with('success', 'Logout berhasil.');
    }
}
