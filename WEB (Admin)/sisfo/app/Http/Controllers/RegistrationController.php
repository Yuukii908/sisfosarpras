<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RegistrationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $regToken = RegistrationToken::where('token', $request->token)->where('used', false)->first();

        if (!$regToken) {
            return back()->withErrors(['token' => 'Token tidak valid atau sudah digunakan.']);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $regToken->used = true;
        $regToken->save();

        auth()->login($user);
        return redirect('/dashboard');
    }
}