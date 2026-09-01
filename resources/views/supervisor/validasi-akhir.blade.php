@extends('layouts.app')
@section('title', 'Validasi Akhir')
@section('hero-title', 'Validasi Akhir')
@section('hero-sub', 'Tinjau hasil penanganan teknisi sebelum laporan dinyatakan selesai.')

@section('content')
<div class="panel">
  <div class="panel-body" style="padding:0;">
    <table class="table">
      <thead><tr><th>Kode</th><th>Mesin</th><th>Teknisi</th><th>Selesai Ditangani</th><th></th></tr></thead>
      <tbody>
        @forelse($laporans as $l)
          <tr>
            <td>{{ $l->kode }}</td>
            <td>{{ $l->mesin }}</td>
            <td>{{ $l->penugasan->teknisi->name ?? '-' }}</td>
            <td>{{ optional($l->penugasan->hasilPerbaikan)->waktu_selesai?->format('d M Y H:i') }}</td>
            <td><a class="btn btn-outline btn-sm" href="{{ route('supervisor.validasi-akhir.show', $l) }}">Tinjau</a></td>
          </tr>
        @empty
          <tr><td colspan="5" style="text-align:center;color:var(--ink-soft);padding:20px;">Tidak ada laporan menunggu validasi akhir.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
