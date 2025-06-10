<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman form login.
    public function showLoginForm()
    {
        //menampilkan file view yang sudah kamu buat
        return view('user.index');
    }

    // proses login.
    public function login(Request $request)
    {
        // Validasi input dari form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // melakukan otentikasi
        if (Auth::attempt($credentials)) {
            // Jika berhasil, regenerate session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke halaman home setelah login berhasil
            $user = Auth::user();
            if ($user->role === 'user') {
                return redirect()->intended('/user/home');
            } elseif ($user->role === 'admin') {
                return redirect('/admin/home');
            } elseif ($user->role === 'author') {
                return redirect('/author/home');
            }
            
        }

        // Jika otentikasi gagal
        return back()->withErrors([
            'email' => 'Email atau Password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // proses logout.
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama setelah logout
        return redirect('/login');
    }
}
