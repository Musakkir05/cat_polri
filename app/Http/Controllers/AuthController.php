<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->status == 'Admin') {
                return redirect()->route('home');
            } elseif (auth()->user()->status == 'Siswa') {
                return redirect()->route('peserta');
            }
        }

        return redirect()->route('login')->withInput()->withErrors(['error' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return route('login');
    }
}
