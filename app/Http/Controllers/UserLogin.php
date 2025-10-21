<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserLogin extends Controller
{
    public function index()
    {

        $param = [
            "modulename" => 'UserLogin',
            "title" => "Sign In",
            "data" => [],
        ];

        if (!session()->has('loginerror')) {
            session(['url.intended' => url()->previous()]);
        }
        return view("login", $param);
    }

    public function signin(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required",
            "password" => "required",
        ]);


        if (Auth::attempt($credentials)) {
            // jangan lupa kode session nya di generate ulang
            $request->session()->regenerate();
            // alihkan ke halaman produk
            return redirect()->intended('/');
        }

        return back()->with('loginerror', 'Login Gagal');
    }

    public function signout()
    {
        Auth::logout();
        // kode session sekarang di buat invalid
        request()->session()->invalidate();
        // token dibuat ulang yang baru
        request()->session()->regenerateToken();

        return redirect()->intended('/');
    }
}
