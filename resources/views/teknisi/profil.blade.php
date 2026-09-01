@extends('layouts.app')
@section('title', 'Profil Saya')
@section('hero-title', 'Profil Saya')
@section('hero-sub', 'Kelola data akun dan kata sandi Anda.')

@section('content')
<div class="panel">
  <div class="panel-head"><h3>Data Akun</h3></div>
  <div class="panel-body">
    <form method="POST" action="{{ route('teknisi.profil.update') }}">
      @csrf @method('PUT')
      <div class="form-grid">
        <div class="field"><label>Nama Lengkap</label><input type="text" name="name" value="{{ old('name', $user->name) }}" required></div>
        <div class="field"><label>Username</label><input type="text" value="{{ $user->username }}" disabled></div>
        <div class="field"><label>Jabatan / Unit</label><input type="text" value="{{ $user->jabatan }}" disabled></div>
        <div class="field"><label>No. HP</label><input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"></div>
        <div class="field"><label>Kata Sandi Baru</label><input type="password" name="password" placeholder="Kosongkan jika tidak diubah"></div>
        <div class="field"><label>Konfirmasi Kata Sandi</label><input type="password" name="password_confirmation"></div>
      </div>
      <div style="margin-top:16px;">
        <button class="btn btn-amber" type="submit">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>
@endsection
