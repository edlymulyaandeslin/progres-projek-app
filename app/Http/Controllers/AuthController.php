<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Laravel\Socialite\Facades\Socialite;
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

        if (Auth::attempt($credentials, $request->filled('remember'))) {

            $request->session()->regenerate();;

            Alert::success('Login Berhasil')->toToast()->autoClose(3000);

            return redirect()->intended('/');
        }

        Alert::error('Login Gagal')->toToast()->autoClose(3000);

        return back();
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Alert::success('Logout Berhasil')->toToast()->autoClose(3000);

        return redirect('/auth/login');
    }

    // VERIVIKASI EMAIL
    public function sendVerifyEmail($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->sendEmailVerificationNotification();

            Alert::success('Verification link sent!')->toToast()->autoClose(3000);

            return back();
        } else {

            Alert::success('Failed send verification link!')->toToast()->autoClose(3000);

            return back();
        }
    }

    public function verified(Request $request, $id)
    {
        if (!$request->hasValidSignature()) {
            return response()->json([
                'status' => false,
                'message' => 'Verification failed!'
            ]);
        }

        $user = User::find($id);
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();

            User::where('id', $id)->update(['status' => 'active']);

            Alert::success('Email has been Verified!')->toToast()->autoClose(3000);

            return redirect()->to('/auth/login');
        }

        Alert::info('Your Account is Verified!')->toToast()->autoClose(3000);
        return redirect()->to('/auth/login');
    }

    public function verifyEmailNotice()
    {
        return view('auth.verify-email');
    }

    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        $githubUser = Socialite::driver('github')->user();

        $rules = [
            'level_id' => 1,
            'nama' => $githubUser->getName() ?? $githubUser->getNickname(),
            'email' => $githubUser->getEmail(),
            'remember_token' => $githubUser->token,
        ];

        $whereEmail = ['email' =>  $githubUser->getEmail()];

        $user = User::updateOrCreate($whereEmail, $rules);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        Auth::login($user);

        Alert::success('Selamat Datang ' . $githubUser->getName() ?? $githubUser->getNickname())->toToast()->autoClose(3000);

        return redirect('/');
    }
}
