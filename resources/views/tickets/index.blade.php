@extends('layouts.app')
@section('title','Tiket Saya')
@section('nav')
  <a href="{{ route('concerts.index') }}">🎵 Konser</a>
  <a href="{{ route('tickets.index') }}" class="active">🎟️ Tiket Saya</a>
@endsection

@push('styles')
<style>
.tickets-grid{display:flex;flex-direction:column;gap:16px;}
.ticket-card{display:flex;border-radius:16px;overflow:hidden;border:1px solid rgba(124,58,237,.2);background:#1a1a26;transition:all .2s;}
.ticket-card:hover{border-color:rgba(124,58,237,.4);}
.ticket-left{width:160px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:56px;position:relative;overflow:hidden;}
.ticket-left::after{content:'';position:absolute;right:0;top:10%;height:80%;width:1px;background:repeating-linear-gradient(to bottom,rgba(255,255,255,.15) 0px,rgba(255,255,255,.15) 6px,transparent 6px,transparent 12px); z-index:1;}
.ticket-body{flex:1;padding:20px 24px;display:flex;gap:20px;align-items:center;}
.ticket-info{flex:1;}
.ticket-code{font-size:11px;font-weight:700;letter-spacing:.12em;color:#6b6b8a;margin-bottom:4px;}
.ticket-title{font-family:'Bebas Neue',sans-serif;font-size:22px;letter-spacing:.5px;margin-bottom:2px;}
.ticket-artist{font-size:12px;color:#a855f7;font-weight:600;margin-bottom:8px;}
.ticket-meta{font-size:12px;color:#6b6b8a;line-height:1.8;}
.ticket-right{display:flex;flex-direction:column;align-items:flex-end;gap:8px;padding:20px;}
.ticket-price{font-weight:700;color:#a855f7;font-size:16px;white-space:nowrap;}
.ticket-qty{font-size:12px;color:#6b6b8a;}
.ticket-actions{display:flex;gap:8px;margin-top:4px;}
.btn-view{padding:6px 14px;background:rgba(124,58,237,.15);border:1px solid rgba(124,58,237,.3);color:#c4b5fd;border-radius:7px;font-size:12px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;}
.btn-cancel{padding:6px 14px;background:rgba(236,72,153,.1);border:1px solid rgba(236,72,153,.3);color:#f9a8d4;border-radius:7px;font-size:12px;font-weight:600;cursor:pointer;font-family:'DM Sans',sans-serif;}
.empty{text-align:center;padding:80px;color:#6b6b8a;}

/* Badge Styles */
.badge { padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.badge-pending { background: rgba(245, 158, 11, 0.15); color: #fbbf24; }
.badge-confirmed { background: rgba(52, 211, 153, 0.15); color: #6ee7b7; }
.badge-cancelled { background: rgba(236, 72, 153, 0.15); color: #f9a8d4; }
</style>
@endpush

@section('content')
<h2 class="page-title">Tiket Saya 🎟️</h2>

@if($orders->isEmpty())
  <div class="empty">
    <div style="font-size:56px;margin-bottom:12px;">🎟️</div>
    <p>Belum ada tiket. <a href="{{ route('concerts.index') }}" style="color:#a855f7;">Beli tiket sekarang →</a></p>
  </div>
@else
<div class="tickets-grid">
  @foreach($orders as $o)
  <div class="ticket-card">
    <div class="ticket-left" style="background:linear-gradient(135deg,{{ $o->concert->bg_color }}44,{{ $o->concert->bg_color }}11);">
      @if($o->concert->poster_image)
        <img src="{{ asset('storage/' . $o->concert->poster_image) }}" style="width:100%; height:100%; object-fit:cover;">
      @else
        {{ $o->concert->poster_emoji }}
      @endif
    </div>

    <div class="ticket-body">
      <div class="ticket-info">
        <div class="ticket-code">{{ $o->ticket_code }}</div>
        <div class="ticket-title">{{ $o->concert->title }}</div>
        <div class="ticket-artist">{{ $o->concert->artist }}</div>
        <div class="ticket-meta">
          📅 {{ \Carbon\Carbon::parse($o->concert->event_date)->format('d M Y') }} &nbsp;·&nbsp;
          📍 {{ $o->concert->venue }}, {{ $o->concert->city }}<br>
          🕐 {{ \Carbon\Carbon::parse($o->concert->event_time)->format('H:i') }} WIB
        </div>
      </div>
      <div class="ticket-right">
        <span class="badge {{ $o->status_class }}">
            {{ $o->status_label }}
        </span>

        <div class="ticket-price">Rp {{ number_format($o->total_price,0,',','.') }}</div>
        <div class="ticket-qty">{{ $o->qty }} tiket</div>
        <div class="ticket-actions">
          <a href="{{ route('tickets.show',$o) }}" class="btn-view">Lihat</a>

          @if($o->status !== 'cancelled')
          <form method="POST" action="{{ route('tickets.cancel',$o) }}" onsubmit="return confirm('Batalkan tiket ini?')">
            @csrf @method('PATCH')
            <button type="submit" class="btn-cancel">Batal</button>
          </form>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endif
@endsection
