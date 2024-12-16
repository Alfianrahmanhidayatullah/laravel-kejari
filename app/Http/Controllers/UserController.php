<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\models\Admin;
use App\Models\Materi;
use App\Models\Notifikasi;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{

    public function index()
    {
        $id = Session('user')['id'];


        $user = User::where("id", "=", $id)->first();

        // dd($profil);
        return view('pages.profile', compact('user'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $user = User::where([
            'id' => $request->id
        ])->first();

        // dd($user);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->nomor_induk = $request->nomor_induk;
        $user->alamat = $request->alamat;

        $user->save();

        return view('pages.profile', compact('user'));


        // $newest_notifikasi = Notifikasi::where('role', '=', 'Murid')->orderBy('id', 'desc')->first();




        // dd($data);
        return view('pages.dashboard', compact('newest_notifikasi'));
    }

    public function forgot()
    {
        return view('pages.forgot-password');
    }

    public function forgot_action(Request $request)
    {
        // dd($request->all());

        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            return view('pages.reset-password', compact('user'));
        } else {
            return view('pages.forgot-password');
        }
    }

    public function reset_action(Request $request)
    {
        // dd($request->all());
        if ($request->confirm_password == $request->password) {
            $user = User::where('email', '=', $request->email)->first();
            if ($user) {
                $user->password = $request->password;
                $user->save();


                return view('pages.login');
            } else {
                return view('pages.forgot-password');
            }
        }
    }
}
