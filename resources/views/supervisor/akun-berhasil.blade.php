@extends('layouts.app')
@section('title', 'Akun Berhasil Dibuat')
@section('hero-title', 'Akun Berhasil Dibuat')
@section('hero-sub', 'Akun baru siap digunakan — bagikan kredensial ke pemilik akun terkait.')

@section('content')
<div class="panel">
  <div class="panel-head"><h3>&#10004; Akun {{ $akun->name }} berhasil dibuat</h3></div>
  <div class="panel-body">
    <div class="form-grid">
      <div class="field"><label>Nama</label><input type="text" value="{{ $akun->name }}" disabled></div>
      <div class="field"><label>Peran</label><input type="text" value="{{ ucfirst($akun->role) }}" disabled></div>
      <div class="field"><label>Username</label><input type="text" value="{{ $akun->username }}" disabled></div>
      <div class="field"><label>Kata Sandi Sementara</label><input type="text" value="{{ $tempPassword }}" disabled></div>
    </div>
    <p style="margin-top:14px;color:var(--ink-soft);font-size:13px;">Sampaikan username dan kata sandi sementara ini kepada pemilik akun. Sarankan mereka mengganti kata sandi setelah login pertama melalui menu Profil Saya.</p>
    <a class="btn btn-amber" href="{{ route('supervisor.akun.index', ['peran'=>$akun->role]) }}">Kembali ke Daftar Akun</a>
  </div>
</div>
@endsection
