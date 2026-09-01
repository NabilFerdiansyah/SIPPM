@extends('layouts.app')
@section('title', 'Detail Laporan')
@section('hero-title', 'Detail Laporan')
@section('hero-sub', 'Pantau status dan riwayat penanganan atas laporan yang telah Anda kirim.')

@section('content')
<div class="panel">
  <div class="panel-head">
    <h3>{{ $laporan->kode }}</h3>
    @include('partials.status-badge', ['status' => $laporan->status])
  </div>
  <div class="panel-body">
    <div class="form-grid">
      <div class="field"><label>Mesin</label><input type="text" value="{{ $laporan->mesin }}" disabled></div>
      <div class="field"><label>Lokasi</label><input type="text" value="{{ $laporan->lokasi }}" disabled></div>
      <div class="field"><label>Kategori</label><input type="text" value="{{ ucfirst($laporan->kategori) }}" disabled></div>
      <div class="field"><label>Kondisi</label><input type="text" value="{{ $laporan->kondisi }}" disabled></div>
      <div class="field"><label>Tingkat Kerusakan</label><input type="text" value="{{ ucfirst($laporan->tingkat) }}" disabled></div>
      <div class="field"><label>Tanggal Lapor</label><input type="text" value="{{ $laporan->created_at->format('d M Y H:i') }}" disabled></div>
      <div class="field span2"><label>Deskripsi</label><textarea disabled>{{ $laporan->deskripsi }}</textarea></div>
      @if($laporan->foto)
        <div class="field span2">
          <label>Foto Dokumentasi</label>
          <img src="{{ asset('storage/'.$laporan->foto) }}" class="foto-preview">
        </div>
      @endif
      @if($laporan->status === 'ditolak')
        <div class="field span2">
          <label>Catatan Penolakan Supervisor</label>
          <textarea disabled>{{ $laporan->catatan_penolakan }}</textarea>
        </div>
      @endif
    </div>
  </div>
</div>

@if($laporan->penugasan)
<div class="panel">
  <div class="panel-head"><h3>Penanganan Teknisi</h3></div>
  <div class="panel-body">
    <div class="form-grid">
      <div class="field"><label>Teknisi</label><input type="text" value="{{ $laporan->penugasan->teknisi->name }}" disabled></div>
      <div class="field"><label>Status Penugasan</label><input type="text" value="{{ ucfirst($laporan->penugasan->status) }}" disabled></div>
      @if($laporan->penugasan->hasilPerbaikan)
        <div class="field span2"><label>Tindakan Perbaikan</label><textarea disabled>{{ $laporan->penugasan->hasilPerbaikan->tindakan_perbaikan }}</textarea></div>
        <div class="field"><label>Komponen Diganti</label><input type="text" value="{{ $laporan->penugasan->hasilPerbaikan->komponen_diganti }}" disabled></div>
        <div class="field"><label>Waktu Selesai</label><input type="text" value="{{ optional($laporan->penugasan->hasilPerbaikan->waktu_selesai)->format('d M Y H:i') }}" disabled></div>
      @endif
    </div>
  </div>
</div>
@endif

<a class="btn btn-outline" href="{{ route('operator.dashboard') }}">&larr; Kembali ke Dashboard</a>
@endsection
