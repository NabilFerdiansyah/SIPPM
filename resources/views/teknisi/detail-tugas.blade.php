@extends('layouts.app')
@section('title', 'Detail Tugas')
@section('hero-title', 'Detail Tugas')
@section('hero-sub', 'Lihat informasi lengkap gangguan sebelum memulai penanganan di lapangan.')

@section('content')
<div class="panel">
  <div class="panel-head">
    <h3>{{ $penugasan->laporan->kode }} &middot; {{ $penugasan->laporan->mesin }}</h3>
  </div>
  <div class="panel-body">
    <div class="form-grid">
      <div class="field"><label>Operator Pelapor</label><input type="text" value="{{ $penugasan->laporan->operator->name }}" disabled></div>
      <div class="field"><label>Lokasi</label><input type="text" value="{{ $penugasan->laporan->lokasi }}" disabled></div>
      <div class="field"><label>Kategori</label><input type="text" value="{{ ucfirst($penugasan->laporan->kategori) }}" disabled></div>
      <div class="field"><label>Kondisi</label><input type="text" value="{{ $penugasan->laporan->kondisi }}" disabled></div>
      <div class="field span2"><label>Deskripsi</label><textarea disabled>{{ $penugasan->laporan->deskripsi }}</textarea></div>
      @if($penugasan->laporan->foto)
        <div class="field span2"><label>Foto Dokumentasi</label><img src="{{ asset('storage/'.$penugasan->laporan->foto) }}" class="foto-preview"></div>
      @endif
      @if($penugasan->catatan_penugasan)
        <div class="field span2"><label>Catatan dari Supervisor</label><textarea disabled>{{ $penugasan->catatan_penugasan }}</textarea></div>
      @endif
    </div>
  </div>
</div>

<div style="display:flex;gap:10px;">
  @if($penugasan->status === 'ditugaskan')
    <form method="POST" action="{{ route('teknisi.tugas.mulai', $penugasan) }}">
      @csrf
      <button class="btn btn-amber" type="submit">Mulai Penanganan</button>
    </form>
  @else
    <a class="btn btn-amber" href="{{ route('teknisi.tugas.hasil.create', $penugasan) }}">Isi Hasil Penanganan</a>
  @endif
  <a class="btn btn-outline" href="{{ route('teknisi.dashboard') }}">&larr; Kembali</a>
</div>
@endsection
