<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'baru' => Laporan::where('status', Laporan::STATUS_BARU)->count(),
            'ditangani' => Laporan::whereIn('status', [Laporan::STATUS_DITUGASKAN, Laporan::STATUS_DIKERJAKAN])->count(),
            'menunggu_validasi_akhir' => Laporan::where('status', Laporan::STATUS_MENUNGGU_VALIDASI_AKHIR)->count(),
            'selesai' => Laporan::where('status', Laporan::STATUS_SELESAI)->count(),
        ];

        $terbaru = Laporan::with('operator')->latest()->take(6)->get();

        return view('supervisor.dashboard', compact('stats', 'terbaru'));
    }
}
