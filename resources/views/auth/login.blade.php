<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk — StagePass</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root{--bg:#0a0a0f;--surface:#13131a;--card:#1a1a26;--purple:#7c3aed;--purple-light:#a855f7;--pink:#ec4899;--text:#f1f0ff;--muted:#6b6b8a;--border:rgba(124,58,237,.2);}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;}
body::before{content:'';position:absolute;width:600px;height:600px;background:radial-gradient(circle,rgba(124,58,237,.15) 0%,transparent 70%);top:-200px;left:-200px;}
body::after{content:'';position:absolute;width:400px;height:400px;background:radial-gradient(circle,rgba(236,72,153,.1) 0%,transparent 70%);bottom:-100px;right:-100px;}
.wrap{width:420px;max-width:94vw;position:relative;z-index:1;}
.brand{text-align:center;margin-bottom:32px;}
.brand h1{font-family:'Bebas Neue',sans-serif;font-size:48px;letter-spacing:3px;background:linear-gradient(135deg,#a855f7,#ec4899);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.brand p{color:var(--muted);font-size:14px;margin-top:4px;}
.card{background:var(--card);border:1px solid var(--border);border-radius:20px;padding:36px;}
.tabs{display:flex;gap:4px;background:rgba(255,255,255,.04);border-radius:10px;padding:4px;margin-bottom:28px;}
.tab{flex:1;padding:9px;border:none;border-radius:7px;background:transparent;font-family:'DM Sans',sans-serif;font-size:14px;font-weight:500;cursor:pointer;color:var(--muted);transition:all .2s;}
.tab.active{background:var(--purple);color:white;}
.form-group{margin-bottom:16px;}
.form-group label{display:block;font-size:11px;font-weight:600;color:var(--muted);margin-bottom:6px;text-transform:uppercase;letter-spacing:.06em;}
.form-control{width:100%;padding:11px 14px;background:rgba(255,255,255,.06);border:1px solid var(--border);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:var(--text);outline:none;transition:border-color .2s;}
.form-control:focus{border-color:var(--purple);}
.form-control.is-invalid{border-color:var(--pink);}
.invalid-feedback{color:var(--pink);font-size:12px;margin-top:4px;}
.btn-submit{width:100%;padding:13px;background:linear-gradient(135deg,var(--purple),var(--purple-light));color:white;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:15px;font-weight:600;cursor:pointer;transition:all .2s;margin-top:4px;letter-spacing:.5px;}
.btn-submit:hover{opacity:.85;transform:translateY(-1px);}
.link{text-align:center;font-size:13px;color:var(--muted);margin-top:16px;}
.link a{color:var(--purple-light);}
.alert-success{background:rgba(124,58,237,.1);border:1px solid rgba(124,58,237,.3);color:#c4b5fd;padding:10px 14px;border-radius:10px;font-size:13px;margin-bottom:16px;}
.hint{margin-top:16px;padding:12px;background:rgba(255,255,255,.03);border-radius:8px;font-size:11px;color:var(--muted);line-height:1.8;text-align:center;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
@media(max-width:480px){.form-row{grid-template-columns:1fr;}}
</style>
</head>
<body>
<div class="wrap">
  <div class="brand">
    <h1>🎵 StagePass</h1>
    <p>Your gateway to unforgettable concerts</p>
  </div>
  <div class="card">
    <div class="tabs">
      <button class="tab active" onclick="switchTab('login',this)">Masuk</button>
      <button class="tab" onclick="switchTab('register',this)">Daftar</button>
    </div>

    {{-- LOGIN --}}
    <div id="form-login">
      @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif
      @if($errors->any() && old('_form','login') === 'login')
        <div style="background:rgba(236,72,153,.1);border:1px solid rgba(236,72,153,.3);color:#f9a8d4;padding:10px 14px;border-radius:10px;font-size:13px;margin-bottom:16px;">{{ $errors->first() }}</div>
      @endif
      <form method="POST" action="{{ route('login') }}">
        @csrf <input type="hidden" name="_form" value="login">
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" placeholder="email@kamu.com" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn-submit">MASUK</button>
      </form>
      <div class="hint">
        <strong>Demo:</strong><br>
        Admin → admin@stagepass.com / admin123<br>
        Customer → user@stagepass.com / user123
      </div>
      <div class="link">Belum punya akun? <a href="#" onclick="switchTab('register',null)">Daftar</a></div>
    </div>

    {{-- REGISTER --}}
    <div id="form-register" style="display:none">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
          <label>Nama Lengkap</label>
          <input type="text" name="name" class="form-control {{ $errors->has('name')?'is-invalid':'' }}" placeholder="Nama kamu" value="{{ old('name') }}" required>
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control {{ $errors->has('email')?'is-invalid':'' }}" placeholder="email@kamu.com" value="{{ old('email') }}" required>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label>No. HP</label>
            <input type="tel" name="phone" class="form-control {{ $errors->has('phone')?'is-invalid':'' }}" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" required>
            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control {{ $errors->has('password')?'is-invalid':'' }}" placeholder="Min. 6 karakter" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
          <div class="form-group">
            <label>Konfirmasi</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
          </div>
        </div>
        <button type="submit" class="btn-submit">BUAT AKUN</button>
      </form>
      <div class="link">Sudah punya akun? <a href="#" onclick="switchTab('login',null)">Masuk</a></div>
    </div>
  </div>
</div>
<script>
function switchTab(tab, el) {
  document.getElementById('form-login').style.display = tab==='login' ? '' : 'none';
  document.getElementById('form-register').style.display = tab==='register' ? '' : 'none';
  document.querySelectorAll('.tab').forEach((b,i) => b.classList.toggle('active',(i===0&&tab==='login')||(i===1&&tab==='register')));
}
@if($errors->any() && old('_form') !== 'login') switchTab('register',null); @endif
</script>
</body>
</html>
