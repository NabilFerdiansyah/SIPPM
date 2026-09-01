@extends('layouts.app')
@section('title', 'Penugasan Teknisi')
@section('hero-title', 'Penugasan Teknisi')
@section('hero-sub', 'Pilih teknisi yang sesuai dengan kategori gangguan dan ketersediaan saat ini.')

@section('content')
<div class="panel">
  <div class="panel-body" style="padding:0;">
    <table class="table">
      <thead><tr><th>Kode</th><th>Operator</th><th>Mesin</th><th>Kategori</th><th>Tingkat</th><th></th></tr></thead>
      <tbody>
        @forelse($laporans as $l)
          <tr>
            <td>{{ $l->kode }}</td>
            <td>{{ $l->operator->name }}</td>
            <td>{{ $l->mesin }}</td>
            <td>{{ ucfirst($l->kategori) }}</td>
            <td>{{ ucfirst($l->tingkat) }}</td>
            <td><a class="btn btn-outline btn-sm" href="{{ route('supervisor.penugasan.create', $l) }}">Tugaskan</a></td>
          </tr>
        @empty
          <tr><td colspan="6" style="text-align:center;color:var(--ink-soft);padding:20px;">Tidak ada laporan yang menunggu penugasan.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
