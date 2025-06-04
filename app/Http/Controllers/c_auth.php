<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class c_auth extends Controller
{
    public function showLogin()
    {
        return view('auth.v_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            $user = Auth::user();
            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect('/index');
            } elseif ($user->role === 'pembina') {
                return redirect('/index');
            } elseif ($user->role === 'siswa') {
                return redirect('/index');
            }

            return redirect('/index'); // fallback
        }

        return redirect()->back()->withErrors([
            'username' => 'Username atau password salah',
        ])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
