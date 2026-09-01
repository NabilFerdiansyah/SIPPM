<div class="nav-group-label">Menu</div>
<a href="{{ route('operator.dashboard') }}" class="nav-item {{ request()->routeIs('operator.dashboard') ? 'active' : '' }}"><span class="ic">&#9638;</span>Dashboard</a>
<a href="{{ route('operator.laporan.create') }}" class="nav-item {{ request()->routeIs('operator.laporan.create') ? 'active' : '' }}"><span class="ic">&#9998;</span>Buat Laporan</a>
<a href="{{ route('operator.laporan.index') }}" class="nav-item {{ request()->routeIs('operator.laporan.*') ? 'active' : '' }}"><span class="ic">&#9633;</span>Riwayat Laporan</a>
<div class="nav-group-label">Akun</div>
<a href="{{ route('operator.profil.edit') }}" class="nav-item {{ request()->routeIs('operator.profil.*') ? 'active' : '' }}"><span class="ic">&#9881;</span>Profil Saya</a>
