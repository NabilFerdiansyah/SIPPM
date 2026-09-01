<div class="nav-group-label">Menu</div>
<a href="{{ route('teknisi.dashboard') }}" class="nav-item {{ request()->routeIs('teknisi.dashboard') ? 'active' : '' }}"><span class="ic">&#9638;</span>Tugas Saya</a>
<a href="{{ route('teknisi.riwayat.index') }}" class="nav-item {{ request()->routeIs('teknisi.riwayat.*') ? 'active' : '' }}"><span class="ic">&#9776;</span>Riwayat</a>
<div class="nav-group-label">Akun</div>
<a href="{{ route('teknisi.profil.edit') }}" class="nav-item {{ request()->routeIs('teknisi.profil.*') ? 'active' : '' }}"><span class="ic">&#9881;</span>Profil Saya</a>
