@extends('layouts.app')
@section('title','Manajemen Pesanan')
@section('nav')
  <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a href="{{ route('admin.concerts.index') }}">🎵 Konser</a>
  <a href="{{ route('admin.orders.index') }}" class="active">🎟️ Pesanan</a>
  <a href="{{ route('admin.users') }}">👥 Users</a>
@endsection

@section('content')
<h2 class="page-title">Manajemen Pesanan</h2>

<div class="card">
  <div class="card-header">
    <h3>Semua Pesanan ({{ $orders->count() }})</h3>
  </div>
  <table>
    <thead>
      <tr>
        <th>Kode</th>
        <th>Pembeli</th>
        <th>Konser</th>
        <th>Qty</th>
        <th>Total</th>
        <th>Tgl Pesan</th>
        <th>Status / Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $o)
      <tr>
        <td><span style="font-family:monospace;color:#a855f7;font-size:11px;">{{ $o->ticket_code }}</span></td>
        <td>
          <strong style="font-size:13px;">{{ $o->user->name }}</strong><br>
          <span style="font-size:11px;color:#6b6b8a;">{{ $o->user->email }}</span>
        </td>
        <td style="max-width:180px;">
          <span style="font-size:16px;">{{ $o->concert->poster_emoji }}</span>
          <span style="font-size:12px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;display:inline-block;max-width:140px;vertical-align:middle;">{{ $o->concert->title }}</span>
        </td>
        <td>{{ $o->qty }}x</td>
        <td style="font-size:13px;font-weight:600;color:#a855f7;">Rp {{ number_format($o->total_price,0,',','.') }}</td>
        <td style="font-size:11px;color:#6b6b8a;">{{ $o->created_at->format('d M Y') }}</td>
        <td>
            @if($o->status === 'pending')
                <div style="display:flex; gap:6px;">
                    <form method="POST" action="{{ route('admin.orders.confirm', $o->id) }}">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-purple btn-sm">Konfirmasi</button>
                    </form>

                    <form method="POST" action="{{ route('admin.orders.status', $o) }}">
                        @csrf @method('PATCH')
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-delete btn-sm">Batal</button>
                    </form>
                </div>
            @else
                <span class="badge {{ $o->status_class }}">{{ $o->status_label }}</span>
            @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
