<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                        ->with('concert')->latest()->get();
        return view('tickets.index', compact('orders'));
    }

    public function create(Request $request, $concert_id)
    {
        $concert = Concert::findOrFail($concert_id);
        $qty = $request->input('qty', 1);

        return view('admin.orders.create', compact('concert', 'qty'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'concert_id'     => 'required|exists:concerts,id',
            'qty'            => 'required|integer|min:1|max:10',
            'name'           => 'required|string|max:255',
            'nik'            => 'required|string|max:20',
            'phone'          => 'required|string|max:20',
            'payment_method' => 'required|string',
        ]);

        $concert = Concert::findOrFail($request->concert_id);

        if (isset($concert->is_full) && $concert->is_full) {
            return back()->with('error', 'Tiket sudah habis terjual!');
        }

        $order = Order::create([
            'user_id'        => Auth::id(),
            'concert_id'     => $concert->id,
            'qty'            => $request->qty,
            'total_price'    => $concert->price * $request->qty,
            'ticket_code'    => 'TKT-'.strtoupper(Str::random(8)),
            'status'         => 'pending',
            'name'           => $request->name,
            'nik'            => $request->nik,
            'phone'          => $request->phone,
            'payment_method' => $request->payment_method,
        ]);

        $concert->increment('sold', $request->qty);

        return redirect()->route('tickets.show', $order)->with('success', 'Data diri tersimpan! Silakan selesaikan pembayaran.');
    }

    public function show(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);
        return view('tickets.show', compact('order'));
    }

    public function processPayment(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        $order->update(['status' => 'confirmed']);
        return redirect()->route('tickets.show', $order)->with('success', 'Pembayaran Berhasil! Tiket Anda sudah aktif.');
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);

        if ($order->status === 'confirmed') {
            return back()->with('error', 'Maaf, tiket yang sudah dibayar tidak dapat dibatalkan.');
        }

        if ($order->status === 'cancelled') {
            return back()->with('error', 'Tiket sudah dibatalkan sebelumnya.');
        }

        $order->update(['status' => 'cancelled']);
        $order->concert->decrement('sold', $order->qty);

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dibatalkan dan kuota dikembalikan.');
    }

    public function downloadTicket($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->with('concert')->firstOrFail();
        $color = $order->concert->bg_color; // Mengambil warna dinamis dari konser

        if ($order->status !== 'confirmed') {
            return back()->with('error', 'Tiket hanya bisa diunduh setelah dikonfirmasi.');
        }

        // HTML untuk PDF dengan desain menggunakan $color
        $html = '
        <div style="font-family: Helvetica, sans-serif; max-width: 500px; margin: auto; border: 2px solid ' . $color . '; border-radius: 15px; overflow: hidden; background: #fff;">
            <div style="background: ' . $color . '; color: white; padding: 20px; text-align: center;">
                <h2 style="margin:0; letter-spacing: 2px;">STAGEPASS E-TICKET</h2>
            </div>
            <div style="padding: 30px;">
                <h1 style="color: #333; margin-bottom: 5px;">' . $order->concert->title . '</h1>
                <p style="font-size: 16px; color: #666; margin-top: 0;"><strong>Artist:</strong> ' . $order->concert->artist . '</p>

                <div style="border-top: 2px dashed #ccc; margin: 20px 0; padding-top: 20px;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <tr><td style="padding-bottom: 10px;"><strong>Tanggal:</strong></td><td style="padding-bottom: 10px;">' . \Carbon\Carbon::parse($order->concert->event_date)->format('d M Y') . '</td></tr>
                        <tr><td style="padding-bottom: 10px;"><strong>Waktu:</strong></td><td style="padding-bottom: 10px;">' . \Carbon\Carbon::parse($order->concert->event_time)->format('H:i') . ' WIB</td></tr>
                        <tr><td style="padding-bottom: 10px;"><strong>Venue:</strong></td><td style="padding-bottom: 10px;">' . $order->concert->venue . '</td></tr>
                        <tr><td style="padding-bottom: 10px;"><strong>Nama:</strong></td><td style="padding-bottom: 10px;">' . $order->name . '</td></tr>
                    </table>
                </div>

                <div style="text-align: center; margin-top: 20px;">
                    <p style="font-size: 14px; margin-bottom: 10px;"><strong>Kode Tiket:</strong> ' . $order->ticket_code . '</p>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $order->ticket_code . '" style="width: 150px; height: 150px;">
                </div>
            </div>
            <div style="background: #f9f9f9; padding: 15px; text-align: center; font-size: 11px; color: #666; border-top: 1px solid #eee;">
                Tiket ini resmi diterbitkan oleh StagePass. Mohon tunjukkan kode QR ini di pintu masuk.
            </div>
        </div>';

        $pdf = Pdf::loadHTML($html);
        return $pdf->download('E-Ticket-' . $order->ticket_code . '.pdf');
    }
}
