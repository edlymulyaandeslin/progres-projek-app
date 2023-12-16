<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    // register
    public function indexRegister()
    {

        return view('auth.register.index');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'tempat_lahir' => 'required|min:5',
            'tanggal_lahir' => 'required',
            'alamat' => 'required|min:5',
            'agama' => 'required',
            'jenis_kelamin' =>  'required',
            'pekerjaan' => 'required|min:5',
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        $validateData['level_id'] = 1;

        User::create($validateData);

        Alert::success('Success!', 'Pendaftaran Berhasil Anda Dapat Login Sekarang');

        return redirect('/auth/login');
    }

    // login
    public function indexLogin()
    {
        return view('auth.login.index');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();;

            return redirect()->intended('/')->with('toast_success', 'Login Berhasil');
        }

        return back()->with('toast_error', 'Login gagal');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Alert::success('Logout Berhasil')->toToast();

        return redirect('/auth/login');
    }
}
