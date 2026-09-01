<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Penugasan;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function create(Request $request, Penugasan $penugasan)
    {
        abort_unless($penugasan->teknisi_id === $request->user()->id, 403);
        $penugasan->load('laporan');

        return view('teknisi.form-hasil', compact('penugasan'));
    }

    public function store(Request $request, Penugasan $penugasan)
    {
        abort_unless($penugasan->teknisi_id === $request->user()->id, 403);

        $data = $request->validate([
            'tindakan_perbaikan' => ['required', 'string'],
            'komponen_diganti' => ['nullable', 'string', 'max:200'],
            'waktu_mulai' => ['required', 'date'],
            'waktu_selesai' => ['required', 'date', 'after_or_equal:waktu_mulai'],
            'catatan_teknisi' => ['nullable', 'string'],
            'foto_hasil' => ['nullable', 'image', 'max:4096'],
        ]);

        $path = null;
        if ($request->hasFile('foto_hasil')) {
            $path = $request->file('foto_hasil')->store('hasil', 'public');
        }

        $penugasan->hasilPerbaikan()->create([...$data, 'foto_hasil' => $path]);
        $penugasan->update(['status' => 'dikerjakan']);
        $penugasan->laporan->update(['status' => Laporan::STATUS_MENUNGGU_VALIDASI_AKHIR]);

        return redirect()->route('teknisi.dashboard')
            ->with('success', 'Hasil penanganan berhasil dikirim, menunggu validasi akhir Supervisor.');
    }
}
