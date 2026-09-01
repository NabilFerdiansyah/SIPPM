<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Penugasan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $teknisiId = $request->user()->id;

        $tugasAktif = Penugasan::with('laporan')
            ->where('teknisi_id', $teknisiId)
            ->whereIn('status', ['ditugaskan', 'dikerjakan'])
            ->latest()
            ->get();

        $stats = [
            'baru' => Penugasan::where('teknisi_id', $teknisiId)->where('status', 'ditugaskan')->count(),
            'dikerjakan' => Penugasan::where('teknisi_id', $teknisiId)->where('status', 'dikerjakan')->count(),
            'selesai' => Penugasan::where('teknisi_id', $teknisiId)->where('status', 'selesai')->count(),
        ];

        return view('teknisi.dashboard', compact('tugasAktif', 'stats'));
    }
}
