@extends('layouts.app')
@section('title', 'Tugas Saya')
@section('hero-title', 'Selamat datang, ' . auth()->user()->name)
@section('hero-sub', 'Teknisi ' . auth()->user()->jabatan . ' — kelola tugas perbaikan yang ditugaskan dan catat hasil penanganan di sini.')

@section('content')
<div class="grid-stats">
  <div class="stat-card amber"><div class="stat-num">{{ $stats['baru'] }}</div><div class="stat-label">Tugas Baru</div></div>
  <div class="stat-card blue"><div class="stat-num">{{ $stats['dikerjakan'] }}</div><div class="stat-label">Sedang Dikerjakan</div></div>
  <div class="stat-card green"><div class="stat-num">{{ $stats['selesai'] }}</div><div class="stat-label">Selesai</div></div>
</div>

<div class="panel">
  <div class="panel-head"><h3>Tugas Aktif</h3></div>
  <div class="panel-body" style="padding:0;">
    <table class="table">
      <thead><tr><th>Kode</th><th>Mesin</th><th>Kategori</th><th>Status</th><th></th></tr></thead>
      <tbody>
        @forelse($tugasAktif as $p)
          <tr>
            <td>{{ $p->laporan->kode }}</td>
            <td>{{ $p->laporan->mesin }}</td>
            <td>{{ ucfirst($p->laporan->kategori) }}</td>
            <td>
              @if($p->status === 'ditugaskan')
                <span class="badge b-amber">Belum Dimulai</span>
              @else
                <span class="badge b-blue">Sedang Dikerjakan</span>
              @endif
            </td>
            <td><a class="btn btn-outline btn-sm" href="{{ route('teknisi.tugas.show', $p) }}">Detail</a></td>
          </tr>
        @empty
          <tr><td colspan="5" style="text-align:center;color:var(--ink-soft);padding:20px;">Tidak ada tugas aktif saat ini.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
