@extends('layouts.app')
@section('title','Konser')
@section('nav')
  <a href="{{ route('concerts.index') }}" class="{{ request()->routeIs('concerts.*')?'active':'' }}">🎵 Konser</a>
  <a href="{{ route('tickets.index') }}" class="{{ request()->routeIs('tickets.*')?'active':'' }}">🎟️ Tiket Saya</a>
@endsection

@push('styles')
<style>
.hero{background:linear-gradient(135deg,rgba(124,58,237,.3) 0%,rgba(236,72,153,.2) 100%);
  border:1px solid rgba(124,58,237,.2);border-radius:20px;padding:40px;margin-bottom:36px;position:relative;overflow:hidden;}
.hero::before{content:'🎵';position:absolute;right:40px;top:50%;transform:translateY(-50%);font-size:100px;opacity:.08;}
.hero h2{font-family:'Bebas Neue',sans-serif;font-size:36px;letter-spacing:1px;margin-bottom:6px;}
.hero p{color:#a0a0c0;font-size:14px;}
.search-bar{display:flex;gap:10px;margin-bottom:28px;flex-wrap:wrap;}
.search-input{flex:1;min-width:200px;padding:11px 16px;background:rgba(255,255,255,.06);
  border:1px solid rgba(124,58,237,.2);border-radius:10px;font-family:'DM Sans',sans-serif;
  font-size:14px;color:#f1f0ff;outline:none;}
.search-input:focus{border-color:#7c3aed;}
.search-btn{padding:11px 22px;background:linear-gradient(135deg,#7c3aed,#a855f7);
  color:white;border:none;border-radius:10px;cursor:pointer;font-weight:600;font-family:'DM Sans',sans-serif;}
.search-btn:hover{opacity:.85;}
.concerts-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;}
.concert-card{border-radius:16px;overflow:hidden;border:1px solid rgba(124,58,237,.15);
  background:#1a1a26;transition:all .3s;cursor:pointer;}
.concert-card:hover{transform:translateY(-6px);border-color:rgba(124,58,237,.4);
  box-shadow:0 20px 40px rgba(124,58,237,.2);}
.concert-poster{height:200px;display:flex;align-items:center;justify-content:center;
  font-size:72px;position:relative; overflow: hidden;} /* Added overflow:hidden for images */
.concert-poster-overlay{position:absolute;bottom:0;left:0;right:0;
  background:linear-gradient(to top,rgba(10,10,15,.9),transparent);padding:16px;}
.concert-poster-date{font-size:12px;font-weight:600;color:rgba(255,255,255,.7);
  background:rgba(0,0,0,.4);display:inline-block;padding:3px 10px;border-radius:20px;}
.concert-body{padding:18px;}
.concert-artist{font-size:11px;font-weight:600;color:#a855f7;text-transform:uppercase;letter-spacing:.1em;margin-bottom:4px;}
.concert-title{font-family:'Bebas Neue',sans-serif;font-size:22px;letter-spacing:.5px;margin-bottom:8px;line-height:1.1;}
.concert-meta{display:flex;gap:12px;font-size:12px;color:#6b6b8a;margin-bottom:12px;flex-wrap:wrap;}
.concert-footer{display:flex;align-items:center;justify-content:space-between;}
.concert-price{font-size:18px;font-weight:700;color:#a855f7;}
.concert-price span{font-size:11px;font-weight:400;color:#6b6b8a;}
.btn-book{padding:8px 18px;background:linear-gradient(135deg,#7c3aed,#a855f7);
  color:white;border:none;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;}
.btn-book:hover{opacity:.85;}
.btn-soldout{padding:8px 18px;background:rgba(236,72,153,.1);color:#f9a8d4;
  border:1px solid rgba(236,72,153,.3);border-radius:8px;font-size:13px;font-weight:600;cursor:not-allowed;font-family:'DM Sans',sans-serif;}
.ticket-stock{font-size:11px;color:#6b6b8a;margin-bottom:10px;}
.stock-bar{height:3px;background:rgba(255,255,255,.1);border-radius:2px;margin-top:3px;}
.stock-fill{height:100%;border-radius:2px;background:linear-gradient(90deg,#7c3aed,#ec4899);}
.empty{text-align:center;padding:80px;color:#6b6b8a;}
.empty .icon{font-size:56px;display:block;margin-bottom:12px;}

/* Tambahan untuk memperbaiki warna background dropdown opsi genre */
select option {
  background-color: #1a1a26;
  color: #f1f0ff;
}
</style>
@endpush

@section('content')
<div class="hero">
  <h2>Grab Your Tickets Now 🎟️</h2>
  <p>Discover top concerts from local and international artists.</p>
</div>

<form method="GET" action="{{ route('concerts.index') }}" class="search-bar">
  <input class="search-input" type="text" name="search" placeholder="🔍  Cari artis atau konser..." value="{{ request('search') }}">
  <select name="genre" class="search-input" style="max-width:180px;">
    <option value="">Semua Genre</option>
    @foreach(['Pop','Hip-Hop / Rap','R&B / Pop','K-Pop','Alternative / Pop','Rock'] as $g)
      <option value="{{ $g }}" {{ request('genre')===$g?'selected':'' }}>{{ $g }}</option>
    @endforeach
  </select>
  <button type="submit" class="search-btn">Cari</button>
  @if(request('search') || request('genre'))
    <a href="{{ route('concerts.index') }}" style="padding:11px 16px;color:#6b6b8a;font-size:13px;display:flex;align-items:center;">✕ Reset</a>
  @endif
</form>

@if($concerts->isEmpty())
  <div class="empty"><span class="icon">🎵</span>Tidak ada konser ditemukan.</div>
@else
<div class="concerts-grid">
  @foreach($concerts as $c)
  <div class="concert-card" onclick="window.location='{{ route('concerts.show',$c) }}'">
    {{-- BAGIAN POSTER SUDAH DIPERBARUI --}}
    <div class="concert-poster" style="background:linear-gradient(135deg,{{ $c->bg_color }}88,{{ $c->bg_color }}22);">
        @if($c->poster_image)
            <img src="{{ asset('storage/' . $c->poster_image) }}" alt="{{ $c->title }}" style="width:100%; height:100%; object-fit:cover;">
        @else
            {{ $c->poster_emoji }}
        @endif

        <div class="concert-poster-overlay">
            <span class="concert-poster-date">📅 {{ \Carbon\Carbon::parse($c->event_date)->format('d M Y') }}</span>
        </div>
    </div>

    <div class="concert-body">
      <div class="concert-artist">{{ $c->artist }}</div>
      <div class="concert-title">{{ $c->title }}</div>
      <div class="concert-meta">
        <span>📍 {{ $c->venue }}, {{ $c->city }}</span>
        <span>🕐 {{ \Carbon\Carbon::parse($c->event_time)->format('H:i') }} WIB</span>
        @if($c->genre) <span>🎸 {{ $c->genre }}</span> @endif
      </div>
      <div class="ticket-stock">
        Tiket tersisa: <strong style="color:{{ $c->available < 100 ? '#f9a8d4' : '#c4b5fd' }}">{{ number_format($c->available) }}</strong> / {{ number_format($c->quota) }}
        <div class="stock-bar"><div class="stock-fill" style="width:{{ ($c->sold/$c->quota)*100 }}%"></div></div>
      </div>
      <div class="concert-footer">
        <div class="concert-price">Rp {{ number_format($c->price,0,',','.') }} <span>/tiket</span></div>
        @if($c->is_full)
          <button class="btn-soldout" disabled>Sold Out</button>
        @else
          <a href="{{ route('concerts.show',$c) }}" class="btn-book">Beli Tiket</a>
        @endif
      </div>
    </div>
  </div>
  @endforeach
</div>
@endif
@endsection
