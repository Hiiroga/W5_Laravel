<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function auth(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->with('error', 'Email / password salah');
    }

    public function registration() {
        return view('auth.registration');
    }

    public function register(Request $request) {
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/registration')->with('success', 'Registrasi berhasil');
    }

    public function home() {
        if (Auth::check()) {
            return view('auth.home', ['user' => Auth::user()]);
        }
        return redirect('/login');
    }

    // 6. Proses logout
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}