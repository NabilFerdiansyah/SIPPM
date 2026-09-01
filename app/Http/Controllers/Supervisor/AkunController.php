<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AkunController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->get('peran', 'operator'); // tab: operator | teknisi
        $akun = User::where('role', $role)->orderBy('name')->get();

        return view('supervisor.daftar-akun', compact('akun', 'role'));
    }

    public function create()
    {
        return view('supervisor.tambah-akun');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'role' => ['required', 'in:operator,teknisi'],
            'jabatan' => ['nullable', 'string', 'max:100'],
            'no_hp' => ['nullable', 'string', 'max:30'],
        ]);

        $base = Str::slug($data['name'], '.');
        $username = $base;
        $i = 1;
        while (User::where('username', $username)->exists()) {
            $username = $base.$i++;
        }

        $tempPassword = Str::upper(Str::random(3)).random_int(100, 999);

        $user = User::create([
            'name' => $data['name'],
            'username' => $username,
            'password' => Hash::make($tempPassword),
            'role' => $data['role'],
            'jabatan' => $data['jabatan'] ?? null,
            'no_hp' => $data['no_hp'] ?? null,
            'status' => 'aktif',
        ]);

        return redirect()->route('supervisor.akun.berhasil', $user)
            ->with('temp_password', $tempPassword);
    }

    public function berhasil(User $akunBaru)
    {
        $tempPassword = session('temp_password');
        return view('supervisor.akun-berhasil', ['akun' => $akunBaru, 'tempPassword' => $tempPassword]);
    }

    public function toggleStatus(User $akun)
    {
        $akun->update(['status' => $akun->status === 'aktif' ? 'nonaktif' : 'aktif']);
        return back()->with('success', 'Status akun berhasil diperbarui.');
    }
}
