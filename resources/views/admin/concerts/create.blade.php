@extends('layouts.app')
@section('title','Tambah Konser')
@section('nav')
  <a href="{{ route('admin.dashboard') }}">📊 Dashboard</a>
  <a href="{{ route('admin.concerts.index') }}" class="active">🎵 Konser</a>
  <a href="{{ route('admin.orders.index') }}">🎟️ Pesanan</a>
  <a href="{{ route('admin.users') }}">👥 Users</a>
@endsection


<form action="{{ route('admin.concerts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

@section('content')
<a href="{{ route('admin.concerts.index') }}" style="display:inline-flex;align-items:center;gap:6px;color:#6b6b8a;font-size:13px;margin-bottom:20px;">← Kembali</a>
<h2 class="page-title">Tambah Konser Baru</h2>

<div class="card" style="max-width:700px;">
  <div class="card-body">
    {{-- Menambahkan enctype agar form bisa memproses file --}}
    <form method="POST" action="{{ route('admin.concerts.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-row">
        <div class="form-group">
          <label>Judul Konser</label>
          <input type="text" name="title" class="form-control {{ $errors->has('title')?'is-invalid':'' }}" placeholder="THE ERAS TOUR" value="{{ old('title') }}">
          @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label>Nama Artis</label>
          <input type="text" name="artist" class="form-control {{ $errors->has('artist')?'is-invalid':'' }}" placeholder="Taylor Swift" value="{{ old('artist') }}">
          @error('artist') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi konser...">{{ old('description') }}</textarea>
      </div>

<div class="form-group">
  <label>Upload Poster Konser</label>
  {{-- Ubah 'poster' menjadi 'poster_image' --}}
  <input type="file" name="poster_image" class="form-control {{ $errors->has('poster_image') ? 'is-invalid' : '' }}" accept="image/*">
  @error('poster_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

      <div class="form-row">
        <div class="form-group">
          <label>Venue</label>
          <input type="text" name="venue" class="form-control {{ $errors->has('venue')?'is-invalid':'' }}" placeholder="Gelora Bung Karno" value="{{ old('venue') }}">
          @error('venue') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label>Kota</label>
          <input type="text" name="city" class="form-control {{ $errors->has('city')?'is-invalid':'' }}" placeholder="Jakarta" value="{{ old('city') }}">
          @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Tanggal Event</label>
          <input type="date" name="event_date" class="form-control {{ $errors->has('event_date')?'is-invalid':'' }}" value="{{ old('event_date') }}">
          @error('event_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label>Jam Mulai</label>
          <input type="time" name="event_time" class="form-control {{ $errors->has('event_time')?'is-invalid':'' }}" value="{{ old('event_time') }}">
          @error('event_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Harga Tiket (Rp)</label>
          <input type="number" name="price" class="form-control {{ $errors->has('price')?'is-invalid':'' }}" placeholder="500000" value="{{ old('price') }}">
          @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
          <label>Kuota Tiket</label>
          <input type="number" name="quota" class="form-control {{ $errors->has('quota')?'is-invalid':'' }}" placeholder="1000" value="{{ old('quota') }}">
          @error('quota') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Genre</label>
          <input type="text" name="genre" class="form-control" placeholder="Pop / R&B" value="{{ old('genre') }}">
        </div>
      </div>
      <div class="form-group">
        <label>Warna Tema (hex)</label>
        <div style="display:flex;gap:10px;align-items:center;">
          <input type="color" name="bg_color" value="{{ old('bg_color','#7c3aed') }}" style="width:50px;height:40px;border:none;border-radius:8px;cursor:pointer;background:none;">
          <span style="font-size:13px;color:#6b6b8a;">Pilih warna tema tiket</span>
        </div>
      </div>
<div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:4px;">
    {{-- Input hidden wajib ada agar status tidak hilang --}}
    <input type="hidden" name="is_active" value="0">

    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;text-transform:none;letter-spacing:0;font-size:14px;color:#f1f0ff;">
        <input type="checkbox" name="is_active" value="1"
               checked
               style="width:16px;height:16px;accent-color:#7c3aed;">
        Konser aktif
    </label>
</div>
      <button type="submit" class="btn btn-purple" style="width:100%;padding:13px;font-size:15px;">Simpan Konser</button>
    </form>
  </div>
</div>
@endsection
