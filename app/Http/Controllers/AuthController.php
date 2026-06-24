<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()    { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min'      => 'Password minimal 6 karakter.',
        ]);

        if (Auth::attempt($request->only('email','password'))) {
            $request->session()->regenerate();
            return Auth::user()->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('concerts.index');
        }
        return back()->withErrors(['email'=>'Email atau password salah.'])->withInput();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:2|max:100',
            'email'    => 'required|email|unique:users,email',
            'phone'    => 'required|regex:/^08\d{8,11}$/',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required'      => 'Nama wajib diisi.',
            'name.min'           => 'Nama minimal 2 karakter.',
            'email.required'     => 'Email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email sudah terdaftar.',
            'phone.required'     => 'No. HP wajib diisi.',
            'phone.regex'        => 'No. HP tidak valid (contoh: 081234567890).',
            'password.required'  => 'Password wajib diisi.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'customer',
        ]);

        return redirect()->route('login')->with('success','Akun berhasil dibuat! Silakan masuk.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
