@extends('layouts.app')
@section('title', $concert->title)
@section('nav')
  <a href="{{ route('concerts.index') }}">🎵 Konser</a>
  <a href="{{ route('tickets.index') }}">🎟️ Tiket Saya</a>
@endsection

@push('styles')
<style>
/* Modifikasi pada detail-hero */
.detail-hero{
  border-radius:20px;
  overflow:hidden;
  margin-bottom:28px;
  background:linear-gradient(135deg,{{ $concert->bg_color }}66,{{ $concert->bg_color }}11);
  border:1px solid rgba(124,58,237,.2);
  padding:48px;
  display:flex;
  gap:40px;
  align-items:center;
  position: relative;
}

/* Overlay diperkuat blurnya agar jadi ambient color saja */
.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(15, 15, 25, 0.5); /* Sedikit lebih transparan agar warna aslinya keluar */
  backdrop-filter: blur(30px); /* Blur diperbesar drastis */
  -webkit-backdrop-filter: blur(30px);
  z-index: 1;
}

/* Styling untuk poster tajam di bagian depan */
.detail-poster-img {
  width: 260px;
  height: 180px; /* Disesuaikan agar proporsional memanjang (landscape) */
  object-fit: cover;
  border-radius: 16px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.6); /* Efek bayangan biar pop-up */
  position: relative;
  z-index: 2;
  flex-shrink: 0;
}

.detail-info {
  position: relative;
  z-index: 2;
}

.detail-artist{font-size:12px;font-weight:600;color:#a855f7;text-transform:uppercase;letter-spacing:.1em;margin-bottom:6px;}
.detail-title{font-family:'Bebas Neue',sans-serif;font-size:48px;letter-spacing:1px;line-height:1;margin-bottom:16px;}
.detail-meta{display:flex;gap:16px;flex-wrap:wrap;font-size:13px;color:#a0a0c0;}
.detail-meta span{display:flex;align-items:center;gap:5px;}

.detail-body{display:grid;grid-template-columns:1fr 340px;gap:24px;}
.detail-desc{background:#1a1a26;border:1px solid rgba(124,58,237,.15);border-radius:16px;padding:24px;}
.detail-desc h3{font-size:14px;font-weight:600;color:#6b6b8a;text-transform:uppercase;letter-spacing:.06em;margin-bottom:12px;}
.detail-desc p{color:#c0c0d8;font-size:14px;line-height:1.7;}

.buy-card{background:#1a1a26;border:1px solid rgba(124,58,237,.3);border-radius:16px;padding:24px;position:sticky;top:80px;}
.buy-price{font-family:'Bebas Neue',sans-serif;font-size:36px;color:#a855f7;margin-bottom:4px;}
.buy-price-sub{font-size:12px;color:#6b6b8a;margin-bottom:20px;}
.qty-wrap{margin-bottom:16px;}
.qty-wrap label{font-size:11px;font-weight:600;color:#6b6b8a;text-transform:uppercase;letter-spacing:.06em;display:block;margin-bottom:8px;}
.qty-input{width:100%;padding:11px 14px;background:rgba(255,255,255,.06);border:1px solid rgba(124,58,237,.2);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;color:#f1f0ff;outline:none;}
.qty-input:focus{border-color:#7c3aed;}
.total-row{display:flex;justify-content:space-between;font-size:14px;padding:12px 0;border-top:1px solid rgba(255,255,255,.06);margin-bottom:16px;}
.total-row strong{color:#a855f7;font-size:18px;}
.btn-buy{width:100%;padding:14px;background:linear-gradient(135deg,#7c3aed,#ec4899);
  color:white;border:none;border-radius:12px;font-family:'DM Sans',sans-serif;
  font-size:16px;font-weight:700;cursor:pointer;transition:all .2s;letter-spacing:.5px;}
.btn-buy:hover{opacity:.85;transform:translateY(-1px);}
.stock-info{font-size:12px;color:#6b6b8a;text-align:center;margin-top:10px;}
.stock-bar{height:4px;background:rgba(255,255,255,.08);border-radius:2px;margin:8px 0;}
.stock-fill{height:100%;border-radius:2px;background:linear-gradient(90deg,#7c3aed,#ec4899);}

@media(max-width:768px){
  .detail-body{grid-template-columns:1fr;}
  .detail-hero{flex-direction:column;text-align:center;padding:28px;}
  .detail-title{font-size:36px;}
}
</style>
@endpush

@section('content')
<a href="{{ route('concerts.index') }}" style="display:inline-flex;align-items:center;gap:6px;color:#6b6b8a;font-size:13px;margin-bottom:20px;">← Kembali</a>

<div class="detail-hero" @if($concert->poster_image) style="background-image: url('{{ asset('storage/' . $concert->poster_image) }}'); background-size: cover; background-position: center;" @endif>

  @if($concert->poster_image)
    <div class="hero-overlay"></div>
    {{-- Memunculkan gambar aslinya di depan --}}
    <img src="{{ asset('storage/' . $concert->poster_image) }}" alt="{{ $concert->title }}" class="detail-poster-img">
@endif

  <div class="detail-info">
    <div class="detail-artist">{{ $concert->artist }}</div>
    <div class="detail-title">{{ $concert->title }}</div>
    <div class="detail-meta">
      <span>📅 {{ \Carbon\Carbon::parse($concert->event_date)->translatedFormat('d F Y') }}</span>
      <span>🕐 {{ \Carbon\Carbon::parse($concert->event_time)->format('H:i') }} WIB</span>
      <span>📍 {{ $concert->venue }}, {{ $concert->city }}</span>
      @if($concert->genre) <span>🎸 {{ $concert->genre }}</span> @endif
    </div>
  </div>
</div>

<div class="detail-body">
  <div class="detail-desc">
    <h3>Tentang Konser</h3>
    <p>{{ $concert->description ?? 'Informasi konser akan segera tersedia.' }}</p>
    <br>
    <h3 style="margin-top:8px">Informasi Venue</h3>
    <p>📍 {{ $concert->venue }}<br>{{ $concert->city }}, Indonesia</p>
  </div>

  <div class="buy-card">
    <div class="buy-price">Rp {{ number_format($concert->price,0,',','.') }}</div>
    <div class="buy-price-sub">per tiket</div>

    @if($concert->is_full)
      <div style="text-align:center;padding:20px;color:#f9a8d4;background:rgba(236,72,153,.1);border-radius:10px;font-weight:600;">😢 Tiket Sold Out</div>
    @else
      <form method="GET" action="{{ route('orders.create', $concert->id) }}">
        <div class="qty-wrap">
          <label>Jumlah Tiket</label>
          <input type="number" id="qty" class="qty-input" min="1" max="{{ min(10,$concert->available) }}" value="1">
          <input type="hidden" name="qty" id="qty-input" value="1">
        </div>
        <button type="submit" class="btn-buy">🎟️ BELI TIKET</button>
      </form>
    @endif

    <div class="stock-info">
      Tersisa <strong style="color:#c4b5fd">{{ number_format($concert->available) }}</strong> dari {{ number_format($concert->quota) }} tiket
      <div class="stock-bar"><div class="stock-fill" style="width:{{ ($concert->sold/$concert->quota)*100 }}%"></div></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('qty').addEventListener('change', function() {
        document.getElementById('qty-input').value = this.value;
    });
</script>
@endpush
