@extends('layouts.app')
@section('title', 'Validasi Akhir')
@section('hero-title', 'Validasi Akhir')
@section('hero-sub', 'Tinjau hasil penanganan teknisi sebelum laporan dinyatakan selesai.')

@section('content')
<div class="panel">
  <div class="panel-head"><h3>{{ $laporan->kode }} &middot; {{ $laporan->mesin }}</h3></div>
  <div class="panel-body">
    <div class="form-grid">
      <div class="field"><label>Operator</label><input type="text" value="{{ $laporan->operator->name }}" disabled></div>
      <div class="field"><label>Teknisi</label><input type="text" value="{{ $laporan->penugasan->teknisi->name }}" disabled></div>
      <div class="field span2"><label>Deskripsi Awal</label><textarea disabled>{{ $laporan->deskripsi }}</textarea></div>
      @if($hasil = $laporan->penugasan->hasilPerbaikan)
        <div class="field span2"><label>Tindakan Perbaikan</label><textarea disabled>{{ $hasil->tindakan_perbaikan }}</textarea></div>
        <div class="field"><label>Komponen Diganti</label><input type="text" value="{{ $hasil->komponen_diganti }}" disabled></div>
        <div class="field"><label>Durasi</label><input type="text" value="{{ optional($hasil->waktu_mulai)->format('d M H:i') }} &ndash; {{ optional($hasil->waktu_selesai)->format('d M H:i') }}" disabled></div>
        <div class="field span2"><label>Catatan Teknisi</label><textarea disabled>{{ $hasil->catatan_teknisi }}</textarea></div>
        @if($hasil->foto_hasil)
          <div class="field span2"><label>Foto Hasil</label><img src="{{ asset('storage/'.$hasil->foto_hasil) }}" class="foto-preview"></div>
        @endif
      @endif
    </div>
  </div>
</div>

<div class="panel">
  <div class="panel-head"><h3>Keputusan Akhir</h3></div>
  <div class="panel-body">
    <div style="display:flex;gap:24px;flex-wrap:wrap;">
      <form method="POST" action="{{ route('supervisor.validasi-akhir.selesai', $laporan) }}">
        @csrf
        <button class="btn btn-amber" type="submit">Nyatakan Selesai &amp; Arsipkan</button>
      </form>
      <form method="POST" action="{{ route('supervisor.validasi-akhir.kembalikan', $laporan) }}" style="flex:1;min-width:260px;">
        @csrf
        <div class="field">
          <label>Catatan (jika dikembalikan ke teknisi)</label>
          <textarea name="catatan_supervisor" placeholder="Jelaskan yang perlu diperbaiki lagi..." required></textarea>
        </div>
        <button class="btn btn-outline" type="submit" style="margin-top:10px;">Kembalikan ke Teknisi</button>
      </form>
    </div>
  </div>
</div>
<a class="btn btn-outline" href="{{ route('supervisor.validasi-akhir.index') }}">&larr; Kembali</a>
@endsection
