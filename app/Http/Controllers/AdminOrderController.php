<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Sesuaikan jika nama modelmu berbeda

class AdminOrderController extends Controller
{
    // Menampilkan daftar semua pesanan masuk
    public function index()
    {
        // Mengambil semua data order (bisa ditambahkan pagination atau relasi ke user/konser)
        $orders = Order::latest()->get();

        // Sesuaikan nama view-nya dengan folder blade kamu
        return view('admin.orders.index', compact('orders'));
    }

    // Mengubah status pesanan (misal: pending -> success -> cancelled)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Asumsi nama kolom statusnya adalah 'status'
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // Mengonfirmasi pembayaran pesanan
    public function confirmPayment(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Asumsi mengubah status pembayaran
        $order->status = 'paid';
        $order->save();

        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
