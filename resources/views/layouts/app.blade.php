<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIPPM &middot; PG Rendeng @hasSection('title') - @yield('title') @endif</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="app" id="appShell">

  <aside class="sidebar">
    <div class="brand">
      <div class="brand-mark">SIP<span>PM</span></div>
      <div class="brand-sub">PG Rendeng &middot; Sinergi Gula Nusantara</div>
    </div>

    <div class="sidebar-block sidebar-block-actor">
      <div class="role-switch">
        <div class="role-switch-label">Masuk sebagai</div>
        <div class="role-pills">
          <button class="role-pill active" type="button"><span class="dot"></span>{{ ucfirst(auth()->user()->role) }}</button>
        </div>
      </div>
    </div>

    <div class="sidebar-divider"></div>

    <div class="sidebar-block sidebar-block-menu">
      <div class="sidebar-block-label">Menu &amp; Fitur</div>
      <nav class="nav">
        @include('partials.nav-' . auth()->user()->role)
      </nav>
    </div>

    <div class="sidebar-foot">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn-logout" type="submit">&#9099; Keluar (Logout)</button>
      </form>
      <div class="sidebar-foot-note">SIPPM &middot; Sistem Informasi Pelaporan &amp; Penanganan Kerusakan Mesin Giling.</div>
    </div>
  </aside>

  <div class="main">
    <div class="topbar">
      <div>
        <div class="topbar-crumb">{{ ucfirst(auth()->user()->role) }}</div>
        <div class="topbar-title">@yield('title')</div>
      </div>
      <div class="topbar-user">
        <div style="text-align:right;">
          <div style="font-weight:600;">{{ auth()->user()->name }}</div>
          <div style="font-size:11px;color:var(--ink-soft);">{{ ucfirst(auth()->user()->role) }} &middot; {{ auth()->user()->jabatan }}</div>
        </div>
        <div class="avatar">{{ auth()->user()->initials() }}</div>
      </div>
    </div>

    <div class="content">

      <div class="page-hero" id="pageHero">
        <div class="page-hero-body">
          <div>
            <div class="page-hero-eyebrow">PG Rendeng &middot; Sinergi Gula Nusantara</div>
            <div class="page-hero-title">@yield('hero-title', 'Selamat datang')</div>
            <div class="page-hero-sub">@yield('hero-sub', '&nbsp;')</div>
          </div>
          <div class="page-hero-badge"><span class="dot"></span><span>{{ ucfirst(auth()->user()->role) }} &middot; {{ auth()->user()->jabatan }}</span></div>
        </div>
      </div>

      @if (session('success'))
        <div class="alert-flash alert-success">{{ session('success') }}</div>
      @endif
      @if ($errors->any())
        <div class="alert-flash alert-error">
          <ul style="margin:0;padding-left:18px;">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <section class="screen active">
        @yield('content')
      </section>

    </div>
  </div>
</div>

</body>
</html>
