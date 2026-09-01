<div class="nav-group-label">Operasional</div>
<a href="{{ route('supervisor.dashboard') }}" class="nav-item {{ request()->routeIs('supervisor.dashboard') ? 'active' : '' }}"><span class="ic">&#9638;</span>Dashboard</a>
<a href="{{ route('supervisor.validasi.index') }}" class="nav-item {{ request()->routeIs('supervisor.validasi.*') ? 'active' : '' }}"><span class="ic">&#10003;</span>Validasi Laporan</a>
<a href="{{ route('supervisor.penugasan.index') }}" class="nav-item {{ request()->routeIs('supervisor.penugasan.*') ? 'active' : '' }}"><span class="ic">&#8594;</span>Penugasan Teknisi</a>
<a href="{{ route('supervisor.validasi-akhir.index') }}" class="nav-item {{ request()->routeIs('supervisor.validasi-akhir.*') ? 'active' : '' }}"><span class="ic">&#10004;</span>Validasi Akhir</a>
<div class="nav-group-label">Riwayat</div>
<a href="{{ route('supervisor.histori.index') }}" class="nav-item {{ request()->routeIs('supervisor.histori.*') ? 'active' : '' }}"><span class="ic">&#9776;</span>Histori Laporan</a>
<div class="nav-group-label">Manajemen Akun</div>
<a href="{{ route('supervisor.akun.index') }}" class="nav-item {{ request()->routeIs('supervisor.akun.*') ? 'active' : '' }}"><span class="ic">&#128100;</span>Kelola Akun</a>
<div class="nav-group-label">Akun</div>
<a href="{{ route('supervisor.profil.edit') }}" class="nav-item {{ request()->routeIs('supervisor.profil.*') ? 'active' : '' }}"><span class="ic">&#9881;</span>Profil Saya</a>
