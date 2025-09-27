<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    function index() {
        return view('auth.login');
    }

    function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi'
        ]);
        
        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];


        if(Auth::attempt($infologin)) {
            if(Auth::user()->role->name == 'manager') {
                return redirect('/panel/manager');
            } else if(Auth::user()->role->name == 'supervisor') {
                return redirect('/panel/supervisor');
            } else if(Auth::user()->role->name == 'employee') {
                return redirect('/panel/employee');
            } else if(Auth::user()->role->name == 'administrator') {
                return redirect('/panel/manage');
            }
        } else {
            return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.'
        ])->withInput();

    }
}

    function logout() {
        Auth::logout();
        return redirect('');
        // Logic for logging out user
    }
}
