<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'role' => ['required', 'in:operator,supervisor,teknisi'],
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [], [
            'role' => 'peran',
            'username' => 'username',
            'password' => 'kata sandi',
        ]);

        $user = \App\Models\User::where('username', $credentials['username'])
            ->where('role', $credentials['role'])
            ->first();

        if (! $user || ! Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {
            return back()->withErrors([
                'username' => 'Username, kata sandi, atau peran yang dipilih tidak sesuai.',
            ])->onlyInput('username');
        }

        if ($user->status !== 'aktif') {
            Auth::logout();
            return back()->withErrors([
                'username' => 'Akun Anda sedang dinonaktifkan. Hubungi Supervisor.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::homeForRole($user->role));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
