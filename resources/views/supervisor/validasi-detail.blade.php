@extends('layouts.app')
@section('title', 'Validasi Laporan')
@section('hero-title', 'Validasi Laporan')
@section('hero-sub', 'Periksa kelengkapan dan kelayakan laporan sebelum diteruskan ke teknisi.')

@section('content')
<div class="panel">
  <div class="panel-head">
    <h3>{{ $laporan->kode }}</h3>
    <span class="badge b-amber">Menunggu Validasi</span>
  </div>
  <div class="panel-body">
    <div class="form-grid">
      <div class="field"><label>Operator Pelapor</label><input type="text" value="{{ $laporan->operator->name }}" disabled></div>
      <div class="field"><label>Mesin</label><input type="text" value="{{ $laporan->mesin }}" disabled></div>
      <div class="field"><label>Lokasi</label><input type="text" value="{{ $laporan->lokasi }}" disabled></div>
      <div class="field"><label>Kategori</label><input type="text" value="{{ ucfirst($laporan->kategori) }}" disabled></div>
      <div class="field"><label>Kondisi</label><input type="text" value="{{ $laporan->kondisi }}" disabled></div>
      <div class="field"><label>Tingkat Kerusakan</label><input type="text" value="{{ ucfirst($laporan->tingkat) }}" disabled></div>
      <div class="field span2"><label>Deskripsi</label><textarea disabled>{{ $laporan->deskripsi }}</textarea></div>
      @if($laporan->foto)
        <div class="field span2">
          <label>Foto Dokumentasi</label>
          <img src="{{ asset('storage/'.$laporan->foto) }}" class="foto-preview">
        </div>
      @endif
    </div>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h3>Keputusan Validasi</h3></div>
  <div class="panel-body">
    <div style="display:flex;gap:24px;flex-wrap:wrap;">
      <form method="POST" action="{{ route('supervisor.validasi.setujui', $laporan) }}" style="flex:1;min-width:260px;">
        @csrf
        <div class="field">
          <label>Catatan (opsional)</label>
          <textarea name="catatan_supervisor" placeholder="Catatan untuk teknisi..."></textarea>
        </div>
        <button class="btn btn-amber" type="submit" style="margin-top:10px;">Setujui &amp; Lanjut ke Penugasan</button>
      </form>
      <form method="POST" action="{{ route('supervisor.validasi.tolak', $laporan) }}" style="flex:1;min-width:260px;">
        @csrf
        <div class="field">
          <label>Alasan Penolakan</label>
          <textarea name="catatan_penolakan" placeholder="Jelaskan alasan penolakan..." required></textarea>
        </div>
        <button class="btn btn-outline" type="submit" style="margin-top:10px;">Tolak Laporan</button>
      </form>
    </div>
  </div>
</div>
<a class="btn btn-outline" href="{{ route('supervisor.validasi.index') }}">&larr; Kembali</a>
@endsection
