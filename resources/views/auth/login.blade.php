<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SIPPM &mdash; Masuk ke Akun Anda</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div id="loginScreen" class="login-wrap" style="display:flex;">
  <div class="login-shell">
    <div class="login-side">
      <div class="login-side-top">
        <div class="lm">SIP<span>PM</span></div>
        <div class="ls">Sistem Informasi Pelaporan &amp; Penanganan Kerusakan Mesin Giling Dengan Alur Yang Terstruktur Dan Terdokumentasi Berbasis Web.</div>
        <div class="login-side-flow">
          <div class="login-flow-step"><span class="n">1</span> Operator melapor</div>
          <div class="login-flow-step"><span class="n">2</span> Supervisor memvalidasi &amp; menugaskan</div>
          <div class="login-flow-step"><span class="n">3</span> Teknisi menangani</div>
          <div class="login-flow-step"><span class="n">4</span> Supervisor menyelesaikan &amp; mengarsipkan</div>
        </div>
      </div>
      <div class="login-side-foot">&copy; {{ date('Y') }} PG Rendeng &middot; Sinergi Gula Nusantara</div>
    </div>

    <div class="login-form-panel">
      <div class="login-form-heading">
        <h1>Masuk ke Akun Anda</h1>
        <p>Pilih peran, lalu masukkan username &amp; kata sandi</p>
      </div>
      <div class="login-body">
        <form method="POST" action="{{ route('login.attempt') }}">
          @csrf
          <div class="login-role-tabs" id="roleTabs">
            @php $selectedRole = old('role', 'operator'); @endphp
            <button type="button" class="lrt {{ $selectedRole==='operator'?'on':'' }}" data-role="operator" onclick="selectRole('operator')">Operator</button>
            <button type="button" class="lrt {{ $selectedRole==='supervisor'?'on':'' }}" data-role="supervisor" onclick="selectRole('supervisor')">Supervisor</button>
            <button type="button" class="lrt {{ $selectedRole==='teknisi'?'on':'' }}" data-role="teknisi" onclick="selectRole('teknisi')">Teknisi</button>
          </div>
          <input type="hidden" name="role" id="roleInput" value="{{ $selectedRole }}">

          @if ($errors->any())
            <div class="alert-flash alert-error">
              @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
              @endforeach
            </div>
          @endif

          <div class="field">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username', 'andi.operator') }}" id="loginUsername" required>
          </div>
          <div class="field">
            <label>Kata Sandi</label>
            <input type="password" name="password" required placeholder="password">
          </div>
          <button class="btn btn-amber" type="submit" style="justify-content:center;margin-top:4px;width:100%;">Masuk sebagai <span id="loginRoleLabel">{{ ucfirst($selectedRole) }}</span></button>
          <div class="login-note">Satu akun = satu peran. Akun demo: andi.operator / sri.supervisor / budi.teknisi &mdash; kata sandi: <b>password</b></div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
const DEMO_USERNAMES = { operator: 'andi.operator', supervisor: 'sri.supervisor', teknisi: 'budi.teknisi' };
const ROLE_LABELS = { operator:'Operator', supervisor:'Supervisor', teknisi:'Teknisi' };
function selectRole(role){
  document.querySelectorAll('.lrt').forEach(b => b.classList.toggle('on', b.dataset.role === role));
  document.getElementById('roleInput').value = role;
  document.getElementById('loginUsername').value = DEMO_USERNAMES[role];
  document.getElementById('loginRoleLabel').textContent = ROLE_LABELS[role];
}
</script>
</body>
</html>
