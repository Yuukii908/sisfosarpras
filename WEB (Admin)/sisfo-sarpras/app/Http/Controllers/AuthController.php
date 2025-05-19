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
    
    public function login(Request $request) {
        // $admin = Admin::where('email', $request->email)->first();
    
        // if ($admin && Hash::check($request->password, $admin->password)) {
        //     session(['admin_id' => $admin->id]);
        //     $admin->update(['last_seen' => now()]);
        //     return redirect('/dashboard');
        // }
        // return back()->with('error', 'Login gagal');
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

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

