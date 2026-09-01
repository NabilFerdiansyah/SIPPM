<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with('operator')->where('status', Laporan::STATUS_BARU)->latest()->get();
        return view('supervisor.validasi', compact('laporans'));
    }

    public function show(Laporan $laporan)
    {
        abort_unless($laporan->status === Laporan::STATUS_BARU, 404);
        return view('supervisor.validasi-detail', compact('laporan'));
    }

    public function validasi(Request $request, Laporan $laporan)
    {
        $request->validate(['catatan_supervisor' => ['nullable', 'string']]);
        $laporan->update([
            'status' => Laporan::STATUS_DIVALIDASI,
            'catatan_supervisor' => $request->catatan_supervisor,
        ]);

        return redirect()->route('supervisor.penugasan.create', $laporan)
            ->with('success', 'Laporan tervalidasi. Silakan tugaskan ke teknisi.');
    }

    public function tolak(Request $request, Laporan $laporan)
    {
        $request->validate(['catatan_penolakan' => ['required', 'string']]);
        $laporan->update([
            'status' => Laporan::STATUS_DITOLAK,
            'catatan_penolakan' => $request->catatan_penolakan,
        ]);

        return redirect()->route('supervisor.validasi.index')->with('success', 'Laporan ditolak.');
    }
}
