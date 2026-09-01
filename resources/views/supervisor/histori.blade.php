@extends('layouts.app')
@section('title', 'Histori Laporan')
@section('hero-title', 'Histori Laporan')
@section('hero-sub', 'Rekap seluruh laporan yang telah selesai ditangani.')

@section('content')
<div class="panel">
  <div class="panel-body" style="padding:0;">
    <table class="table">
      <thead><tr><th>Kode</th><th>Operator</th><th>Mesin</th><th>Teknisi</th><th>Status</th><th>Tanggal</th></tr></thead>
      <tbody>
        @forelse($laporans as $l)
          <tr>
            <td>{{ $l->kode }}</td>
            <td>{{ $l->operator->name }}</td>
            <td>{{ $l->mesin }}</td>
            <td>{{ $l->penugasan->teknisi->name ?? '-' }}</td>
            <td>@include('partials.status-badge', ['status' => $l->status])</td>
            <td>{{ $l->updated_at->format('d M Y') }}</td>
          </tr>
        @empty
          <tr><td colspan="6" style="text-align:center;color:var(--ink-soft);padding:20px;">Belum ada riwayat.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div style="margin-top:14px;">{{ $laporans->links() }}</div>
@endsection
