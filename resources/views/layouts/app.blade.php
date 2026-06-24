<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title','StagePass') — StagePass</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
:root{
  --bg:#0a0a0f; --surface:#13131a; --card:#1a1a26;
  --purple:#7c3aed; --purple-light:#a855f7; --purple-dim:#3b1c6e;
  --pink:#ec4899; --gold:#f59e0b;
  --text:#f1f0ff; --muted:#6b6b8a; --border:rgba(124,58,237,.2);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
a{color:inherit;text-decoration:none;}

.header{background:rgba(10,10,15,.9);backdrop-filter:blur(20px);
  border-bottom:1px solid var(--border);padding:0 24px;height:64px;
  display:flex;align-items:center;justify-content:space-between;
  position:sticky;top:0;z-index:100;}
.header-brand{font-family:'Bebas Neue',sans-serif;font-size:28px;letter-spacing:2px;
  background:linear-gradient(135deg,#a855f7,#ec4899);-webkit-background-clip:text;
  -webkit-text-fill-color:transparent;}
.header-right{display:flex;align-items:center;gap:16px;}
.header-user{font-size:13px;color:var(--muted);}
.btn-logout{background:rgba(124,58,237,.15);border:1px solid var(--border);color:var(--purple-light);
  padding:7px 16px;border-radius:20px;cursor:pointer;font-size:13px;font-family:'DM Sans',sans-serif;
  transition:all .2s;}
.btn-logout:hover{background:rgba(124,58,237,.3);}

.nav{background:var(--surface);border-bottom:1px solid var(--border);display:flex;overflow-x:auto;}
.nav a{padding:14px 22px;color:var(--muted);font-size:13px;font-weight:500;
  border-bottom:2px solid transparent;white-space:nowrap;transition:all .2s;}
.nav a:hover{color:var(--text);}
.nav a.active{color:var(--purple-light);border-bottom-color:var(--purple);}

.container{max-width:1100px;margin:0 auto;padding:32px 24px;}

/* Alerts */
.alert{padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:14px;border:1px solid;}
.alert-success{background:rgba(124,58,237,.1);border-color:rgba(124,58,237,.3);color:#c4b5fd;}
.alert-error{background:rgba(236,72,153,.1);border-color:rgba(236,72,153,.3);color:#f9a8d4;}

/* Cards */
.card{background:var(--card);border:1px solid var(--border);border-radius:16px;overflow:hidden;}
.card-header{padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;}
.card-header h3{font-size:16px;font-weight:600;}
.card-body{padding:22px;}

/* Buttons */
.btn{padding:10px 22px;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;
  font-weight:500;cursor:pointer;border:none;transition:all .2s;display:inline-block;text-align:center;}
.btn-purple{background:linear-gradient(135deg,var(--purple),var(--purple-light));color:white;}
.btn-purple:hover{opacity:.85;transform:translateY(-1px);}
.btn-pink{background:linear-gradient(135deg,#be185d,var(--pink));color:white;}
.btn-outline{background:transparent;border:1px solid var(--border);color:var(--muted);}
.btn-outline:hover{border-color:var(--purple);color:var(--purple-light);}
.btn-sm{padding:5px 14px;font-size:12px;border-radius:7px;}
.btn-edit{border:1px solid rgba(245,158,11,.4);color:var(--gold);background:transparent;}
.btn-edit:hover{background:rgba(245,158,11,.1);}
.btn-delete{border:1px solid rgba(236,72,153,.4);color:var(--pink);background:transparent;}
.btn-delete:hover{background:rgba(236,72,153,.1);}

/* Forms */
.form-group{margin-bottom:16px;}
.form-group label{display:block;font-size:11px;font-weight:600;color:var(--muted);
  margin-bottom:6px;text-transform:uppercase;letter-spacing:.06em;}
.form-control{width:100%;padding:11px 14px;background:rgba(255,255,255,.05);
  border:1px solid var(--border);border-radius:10px;
  font-family:'DM Sans',sans-serif;font-size:14px;color:var(--text);outline:none;
  transition:border-color .2s;}
.form-control:focus{border-color:var(--purple);}
.form-control.is-invalid{border-color:var(--pink);}
.invalid-feedback{color:var(--pink);font-size:12px;margin-top:4px;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;}
select.form-control option{background:var(--card);}

/* Table */
table{width:100%;border-collapse:collapse;}
th{background:rgba(124,58,237,.08);padding:10px 16px;text-align:left;
  font-size:11px;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);}
td{padding:13px 16px;font-size:13px;border-bottom:1px solid rgba(255,255,255,.04);}
tr:last-child td{border-bottom:none;}
tr:hover td{background:rgba(124,58,237,.04);}

/* Badges */
.badge{display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;}
.badge-pending{background:rgba(245,158,11,.15);color:#fbbf24;}
.badge-confirmed{background:rgba(124,58,237,.2);color:#c4b5fd;}
.badge-cancelled{background:rgba(236,72,153,.15);color:#f9a8d4;}
.badge-available{background:rgba(52,211,153,.15);color:#6ee7b7;}
.badge-soldout{background:rgba(236,72,153,.15);color:#f9a8d4;}
.badge-almost{background:rgba(245,158,11,.15);color:#fbbf24;}
.badge-admin{background:rgba(245,158,11,.15);color:#fbbf24;}
.badge-customer{background:rgba(124,58,237,.15);color:#c4b5fd;}

.page-title{font-family:'Bebas Neue',sans-serif;font-size:32px;letter-spacing:1px;margin-bottom:24px;
  background:linear-gradient(135deg,#f1f0ff,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}

@media(max-width:640px){.form-row{grid-template-columns:1fr;}.container{padding:16px;}}
</style>
@stack('styles')
</head>
<body>
<<header class="header">
  <div class="header-brand">🎵 StagePass</div>
  <div class="header-right">
    <a href="{{ route('profile.edit') }}" style="color:var(--muted); font-size:13px; margin-right:10px; transition:color .2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--muted)'">
      👤 Profil
    </a>

    <span class="header-user">{{ Auth::user()->name }}</span>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="btn-logout">Keluar</button>
    </form>
  </div>
</header>
<nav class="nav">@yield('nav')</nav>
<div class="container">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
  @endif
  @yield('content')
</div>
@stack('scripts')
</body>
</html>
