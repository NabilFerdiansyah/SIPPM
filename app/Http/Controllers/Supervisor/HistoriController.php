<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Laporan;

class HistoriController extends Controller
{
    public function index()
    {
        $laporans = Laporan::with(['operator', 'penugasan.teknisi'])
            ->whereIn('status', [Laporan::STATUS_SELESAI, Laporan::STATUS_DITOLAK])
            ->latest()
            ->paginate(12);

        return view('supervisor.histori', compact('laporans'));
    }
}
