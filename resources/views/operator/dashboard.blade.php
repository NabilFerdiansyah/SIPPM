@extends('layouts.app')
@section('title', 'Dashboard')
@section('hero-title', 'Selamat datang, ' . auth()->user()->name)
@section('hero-sub', 'Operator ' . auth()->user()->jabatan . ' — laporkan kerusakan atau abnormalitas mesin secepatnya agar segera ditindaklanjuti.')

@section('content')
<div class="grid-stats">
  <div class="stat-card"><div class="stat-num">{{ $stats['total'] }}</div><div class="stat-label">Total Laporan</div></div>
  <div class="stat-card amber"><div class="stat-num">{{ $stats['menunggu_validasi'] }}</div><div class="stat-label">Menunggu Validasi</div></div>
  <div class="stat-card blue"><div class="stat-num">{{ $stats['sedang_ditangani'] }}</div><div class="stat-label">Sedang Ditangani</div></div>
  <div class="stat-card green"><div class="stat-num">{{ $stats['selesai'] }}</div><div class="stat-label">Selesai</div></div>
  <div class="stat-card red"><div class="stat-num">{{ $stats['ditolak'] }}</div><div class="stat-label">Ditolak</div></div>
</div>

<div class="panel">
  <div class="panel-head">
    <h3>Laporan Terbaru Saya</h3>
    <a class="btn btn-amber btn-sm" href="{{ route('operator.laporan.create') }}">+ Buat Laporan</a>
  </div>
  <div class="panel-body" style="padding:0;">
    <table class="table">
      <thead><tr><th>Kode</th><th>Mesin</th><th>Tanggal</th><th>Status</th><th></th></tr></thead>
      <tbody>
        @forelse($laporanTerbaru as $l)
          <tr>
            <td>{{ $l->kode }}</td>
            <td>{{ $l->mesin }}</td>
            <td>{{ $l->created_at->format('d M Y') }}</td>
            <td>@include('partials.status-badge', ['status' => $l->status])</td>
            <td><a class="btn btn-outline btn-sm" href="{{ route('operator.laporan.show', $l) }}">Detail</a></td>
          </tr>
        @empty
          <tr><td colspan="5" style="text-align:center;color:var(--ink-soft);padding:20px;">Belum ada laporan.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
