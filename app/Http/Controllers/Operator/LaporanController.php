<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LaporanController extends Controller
{
    const CONDITION_OPTIONS = [
        'mekanik' => [
            'Bearing rusak/aus', 'Gearbox bermasalah', 'Gear/pinion aus',
            'Shaft/poros patah atau bengkok', 'Coupling rusak', 'Roll gilingan bermasalah',
            'Baut atau sambungan kendor', 'Getaran mesin berlebihan',
        ],
        'elektrik' => [
            'Motor listrik tidak mau hidup', 'Motor overheat', 'Kabel putus',
            'MCB/MCCB trip', 'Kontaktor rusak', 'Panel listrik bermasalah',
            'Fuse putus', 'Gangguan inverter/VFD',
        ],
        'instrumentasi' => [
            'Sensor suhu rusak', 'Sensor tekanan rusak', 'Flow meter error',
            'Pressure transmitter bermasalah', 'Sensor level tidak membaca',
            'Thermocouple rusak', 'Indikator/gauge tidak akurat', 'Sistem kontrol otomatis bermasalah',
        ],
    ];

    public function create()
    {
        return view('operator.buat-laporan', ['conditionOptions' => self::CONDITION_OPTIONS]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mesin' => ['required', 'string', 'max:150'],
            'lokasi' => ['nullable', 'string', 'max:150'],
            'kategori' => ['required', 'in:mekanik,elektrik,instrumentasi'],
            'kondisi' => ['required', 'string', 'max:150'],
            'tingkat' => ['required', 'in:ringan,sedang,berat'],
            'deskripsi' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'max:4096'],
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('laporan', 'public');
        }

        $kode = 'LAP-'.now()->format('Ymd').'-'.Str::padLeft((string) (Laporan::whereDate('created_at', now())->count() + 1), 3, '0');

        $laporan = Laporan::create([
            ...$validated,
            'foto' => $path,
            'kode' => $kode,
            'operator_id' => $request->user()->id,
            'status' => Laporan::STATUS_BARU,
        ]);

        return redirect()->route('operator.laporan.show', $laporan)
            ->with('success', 'Laporan kerusakan berhasil dikirim dan menunggu validasi Supervisor.');
    }

    public function index(Request $request)
    {
        $laporans = Laporan::where('operator_id', $request->user()->id)->latest()->paginate(10);
        return view('operator.riwayat', compact('laporans'));
    }

    public function show(Request $request, Laporan $laporan)
    {
        abort_unless($laporan->operator_id === $request->user()->id, 403);
        $laporan->load('penugasan.teknisi', 'penugasan.hasilPerbaikan');

        return view('operator.detail-laporan', compact('laporan'));
    }
}
