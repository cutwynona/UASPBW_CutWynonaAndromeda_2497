@extends('layouts.app')
@section('title', 'Isi Data Diri')

@push('styles')
<style>
    .order-container { max-width: 550px; margin: 40px auto; font-family: 'DM Sans', sans-serif; }
    .order-card { background: #1a1a26; padding: 30px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }

    .summary-box { background: rgba(139, 92, 246, 0.1); padding: 15px 20px; border-radius: 12px; display: flex; justify-content: space-between; margin-bottom: 25px; border: 1px solid rgba(139, 92, 246, 0.2); color: white; }

    .form-group { margin-bottom: 20px; }
    .form-label { display: block; color: #a1a1aa; font-size: 13px; margin-bottom: 8px; }
    .form-control { width: 100%; padding: 12px 15px; background: #0a0a0f; border: 1px solid #333; border-radius: 10px; color: white; transition: 0.3s; }
    .form-control:focus { outline: none; border-color: #8b5cf6; box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.2); }

    .btn-submit { width: 100%; padding: 15px; background: #8b5cf6; border: none; border-radius: 12px; color: white; font-weight: bold; cursor: pointer; margin-top: 10px; transition: 0.3s; }
    .btn-submit:hover { background: #7c3aed; }
</style>
@endpush

@section('content')
<div class="order-container">
    <h2 style="color: white; margin-bottom: 20px; text-align: center;">Lengkapi Data Diri</h2>

    <div class="order-card">
        <div class="summary-box">
            <span>Konser: <strong>{{ $concert->title }}</strong></span>
            <span>Total: <strong>Rp {{ number_format($concert->price * $qty, 0, ',', '.') }}</strong></span>
        </div>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <input type="hidden" name="concert_id" value="{{ $concert->id }}">
            <input type="hidden" name="qty" value="{{ $qty }}">

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required placeholder="Masukkan nama lengkap Anda">
            </div>

            <div class="form-group">
                <label class="form-label">NIK (Nomor KTP)</label>
                <input type="text" name="nik" class="form-control" required placeholder="Masukkan 16 digit NIK">
            </div>

            <div class="form-group">
                <label class="form-label">Nomor HP (WhatsApp)</label>
                <input type="text" name="phone" class="form-control" required placeholder="Contoh: 0812xxxxxx">
            </div>

            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select name="payment_method" class="form-control">
                    <option value="BCA">BCA Transfer</option>
                    <option value="DANA">DANA</option>
                    <option value="MANDIRI">Mandiri</option>
                    <option value="BSI">BSI</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Konfirmasi Pesanan</button>
        </form>
    </div>
</div>
@endsection
