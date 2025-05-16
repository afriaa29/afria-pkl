<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function tampilRegistrasi()
    {
        return view('registrasi');
    }

    public function submitRegistrasi(Request $request)
    {
        // Validasi input dengan pesan kustom
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Kata sandi harus diisi.',
            'password.min' => 'Kata sandi harus minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        User::query()->create([
            $user = new User(),
            $user->name = $request->name,
            $user->email = $request->email,
            $user->password = bcrypt($request->password),
            $user->save(),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function tampilLogin()
    {
        return view('login');
    }

    public function submitLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi harus diisi.',
        ]);

        $key = 'login.' . $request->ip();
        $maxAttempts = 5; // Maksimum 5 percobaan
        $decayMinutes = 1; // Tunggu 1 menit sebelum mencoba lagi

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors(['login' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik."]);
        }

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            RateLimiter::hit($key, $decayMinutes * 60);
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['login' => 'Email tidak terdaftar.']);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::clear($key);
            $request->session()->regenerate();

            $request->session()->put('username', Auth::user()->name);

            return redirect()->intended('book');
        }

        RateLimiter::hit($key, $decayMinutes * 60);

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['login' => 'Kata sandi yang Anda masukkan salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }
}
