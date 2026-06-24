@extends('layouts.app')
@section('title','Kelola Konser')
@section('nav')
  <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a href="{{ route('admin.concerts.index') }}" class="active">🎵 Konser</a>
  <a href="{{ route('admin.orders.index') }}">🎟️ Pesanan</a>
  <a href="{{ route('admin.users') }}">👥 Users</a>
@endsection

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
  <h2 class="page-title" style="margin-bottom:0">Kelola Konser</h2>
  <a href="{{ route('admin.concerts.create') }}" class="btn btn-purple">+ Tambah Konser</a>
</div>

<div class="card">
  <table>
    <thead><tr><th></th><th>Konser</th><th>Tanggal</th><th>Harga</th><th>Tiket</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($concerts as $c)
      <tr>
        <td style="width: 60px;">
          @if($c->poster_image)
            <img src="{{ asset('storage/' . $c->poster_image) }}" style="width:40px; height:40px; object-fit:cover; border-radius:6px;">
          @else
            <span style="font-size:28px">{{ $c->poster_emoji }}</span>
          @endif
        </td>

        <td>
          <strong style="display:block">{{ $c->title }}</strong>
          <span style="font-size:11px;color:#6b6b8a;">{{ $c->artist }} · {{ $c->venue }}</span>
        </td>
        <td style="font-size:12px">{{ \Carbon\Carbon::parse($c->event_date)->format('d M Y') }}</td>
        <td>Rp {{ number_format($c->price,0,',','.') }}</td>
        <td style="font-size:12px">{{ $c->sold }}/{{ $c->quota }}</td>
        <td>
          @if(!$c->is_active) <span class="badge" style="background:rgba(255,255,255,.08);color:#6b6b8a">Nonaktif</span>
          @elseif($c->is_full) <span class="badge badge-cancelled">Sold Out</span>
          @else <span class="badge badge-available">Tersedia</span> @endif
        </td>
        <td style="display:flex;gap:6px;padding:12px 16px;">
          <a href="{{ route('admin.concerts.edit',$c) }}" class="btn btn-sm btn-edit">Edit</a>
          <form method="POST" action="{{ route('admin.concerts.destroy',$c) }}" onsubmit="return confirm('Hapus konser ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-delete">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
