@extends('layouts.app')
@section('title', 'Buat Laporan Kerusakan')
@section('hero-title', 'Buat Laporan Kerusakan')
@section('hero-sub', 'Isi detail gangguan mesin selengkap mungkin agar Supervisor dapat menindaklanjuti dengan cepat dan tepat.')

@section('content')
<div class="panel">
  <div class="panel-head"><h3>Form Laporan Kerusakan / Abnormalitas</h3></div>
  <div class="panel-body">
    <form method="POST" action="{{ route('operator.laporan.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-grid">
        <div class="field">
          <label>Nama Mesin</label>
          <input type="text" name="mesin" value="{{ old('mesin') }}" placeholder="mis. Gilingan I" required>
        </div>
        <div class="field">
          <label>Lokasi / Stasiun</label>
          <input type="text" name="lokasi" value="{{ old('lokasi') }}" placeholder="mis. Stasiun Gilingan">
        </div>
        <div class="field">
          <label>Kategori Gangguan</label>
          <select name="kategori" id="reportCategory" onchange="updateConditionOptions()" required>
            <option value="mekanik" {{ old('kategori')=='mekanik'?'selected':'' }}>Mekanik</option>
            <option value="elektrik" {{ old('kategori')=='elektrik'?'selected':'' }}>Elektrik</option>
            <option value="instrumentasi" {{ old('kategori')=='instrumentasi'?'selected':'' }}>Instrumentasi</option>
          </select>
        </div>
        <div class="field">
          <label>Kondisi / Gejala</label>
          <select name="kondisi" id="reportCondition" required></select>
        </div>
        <div class="field">
          <label>Tingkat Kerusakan</label>
          <select name="tingkat" required>
            <option value="ringan" {{ old('tingkat')=='ringan'?'selected':'' }}>Ringan</option>
            <option value="sedang" {{ old('tingkat', 'sedang')=='sedang'?'selected':'' }}>Sedang</option>
            <option value="berat" {{ old('tingkat')=='berat'?'selected':'' }}>Berat</option>
          </select>
        </div>
        <div class="field span2">
          <label>Deskripsi Gangguan</label>
          <textarea name="deskripsi" placeholder="Jelaskan kondisi kerusakan secara rinci...">{{ old('deskripsi') }}</textarea>
        </div>
        <div class="field span2">
          <label>Foto Dokumentasi (opsional)</label>
          <label class="upload-box">
            <input type="file" name="foto" accept="image/*" onchange="handleUploadBoxChange(this)" style="display:none;">
            <span>Klik untuk unggah foto (JPG/PNG)</span>
          </label>
        </div>
      </div>
      <div class="form-actions" style="margin-top:16px;display:flex;gap:10px;">
        <button class="btn btn-amber" type="submit">Kirim Laporan</button>
        <a class="btn btn-outline" href="{{ route('operator.dashboard') }}">Batal</a>
      </div>
    </form>
  </div>
</div>

<script>
const CONDITION_OPTIONS = @json($conditionOptions);
function updateConditionOptions(){
  const cat = document.getElementById('reportCategory').value;
  const condSelect = document.getElementById('reportCondition');
  condSelect.innerHTML = '';
  (CONDITION_OPTIONS[cat] || []).forEach(opt=>{
    const o = document.createElement('option');
    o.textContent = opt; o.value = opt;
    condSelect.appendChild(o);
  });
}
function handleUploadBoxChange(input){
  const file = input.files && input.files[0];
  const box = input.closest('.upload-box');
  if(!file || !box) return;
  box.classList.add('has-file');
  let span = box.querySelector('span');
  if (span) span.textContent = 'Terpilih: ' + file.name;
}
document.addEventListener('DOMContentLoaded', updateConditionOptions);
</script>
@endsection
