<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $operatorId = $request->user()->id;

        $stats = [
            'total' => Laporan::where('operator_id', $operatorId)->count(),
            'menunggu_validasi' => Laporan::where('operator_id', $operatorId)->where('status', Laporan::STATUS_BARU)->count(),
            'sedang_ditangani' => Laporan::where('operator_id', $operatorId)->whereIn('status', [
                Laporan::STATUS_DIVALIDASI, Laporan::STATUS_DITUGASKAN, Laporan::STATUS_DIKERJAKAN, Laporan::STATUS_MENUNGGU_VALIDASI_AKHIR,
            ])->count(),
            'selesai' => Laporan::where('operator_id', $operatorId)->where('status', Laporan::STATUS_SELESAI)->count(),
            'ditolak' => Laporan::where('operator_id', $operatorId)->where('status', Laporan::STATUS_DITOLAK)->count(),
        ];

        $laporanTerbaru = Laporan::where('operator_id', $operatorId)
            ->latest()
            ->take(5)
            ->get();

        return view('operator.dashboard', compact('stats', 'laporanTerbaru'));
    }
}
