<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm() {
        return view ('auth.login');
    }

    public function registerForm() {
        return view ('auth.register');
    }

    public function login(Request $request) {   
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(Auth::attempt($credentials)) {
            if(User::role('Admin')){
                return redirect('/');
            }
            if(User::role('Customer')){
                return redirect('/');
            }
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
