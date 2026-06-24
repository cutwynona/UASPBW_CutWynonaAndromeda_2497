@extends('layouts.app')
@section('title','Admin Dashboard')
@section('nav')
  <a href="{{ route('admin.dashboard') }}" class="active">📊 Dashboard</a>
  <a href="{{ route('admin.concerts.index') }}">🎵 Konser</a>
  <a href="{{ route('admin.orders.index') }}">🎟️ Pesanan</a>
  <a href="{{ route('admin.users') }}">👥 Users</a>
@endsection

@push('styles')
<style>
.stats{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;margin-bottom:28px;}
.stat{background:#1a1a26;border:1px solid rgba(124,58,237,.15);border-radius:14px;padding:22px;position:relative;overflow:hidden;}
.stat::before{content:attr(data-icon);position:absolute;right:16px;top:16px;font-size:28px;opacity:.3;}
.stat-label{font-size:11px;text-transform:uppercase;letter-spacing:.08em;color:#6b6b8a;margin-bottom:8px;}
.stat-val{font-family:'Bebas Neue',sans-serif;font-size:36px;letter-spacing:1px;background:linear-gradient(135deg,#f1f0ff,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;}
.stat-sub{font-size:12px;color:#6b6b8a;margin-top:4px;}
</style>
@endpush

@section('content')
<h2 class="page-title">Dashboard Admin</h2>

<div class="stats">
  <div class="stat" data-icon="🎵">
    <div class="stat-label">Total Konser</div>
    <div class="stat-val">{{ $totalConcerts }}</div>
    <div class="stat-sub">Event terdaftar</div>
  </div>
  <div class="stat" data-icon="🎟️">
    <div class="stat-label">Total Pesanan</div>
    <div class="stat-val">{{ $totalOrders }}</div>
    <div class="stat-sub">Semua waktu</div>
  </div>
  <div class="stat" data-icon="💰">
    <div class="stat-label">Pendapatan</div>
    <div class="stat-val" style="font-size:22px;">Rp {{ number_format($totalRevenue,0,',','.') }}</div>
    <div class="stat-sub">Tiket confirmed</div>
  </div>
  <div class="stat" data-icon="👥">
    <div class="stat-label">Pengguna</div>
    <div class="stat-val">{{ $totalUsers }}</div>
    <div class="stat-sub">Customer terdaftar</div>
  </div>
</div>

<div class="card">
  <div class="card-header"><h3>Pesanan Terbaru</h3></div>
  <table>
    <thead><tr><th>Kode</th><th>Pembeli</th><th>Konser</th><th>Qty</th><th>Total</th><th>Status</th></tr></thead>
    <tbody>
      @foreach($recentOrders as $o)
      <tr>
        <td><span style="font-family:monospace;color:#a855f7;font-size:12px;">{{ $o->ticket_code }}</span></td>
        <td>{{ $o->user->name }}</td>
        <td style="max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
          {{ $o->concert->poster_emoji }} {{ $o->concert->title }}
        </td>
        <td>{{ $o->qty }}x</td>
        <td>Rp {{ number_format($o->total_price,0,',','.') }}</td>
        <td><span class="badge badge-{{ $o->status }}">{{ $o->status_label }}</span></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
