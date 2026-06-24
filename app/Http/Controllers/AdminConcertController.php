<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <--- WAJIB TAMBAHKAN INI

class AdminConcertController extends Controller
{
    public function index()
    {
        $concerts = Concert::latest()->get();
        return view('admin.concerts.index', compact('concerts'));
    }

    public function create() { return view('admin.concerts.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|min:2',
            'artist'       => 'required|min:2',
            'description'  => 'nullable|max:1000',
            'venue'        => 'required',
            'city'         => 'required',
            'event_date'   => 'required|date|after:today',
            'event_time'   => 'required',
            'poster_emoji' => 'nullable|max:4',
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'genre'        => 'nullable|max:50',
            'price'        => 'required|integer|min:1000',
            'quota'        => 'required|integer|min:1',
            'bg_color'     => 'nullable',
        ]);

        if ($request->hasFile('poster_image')) {
            $data['poster_image'] = $request->file('poster_image')->store('posters', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['poster_emoji'] = $data['poster_emoji'] ?? '🎵';
        $data['bg_color']     = $data['bg_color'] ?? '#6B21A8';

        Concert::create($data);

        return redirect()->route('admin.concerts.index')->with('success','Konser berhasil ditambahkan!');
    }

    public function edit(Concert $concert) { return view('admin.concerts.edit', compact('concert')); }

    public function update(Request $request, Concert $concert)
    {
        $data = $request->validate([
            'title'        => 'required|min:2',
            'artist'       => 'required|min:2',
            'description'  => 'nullable|max:1000',
            'venue'        => 'required',
            'city'         => 'required',
            'event_date'   => 'required|date',
            'event_time'   => 'required',
            'poster_emoji' => 'nullable|max:4',
            'poster_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'genre'        => 'nullable|max:50',
            'price'        => 'required|integer|min:1000',
            'quota'        => 'required|integer|min:1',
            'bg_color'     => 'nullable',
        ]);

        // LOGIKA PERBAIKAN: Hapus foto lama jika ganti foto baru
        if ($request->hasFile('poster_image')) {
            // Hapus file lama jika ada
            if ($concert->poster_image) {
                Storage::disk('public')->delete($concert->poster_image);
            }
            // Simpan foto baru
            $data['poster_image'] = $request->file('poster_image')->store('posters', 'public');
        }

        // Update data termasuk status is_active
        $data['is_active'] = $request->has('is_active');
        $concert->update($data);

        return redirect()->route('admin.concerts.index')->with('success','Konser berhasil diperbarui!');
    }

    public function destroy(Concert $concert)
    {
        // Opsional: Hapus foto saat konser dihapus
        if ($concert->poster_image) {
            Storage::disk('public')->delete($concert->poster_image);
        }
        $concert->delete();
        return back()->with('success','Konser dihapus.');
    }
}
