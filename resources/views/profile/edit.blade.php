@extends('layouts.app')
@section('title','Edit Profil')

@section('content')
<div style="max-width: 500px; margin: 0 auto;">
    <h2 class="page-title">Edit Profil</h2>

    <div class="card" style="padding: 24px;">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf @method('PATCH')

            <div style="text-align: center; margin-bottom: 25px;">
                <div style="width: 100px; height: 100px; background: #2d2d3a; border-radius: 50%; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid var(--purple);">
                    @if($user->profile_photo)
                        <img src="{{ asset('storage/'.$user->profile_photo) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <span style="font-size: 40px;">👤</span>
                    @endif
                </div>
                <input type="file" name="profile_photo" style="font-size: 12px; color: var(--muted);">
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
            </div>

            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
            </div>

            <div style="margin: 20px 0; border-top: 1px solid var(--border); padding-top: 20px;">
                <p style="font-size: 11px; color: var(--purple-light); margin-bottom: 10px; text-transform: uppercase;">Keamanan (Kosongkan jika tidak ubah)</p>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••">
                </div>
            </div>

            <button type="submit" class="btn btn-purple" style="width: 100%; margin-top: 10px;">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
