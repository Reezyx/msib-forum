<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('username', $request->username)->orWhere('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Daftar Gagal. Akun tidak ditemukan.');
        }

        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended('/article');
    }

    public function register(Request $request)
    {
        $user = User::where('username', $request->username)->orWhere('email', $request->email)->first();

        if ($user != null) {
            return redirect()->back()->with('error', 'Daftar Gagal. Username atau Email telah terpakai.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email_verified_at' => Carbon::now(),
            'image' => $request->image
        ]);
        return redirect()->back()->with('success', 'Daftar Akun Berhasil. Silahkan Login.');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
