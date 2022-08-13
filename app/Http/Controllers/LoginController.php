<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login',
        ]);
    }

    public function authenticate(Request $request) // membuat variable Request
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        // loginnya dicek dulu melalui method attempt dari laravel
        if (Auth::attempt($credentials)) {
            // kemudian sessionnya di regenerate, supaya menghindari teknik hacking session fixation (menggunakan session yang sama pada sebelumnya, maka di regenerate kembali sessionnya)
            $request->session()->regenerate();
            // redirect ketika success login, intended merupakan sebuah middleware (biar lebih secure)
            return redirect()->intended('/dashboard');
        }

        // withErrors() akan masuk ke dalam variable error di ui (ex: blade)
        // flash message cukup pakai method with()
        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request) // atau pake method request() si Request-nya
    {
        Auth::logout();

        // invalidate() supaya sessionnya gabisa dipakai kembali
        $request->session()->invalidate();

        // regenerateToken() bikin baru sessionnya supaya menghindari hacking
        $request->session()->regenerateToken();

        // redirect ke login page
        return redirect('/');
    }
}
