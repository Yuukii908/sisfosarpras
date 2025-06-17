<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }
    
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/dashboard'); // arahkan ke dashboard
    } else {
        return back()->withErrors(['login' => 'Email atau password salah']);
    }


    }
    
    public function showRegister() {
        return view('auth.register');
    }
    
    public function register(Request $request) {
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/login')->with('success', 'Registrasi berhasil');
    }
    
    public function logout() {
        session()->forget('admin_id');
        return redirect('/login');
    }
}

