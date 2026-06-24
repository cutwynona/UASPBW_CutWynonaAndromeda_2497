@extends('layouts.app')
@section('title','Users')
@section('nav')
  <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a href="{{ route('admin.concerts.index') }}">🎵 Konser</a>
  <a href="{{ route('admin.orders.index') }}">🎟️ Pesanan</a>
  <a href="{{ route('admin.users') }}" class="active">👥 Users</a>
@endsection

@section('content')
<h2 class="page-title">Manajemen Pengguna</h2>

<div class="card">
  <div class="card-header"><h3>Semua Pengguna ({{ $users->count() }})</h3></div>
  <table>
    <thead><tr><th>Nama</th><th>Email</th><th>No. HP</th><th>Role</th><th>Bergabung</th><th>Aksi</th></tr></thead>
    <tbody>
      @foreach($users as $u)
      <tr>
        <td><strong>{{ $u->name }}</strong></td>
        <td style="font-size:13px;color:#a0a0c0;">{{ $u->email }}</td>
        <td style="font-size:13px;color:#6b6b8a;">{{ $u->phone ?? '-' }}</td>
        <td><span class="badge badge-{{ $u->role }}">{{ $u->role === 'admin' ? '🔑 Admin' : '👤 Customer' }}</span></td>
        <td style="font-size:12px;color:#6b6b8a;">{{ $u->created_at->format('d M Y') }}</td>
        <td>
          @if($u->id !== Auth::id())
            <form method="POST" action="{{ route('admin.users.delete',$u) }}" onsubmit="return confirm('Hapus pengguna {{ $u->name }}?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-sm btn-delete">Hapus</button>
            </form>
          @else
            <span style="font-size:12px;color:#6b6b8a;">— (kamu)</span>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
