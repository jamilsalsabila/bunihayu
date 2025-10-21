<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;

class UserRegister extends Controller
{
    public function get()
    {
        $param = [
            "modulename" => "UserRegister",
            "title" => "Register",
        ];
        return view("register", $param);
    }

    public function post(Request $request)
    {
        $request->validate([
            "name" => "required|min:8",
            "email" => "required|email:rfc,dns|unique:users|max:255",
            "password" => ["required", Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
        ], [
            "name.required" => "nama perlu diisi",
            "email.required" => "email perlu diisi",
            "password.required" => "password perlu diisi",
        ]);

        $data = [
            "name" => $request->input('name'),
            "email" => $request->input('email'),
            "password" => bcrypt($request->input("password")),
            "isadmin" => false,
        ];

        User::create($data);

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect(uri('login'))->with('success', 'data anda berhasil dimasukkan ke database, silahkan login.');

    }
}
