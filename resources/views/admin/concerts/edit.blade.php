@extends('layouts.app')
@section('title','Edit Konser')
@section('nav')
  <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a href="{{ route('admin.concerts.index') }}" class="active">🎵 Konser</a>
  <a href="{{ route('admin.orders.index') }}">🎟️ Pesanan</a>
  <a href="{{ route('admin.users') }}">👥 Users</a>
@endsection

@section('content')
<a href="{{ route('admin.concerts.index') }}" style="display:inline-flex;align-items:center;gap:6px;color:#6b6b8a;font-size:13px;margin-bottom:20px;">← Kembali</a>
<h2 class="page-title">Edit Konser</h2>

<div class="card" style="max-width:700px;">
  <div class="card-body">
    {{-- Tambahkan enctype="multipart/form-data" di sini --}}
    <form method="POST" action="{{ route('admin.concerts.update',$concert) }}" enctype="multipart/form-data">
      @csrf @method('PUT')


      <div class="form-row">
        <div class="form-group">
          <label>Judul Konser</label>
          <input type="text" name="title" class="form-control" value="{{ old('title',$concert->title) }}" required>
        </div>
        <div class="form-group">
          <label>Nama Artis</label>
          <input type="text" name="artist" class="form-control" value="{{ old('artist',$concert->artist) }}" required>
        </div>
      </div>

      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control" rows="3">{{ old('description',$concert->description) }}</textarea>
      </div>

      {{-- Tambahkan Input File di sini --}}
      <div class="form-group">
          <label style="font-weight: bold; display: block; margin-bottom: 8px;">Upload Poster Konser</label>
          <input type="file" name="poster_image" class="search-input">

          @if($concert->poster_image)
              <div style="margin-top: 10px;">
                  <p style="font-size: 12px; color: #6b6b8a;">Foto saat ini:</p>
                  <img src="{{ asset('storage/' . $concert->poster_image) }}" style="width: 100px; border-radius: 8px;">
              </div>
          @endif
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Venue</label>
          <input type="text" name="venue" class="form-control" value="{{ old('venue',$concert->venue) }}" required>
        </div>
        <div class="form-group">
          <label>Kota</label>
          <input type="text" name="city" class="form-control" value="{{ old('city',$concert->city) }}" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Tanggal Event</label>
          <input type="date" name="event_date" class="form-control" value="{{ old('event_date',$concert->event_date) }}" required>
        </div>
        <div class="form-group">
          <label>Jam Mulai</label>
          <input type="time" name="event_time" class="form-control" value="{{ old('event_time',substr($concert->event_time,0,5)) }}" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Harga Tiket (Rp)</label>
          <input type="number" name="price" class="form-control" value="{{ old('price',$concert->price) }}" required>
        </div>
        <div class="form-group">
          <label>Kuota Tiket</label>
          <input type="number" name="quota" class="form-control" value="{{ old('quota',$concert->quota) }}" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Genre</label>
          <input type="text" name="genre" class="form-control" value="{{ old('genre',$concert->genre) }}">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Warna Tema</label>
          <input type="color" name="bg_color" value="{{ old('bg_color',$concert->bg_color) }}" style="width:50px;height:40px;border:none;border-radius:8px;cursor:pointer;">
        </div>
<div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:4px;">
    {{-- Tambahkan input hidden ini --}}
    <input type="hidden" name="is_active" value="0">

    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;text-transform:none;letter-spacing:0;font-size:14px;color:#f1f0ff;">
        <input type="checkbox" name="is_active" value="1"
               {{ $concert->is_active ? 'checked' : '' }}
               style="width:16px;height:16px;accent-color:#7c3aed;">
        Konser aktif
    </label>
</div>
      </div>
      <div style="display:flex;gap:10px;">
        <button type="submit" class="btn btn-purple" style="flex:1;padding:13px;">Simpan Perubahan</button>
        <a href="{{ route('admin.concerts.index') }}" class="btn btn-outline" style="padding:13px 20px;">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
