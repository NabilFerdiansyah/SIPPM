@extends('layouts.app')
@section('title', 'Riwayat Pekerjaan')
@section('hero-title', 'Riwayat Pekerjaan')
@section('hero-sub', 'Rekap seluruh tugas yang telah Anda selesaikan.')

@section('content')
<div class="panel">
  <div class="panel-body" style="padding:0;">
    <table class="table">
      <thead><tr><th>Kode</th><th>Mesin</th><th>Kategori</th><th>Selesai</th></tr></thead>
      <tbody>
        @forelse($penugasans as $p)
          <tr>
            <td>{{ $p->laporan->kode }}</td>
            <td>{{ $p->laporan->mesin }}</td>
            <td>{{ ucfirst($p->laporan->kategori) }}</td>
            <td>{{ $p->updated_at->format('d M Y') }}</td>
          </tr>
        @empty
          <tr><td colspan="4" style="text-align:center;color:var(--ink-soft);padding:20px;">Belum ada riwayat pekerjaan.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<div style="margin-top:14px;">{{ $penugasans->links() }}</div>
@endsection
