<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeControllers extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function loginPage() {
        return view('loginpage');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $user = \App\Models\User::where('username', $request->username)->first();
    
        if ($user && $user->password === $request->password) {
            Auth::login($user); 
            return redirect()->intended('dashboard');
        } else {
            return redirect('login')->with('error', 'Login details are not valid');
        }
    }
    
}
