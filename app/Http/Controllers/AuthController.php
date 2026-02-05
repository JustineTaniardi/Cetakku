<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return $this->redirectByRole();
        }
        return back()->withInput()->with('error', 'Email atau password salah');
    }

    public function redirectByRole(){
        $role = Auth::user()->role->name;

        return match ($role){
            'admin' => redirect('admin'),
            'kasir' => redirect()->route('kasir.dashboard'),
            'pekerja' => redirect('pekerja'),
        };
    }
}
