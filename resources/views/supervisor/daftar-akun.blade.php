@extends('layouts.app')
@section('title', 'Kelola Akun')
@section('hero-title', 'Kelola Akun')
@section('hero-sub', 'Atur dan pantau status keaktifan seluruh akun Operator maupun Teknisi.')

@section('content')
<div class="panel">
  <div class="panel-head">
    <div class="account-tabs" style="display:flex;gap:8px;">
      <a href="{{ route('supervisor.akun.index', ['peran'=>'operator']) }}" class="lrt {{ $role==='operator'?'on':'' }}">Operator</a>
      <a href="{{ route('supervisor.akun.index', ['peran'=>'teknisi']) }}" class="lrt {{ $role==='teknisi'?'on':'' }}">Teknisi</a>
    </div>
    <a class="btn btn-amber btn-sm" href="{{ route('supervisor.akun.create') }}">+ Tambah Akun</a>
  </div>
  <div class="panel-body" style="padding:0;">
    <table class="table">
      <thead><tr><th>Nama</th><th>Username</th><th>Jabatan</th><th>Status</th><th></th></tr></thead>
      <tbody>
        @forelse($akun as $a)
          <tr>
            <td>{{ $a->name }}</td>
            <td>{{ $a->username }}</td>
            <td>{{ $a->jabatan }}</td>
            <td>
              @if($a->status === 'aktif')
                <span class="badge b-green">Aktif</span>
              @else
                <span class="badge b-red">Nonaktif</span>
              @endif
            </td>
            <td>
              <form method="POST" action="{{ route('supervisor.akun.toggle-status', $a) }}">
                @csrf
                <button class="btn btn-outline btn-sm" type="submit">{{ $a->status === 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5" style="text-align:center;color:var(--ink-soft);padding:20px;">Belum ada akun.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
