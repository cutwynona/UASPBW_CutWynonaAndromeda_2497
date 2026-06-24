@extends('layouts.app')
@section('title','Detail Tiket')
@section('nav')
  <a href="{{ route('concerts.index') }}">🎵 Konser</a>
  <a href="{{ route('tickets.index') }}" class="active">🎟️ Tiket Saya</a>
@endsection

@push('styles')
<style>
.ticket-wrap{max-width:600px;margin:0 auto;}
.e-ticket{border-radius:20px;overflow:hidden;border:1px solid {{ $order->concert->bg_color }}4D;box-shadow:0 20px 60px {{ $order->concert->bg_color }}33; background: #1a1a26;}

.e-ticket-top {
    padding: 36px;
    position: relative;
    color: white;
    background: {{ $order->concert->bg_color }};
    @if($order->concert->poster_image)
        background-image: linear-gradient(to bottom, rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('{{ asset('storage/' . $order->concert->poster_image) }}');
        background-size: cover;
        background-position: center;
    @else
        background: linear-gradient(135deg, {{ $order->concert->bg_color }}, {{ $order->concert->bg_color }}88);
    @endif
}
.e-ticket-top::before{
    @if(!$order->concert->poster_image)
        content:'{{ $order->concert->poster_emoji }}';
        position:absolute;right:20px;top:50%;transform:translateY(-50%);font-size:100px;opacity:.15;
    @endif
}
.e-ticket-label{font-size:11px;font-weight:700;letter-spacing:.15em;opacity:.7;margin-bottom:8px;}
.e-ticket-title{font-family:'Bebas Neue',sans-serif;font-size:40px;letter-spacing:1px;line-height:1;margin-bottom:6px;}
.e-ticket-artist{font-size:16px;opacity:.8;margin-bottom:20px;}
.e-ticket-meta{display:flex;gap:24px;flex-wrap:wrap;}
.e-ticket-meta-item{display:flex;flex-direction:column;}
.e-ticket-meta-label{font-size:10px;opacity:.6;text-transform:uppercase;letter-spacing:.08em;}
.e-ticket-meta-val{font-size:14px;font-weight:600;margin-top:2px;}

.e-ticket-divider{display:flex;align-items:center;background:#1a1a26;position:relative;}
.e-ticket-divider::before,.e-ticket-divider::after{content:'';width:28px;height:28px;background:#0a0a0f;border-radius:50%;flex-shrink:0;border:1px solid {{ $order->concert->bg_color }}33;}
.e-ticket-divider-line{flex:1;border-top:2px dashed {{ $order->concert->bg_color }}33;}

.e-ticket-bottom{padding:28px 36px;background:#1a1a26;}
.e-ticket-row{display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px solid rgba(255,255,255,.05);}
.e-ticket-row:last-child{border-bottom:none;}
.e-ticket-row-label{font-size:12px;color:#6b6b8a;text-transform:uppercase;letter-spacing:.05em;}
.e-ticket-row-val{font-size:14px;font-weight:600;text-align:right;}
.ticket-code-big{font-family:'Bebas Neue',sans-serif;font-size:28px;letter-spacing:3px;color:{{ $order->concert->bg_color }};}

.status-confirmed{color:#c4b5fd; background: rgba(196, 181, 253, 0.1); padding: 4px 10px; border-radius: 6px;}
.status-pending{color:#fbbf24; background: rgba(251, 191, 36, 0.1); padding: 4px 10px; border-radius: 6px;}

.back-link{display:inline-flex;align-items:center;gap:6px;color:#6b6b8a;font-size:13px;margin-bottom:20px;}
</style>
@endpush

@section('content')
<a href="{{ route('tickets.index') }}" class="back-link">← Semua Tiket</a>

<div class="ticket-wrap">
  <div class="e-ticket">
    <div class="e-ticket-top">
      <div class="e-ticket-label">🎵 STAGEPASS · E-TICKET</div>
      <div class="e-ticket-title">{{ $order->concert->title }}</div>
      <div class="e-ticket-artist">{{ $order->concert->artist }}</div>
      <div class="e-ticket-meta">
        <div class="e-ticket-meta-item">
          <span class="e-ticket-meta-label">Tanggal</span>
          <span class="e-ticket-meta-val">{{ \Carbon\Carbon::parse($order->concert->event_date)->format('d M Y') }}</span>
        </div>
        <div class="e-ticket-meta-item">
          <span class="e-ticket-meta-label">Waktu</span>
          <span class="e-ticket-meta-val">{{ \Carbon\Carbon::parse($order->concert->event_time)->format('H:i') }} WIB</span>
        </div>
        <div class="e-ticket-meta-item">
          <span class="e-ticket-meta-label">Venue</span>
          <span class="e-ticket-meta-val">{{ $order->concert->venue }}</span>
      </div>
      </div>
    </div>

    <div class="e-ticket-divider"><div class="e-ticket-divider-line"></div></div>

   {{-- BAGIAN INFORMASI PEMBAYARAN --}}
    @if($order->status == 'pending')
    <div style="background: #1a1a26; padding: 36px; border-bottom: 1px solid {{ $order->concert->bg_color }}33; text-align: center;">
        <h3 style="color: #fff; margin-bottom: 16px; font-size: 18px;">Menunggu Pembayaran</h3>

        <div style="background: #0a0a0f; padding: 20px; border-radius: 12px; margin-bottom: 20px; text-align: left; border: 1px solid #333;">
            <p style="font-size: 11px; color: #6b6b8a; text-transform: uppercase; margin-bottom: 5px;">Nomor Virtual Account ({{ $order->payment_method }}):</p>
            <h2 style="color: {{ $order->concert->bg_color }}; margin: 0 0 15px 0; font-family: 'Bebas Neue', sans-serif; letter-spacing: 2px;">880{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h2>

            <p style="font-size: 11px; color: #6b6b8a; text-transform: uppercase; margin-bottom: 5px;">Langkah Pembayaran:</p>
            <ul style="color: #ccc; font-size: 13px; padding-left: 18px; margin: 0; line-height: 1.6;">
                @if($order->payment_method == 'DANA')
                    <li>Buka aplikasi DANA dan pilih menu <strong>Pay/Bayar</strong>.</li>
                    <li>Pilih <strong>Send to Bank</strong>.</li>
                    <li>Masukkan nomor VA di atas dan nominal <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>.</li>
                @else
                    <li>Buka aplikasi {{ $order->payment_method }} Anda.</li>
                    <li>Pilih menu <strong>Transfer</strong> > <strong>Virtual Account</strong>.</li>
                    <li>Masukkan nomor VA di atas dan pastikan nominal <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong>.</li>
                @endif
                <li>Simpan bukti transfer Anda.</li>
            </ul>
        </div>

        <form method="POST" action="{{ route('tickets.pay', $order) }}">
            @csrf @method('PATCH')
            <button type="submit" style="width:100%; padding: 14px; background: {{ $order->concert->bg_color }}; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; font-size: 16px;">
                Saya Sudah Transfer
            </button>
        </form>
    </div>
    @endif

 {{-- TAMBAHAN TOMBOL DOWNLOAD PDF --}}
    @if($order->status == 'confirmed')
    <div style="margin-top: 15px; text-align: center;">
        <a href="{{ route('tickets.download', $order->id) }}" style="background: {{ $order->concert->bg_color }}; color: white; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s;">
             Unduh E-Ticket (PDF)
        </a>
    </div>
    @endif

{{-- DETAIL TIKET --}}
    @if($order->status == 'confirmed')
    <div class="e-ticket-bottom">
      <div class="e-ticket-row">
        <span class="e-ticket-row-label">Kode Tiket</span>
        <span class="ticket-code-big">{{ $order->ticket_code }}</span>
      </div>
      <div class="e-ticket-row">
        <span class="e-ticket-row-label">Nama Pemesan</span>
        <span class="e-ticket-row-val">{{ $order->user->name }}</span>
      </div>
      <div class="e-ticket-row">
        <span class="e-ticket-row-label">Jumlah Tiket</span>
        <span class="e-ticket-row-val">{{ $order->qty }} tiket</span>
      </div>
      <div class="e-ticket-row">
        <span class="e-ticket-row-label">Total Harga</span>
        <span class="e-ticket-row-val" style="color:{{ $order->concert->bg_color }};font-size:18px;">Rp {{ number_format($order->total_price,0,',','.') }}</span>
      </div>
      <div class="e-ticket-row">
        <span class="e-ticket-row-label">Status</span>
        <span class="e-ticket-row-val status-confirmed">Confirmed</span>
      </div>

{{-- ELEMEN TAMBAHAN PROFESIONAL --}}
      <div style="margin-top: 30px; padding-top: 20px; border-top: 1px dashed rgba(255,255,255,0.15); text-align: center;">
          {{-- QR CODE dengan style lebih modern --}}
          <div style="background: white; width: 80px; height: 80px; margin: 0 auto 12px auto; border-radius: 8px; padding: 6px; box-shadow: 0 4px 15px rgba(0,0,0,0.3);">
              <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $order->ticket_code }}&margin=0" alt="QR" style="width:100%; display:block;">
      </div>

          {{-- Teks instruksi yang lebih formal --}}
          <p style="font-size: 11px; color: #a1a1aa; letter-spacing: 0.5px; margin: 0;">Scan tiket di pintu masuk</p>

          {{-- Disclaimer yang lebih profesional --}}
          <div style="margin-top: 12px; font-size: 8px; color: #52526b; line-height: 1.4; text-transform: uppercase; letter-spacing: 0.8px;">
              Tiket bersifat non-refundable. Berlaku untuk 1 (satu) orang pengunjung.
          </div>
      </div>
      {{-- AKHIR TAMBAHAN --}}
    </div>
    @else
    @if($order->status !== 'pending')
    <div class="e-ticket-bottom" style="text-align: center; color: #6b6b8a; padding: 40px;">
        <p style="font-size: 16px;">Tiket ini telah dibatalkan.</p>
    </div>
    @endif
    @endif

  @if($order->status == 'pending')
    <div style="margin-top:16px;text-align:center;">
      <form method="POST" action="{{ route('tickets.cancel',$order) }}" onsubmit="return confirm('Yakin batalkan tiket ini?')">
        @csrf @method('PATCH')
        <button type="submit" style="background:transparent;border:1px solid {{ $order->concert->bg_color }}4D;color:{{ $order->concert->bg_color }};padding:10px 24px;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:14px;cursor:pointer;">
          Batalkan Tiket
        </button>
      </form>
    </div>
  @endif
</div>
@endsection
