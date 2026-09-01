@extends('layouts.app')
@section('title', 'Riwayat Laporan')
@section('hero-title', 'Riwayat Laporan Saya')
@section('hero-sub', 'Seluruh laporan kerusakan yang pernah Anda buat.')

@section('content')
<div class="panel">
  <div class="panel-body" style="padding:0;">
    <table class="table">
      <thead><tr><th>Kode</th><th>Mesin</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th></th></tr></thead>
      <tbody>
        @forelse($laporans as $l)
          <tr>
            <td>{{ $l->kode }}</td>
            <td>{{ $l->mesin }}</td>
            <td>{{ ucfirst($l->kategori) }}</td>
            <td>{{ $l->created_at->format('d M Y') }}</td>
            <td>@include('partials.status-badge', ['status' => $l->status])</td>
            <td><a class="btn btn-outline btn-sm" href="{{ route('operator.laporan.show', $l) }}">Detail</a></td>
          </tr>
        @empty
          <tr><td colspan="6" style="text-align:center;color:var(--ink-soft);padding:20px;">Belum ada laporan.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div style="margin-top:14px;">{{ $laporans->links() }}</div>
@endsection
