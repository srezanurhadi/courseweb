<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Menampilkan halaman form registrasi.
    public function showRegistrationForm()
    {
        return view('user.register');
    }

    // Menangani proses registrasi user baru.
    public function register(Request $request)
    {
        // 1. Validasi input dari form registrasi
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' =>'Konfirmasi password tidak cocok',
        ]);

        // 2. Jika validasi berhasil, buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'participant', // Otomatis set role sebagai 'participant'
        ]);

        // 4. Redirect ke halaman home
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
