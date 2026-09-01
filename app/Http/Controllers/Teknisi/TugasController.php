<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Penugasan;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function show(Request $request, Penugasan $penugasan)
    {
        abort_unless($penugasan->teknisi_id === $request->user()->id, 403);
        $penugasan->load('laporan.operator');

        return view('teknisi.detail-tugas', compact('penugasan'));
    }

    public function mulai(Request $request, Penugasan $penugasan)
    {
        abort_unless($penugasan->teknisi_id === $request->user()->id, 403);
        $penugasan->update(['status' => 'dikerjakan']);
        $penugasan->laporan->update(['status' => \App\Models\Laporan::STATUS_DIKERJAKAN]);

        return redirect()->route('teknisi.tugas.hasil.create', $penugasan);
    }

    public function riwayat(Request $request)
    {
        $penugasans = Penugasan::with('laporan')
            ->where('teknisi_id', $request->user()->id)
            ->where('status', 'selesai')
            ->latest()
            ->paginate(10);

        return view('teknisi.riwayat', compact('penugasans'));
    }
}
