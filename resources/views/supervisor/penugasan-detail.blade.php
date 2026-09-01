@extends('layouts.app')
@section('title', 'Penugasan Teknisi')
@section('hero-title', 'Penugasan Teknisi')
@section('hero-sub', 'Pilih teknisi yang sesuai dengan kategori gangguan dan ketersediaan saat ini.')

@section('content')
<div class="panel">
  <div class="panel-head"><h3>{{ $laporan->kode }} &middot; {{ $laporan->mesin }}</h3></div>
  <div class="panel-body">
    <p style="color:var(--ink-soft);font-size:13.5px;">{{ $laporan->deskripsi }}</p>
    <form method="POST" action="{{ route('supervisor.penugasan.store', $laporan) }}">
      @csrf
      <div class="form-grid">
        <div class="field span2">
          <label>Pilih Teknisi</label>
          <select name="teknisi_id" required>
            <option value="">-- Pilih Teknisi --</option>
            @foreach($teknisi as $t)
              <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->jabatan }})</option>
            @endforeach
          </select>
        </div>
        <div class="field span2">
          <label>Catatan Penugasan (opsional)</label>
          <textarea name="catatan_penugasan" placeholder="Instruksi tambahan untuk teknisi..."></textarea>
        </div>
      </div>
      <div style="margin-top:16px;">
        <button class="btn btn-amber" type="submit">Tugaskan ke Teknisi</button>
        <a class="btn btn-outline" href="{{ route('supervisor.penugasan.index') }}">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
