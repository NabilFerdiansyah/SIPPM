@extends('layouts.app')
@section('title', 'Dashboard')
@section('hero-title', 'Selamat datang, ' . auth()->user()->name)
@section('hero-sub', 'Supervisor ' . auth()->user()->jabatan . ' — pantau, validasi, dan tugaskan laporan kerusakan ke teknisi yang sesuai.')

@section('content')
<div class="grid-stats">
  <div class="stat-card amber"><div class="stat-num">{{ $stats['baru'] }}</div><div class="stat-label">Laporan Baru</div></div>
  <div class="stat-card blue"><div class="stat-num">{{ $stats['ditangani'] }}</div><div class="stat-label">Sedang Ditangani</div></div>
  <div class="stat-card" style="border-left-color:#946A0E;"><div class="stat-num">{{ $stats['menunggu_validasi_akhir'] }}</div><div class="stat-label">Menunggu Validasi Akhir</div></div>
  <div class="stat-card green"><div class="stat-num">{{ $stats['selesai'] }}</div><div class="stat-label">Selesai</div></div>
</div>

<div class="panel">
  <div class="panel-head"><h3>Laporan Terbaru</h3></div>
  <div class="panel-body" style="padding:0;">
    <table class="table">
      <thead><tr><th>Kode</th><th>Operator</th><th>Mesin</th><th>Tanggal</th><th>Status</th></tr></thead>
      <tbody>
        @forelse($terbaru as $l)
          <tr>
            <td>{{ $l->kode }}</td>
            <td>{{ $l->operator->name }}</td>
            <td>{{ $l->mesin }}</td>
            <td>{{ $l->created_at->format('d M Y') }}</td>
            <td>@include('partials.status-badge', ['status' => $l->status])</td>
          </tr>
        @empty
          <tr><td colspan="5" style="text-align:center;color:var(--ink-soft);padding:20px;">Belum ada laporan.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
