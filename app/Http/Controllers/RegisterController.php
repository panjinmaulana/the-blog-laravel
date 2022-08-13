<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'active' => 'register',
        ]);
    }

    public function store(Request $request)
    {
        // method validate(), merupakan method validasi yang magic dari laravel
        // ada 2 penggunaan u/ menuliskan validasinya bisa menggunakan tanda '|' atau []
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        // ada 2 cara penggunaan enkripsi password
        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        // create form registrasi ke db
        User::create($validatedData);

        // flash message dimasukkan ke dalam session oleh laravelnya
        // $request->session()->flash('success', 'Registration successfull! Please login');

        // redirect ke login page dengan membawa flash messagenya
        return redirect('/login')->with('success', 'Registration successfull! Please login.');
    }
}
