<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Penugasan;
use App\Models\User;
use Illuminate\Http\Request;

class PenugasanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with('operator')->where('status', Laporan::STATUS_DIVALIDASI)->latest()->get();
        return view('supervisor.penugasan', compact('laporans'));
    }

    public function create(Laporan $laporan)
    {
        abort_unless($laporan->status === Laporan::STATUS_DIVALIDASI, 404);
        $teknisi = User::where('role', 'teknisi')->where('status', 'aktif')->orderBy('name')->get();

        return view('supervisor.penugasan-detail', compact('laporan', 'teknisi'));
    }

    public function store(Request $request, Laporan $laporan)
    {
        $data = $request->validate([
            'teknisi_id' => ['required', 'exists:users,id'],
            'catatan_penugasan' => ['nullable', 'string'],
        ]);

        Penugasan::create([
            'laporan_id' => $laporan->id,
            'teknisi_id' => $data['teknisi_id'],
            'supervisor_id' => $request->user()->id,
            'catatan_penugasan' => $data['catatan_penugasan'] ?? null,
            'status' => 'ditugaskan',
        ]);

        $laporan->update(['status' => Laporan::STATUS_DITUGASKAN]);

        return redirect()->route('supervisor.penugasan.index')->with('success', 'Laporan berhasil ditugaskan ke teknisi.');
    }
}
