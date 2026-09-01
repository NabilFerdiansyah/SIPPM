<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class ValidasiAkhirController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with(['operator', 'penugasan.teknisi', 'penugasan.hasilPerbaikan'])
            ->where('status', Laporan::STATUS_MENUNGGU_VALIDASI_AKHIR)
            ->latest()
            ->get();

        return view('supervisor.validasi-akhir', compact('laporans'));
    }

    public function show(Laporan $laporan)
    {
        abort_unless($laporan->status === Laporan::STATUS_MENUNGGU_VALIDASI_AKHIR, 404);
        $laporan->load(['operator', 'penugasan.teknisi', 'penugasan.hasilPerbaikan']);

        return view('supervisor.validasi-akhir-detail', compact('laporan'));
    }

    public function selesaikan(Laporan $laporan)
    {
        $laporan->update(['status' => Laporan::STATUS_SELESAI]);
        $laporan->penugasan?->update(['status' => 'selesai']);

        return redirect()->route('supervisor.validasi-akhir.index')->with('success', 'Laporan dinyatakan selesai dan diarsipkan.');
    }

    public function kembalikan(Request $request, Laporan $laporan)
    {
        $request->validate(['catatan_supervisor' => ['required', 'string']]);
        $laporan->update([
            'status' => Laporan::STATUS_DIKERJAKAN,
            'catatan_supervisor' => $request->catatan_supervisor,
        ]);

        return redirect()->route('supervisor.validasi-akhir.index')->with('success', 'Laporan dikembalikan ke teknisi untuk perbaikan ulang.');
    }
}
