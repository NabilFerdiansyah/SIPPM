@extends('layouts.app')
@section('title', 'Tambah Akun')
@section('hero-title', 'Tambah Akun Baru')
@section('hero-sub', 'Daftarkan akun Operator atau Teknisi baru ke dalam sistem.')

@section('content')
<div class="panel">
  <div class="panel-head"><h3>Form Akun Baru</h3></div>
  <div class="panel-body">
    <form method="POST" action="{{ route('supervisor.akun.store') }}">
      @csrf
      <div class="form-grid">
        <div class="field">
          <label>Nama Lengkap</label>
          <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="field">
          <label>Peran</label>
          <select name="role" required>
            <option value="operator" {{ old('role')=='operator'?'selected':'' }}>Operator</option>
            <option value="teknisi" {{ old('role')=='teknisi'?'selected':'' }}>Teknisi</option>
          </select>
        </div>
        <div class="field">
          <label>Jabatan / Unit</label>
          <input type="text" name="jabatan" value="{{ old('jabatan') }}" placeholder="mis. Gilingan, Maintenance">
        </div>
        <div class="field">
          <label>No. HP</label>
          <input type="text" name="no_hp" value="{{ old('no_hp') }}">
        </div>
      </div>
      <div style="margin-top:16px;">
        <button class="btn btn-amber" type="submit">Buat Akun</button>
        <a class="btn btn-outline" href="{{ route('supervisor.akun.index') }}">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
