@extends('layouts.app')
@section('title', 'Form Hasil Penanganan')
@section('hero-title', 'Form Hasil Penanganan')
@section('hero-sub', 'Catat hasil pemeriksaan, tindakan, dan waktu penyelesaian pekerjaan.')

@section('content')
<div class="panel">
  <div class="panel-head"><h3>{{ $penugasan->laporan->kode }} &middot; {{ $penugasan->laporan->mesin }}</h3></div>
  <div class="panel-body">
    <form method="POST" action="{{ route('teknisi.tugas.hasil.store', $penugasan) }}" enctype="multipart/form-data">
      @csrf
      <div class="form-grid">
        <div class="field span2">
          <label>Tindakan Perbaikan</label>
          <textarea name="tindakan_perbaikan" placeholder="Jelaskan tindakan yang dilakukan..." required>{{ old('tindakan_perbaikan') }}</textarea>
        </div>
        <div class="field">
          <label>Komponen Diganti (jika ada)</label>
          <input type="text" name="komponen_diganti" value="{{ old('komponen_diganti') }}">
        </div>
        <div class="field"></div>
        <div class="field">
          <label>Waktu Mulai</label>
          <input type="datetime-local" name="waktu_mulai" value="{{ old('waktu_mulai') }}" required>
        </div>
        <div class="field">
          <label>Waktu Selesai</label>
          <input type="datetime-local" name="waktu_selesai" value="{{ old('waktu_selesai') }}" required>
        </div>
        <div class="field span2">
          <label>Catatan Tambahan</label>
          <textarea name="catatan_teknisi" placeholder="Catatan lain, rekomendasi perawatan, dll...">{{ old('catatan_teknisi') }}</textarea>
        </div>
        <div class="field span2">
          <label>Foto Hasil Penanganan (opsional)</label>
          <label class="upload-box">
            <input type="file" name="foto_hasil" accept="image/*" onchange="handleUploadBoxChange(this)" style="display:none;">
            <span>Klik untuk unggah foto (JPG/PNG)</span>
          </label>
        </div>
      </div>
      <div style="margin-top:16px;">
        <button class="btn btn-amber" type="submit">Kirim Hasil Penanganan</button>
        <a class="btn btn-outline" href="{{ route('teknisi.tugas.show', $penugasan) }}">Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
function handleUploadBoxChange(input){
  const file = input.files && input.files[0];
  const box = input.closest('.upload-box');
  if(!file || !box) return;
  box.classList.add('has-file');
  let span = box.querySelector('span');
  if (span) span.textContent = 'Terpilih: ' + file.name;
}
</script>
@endsection
