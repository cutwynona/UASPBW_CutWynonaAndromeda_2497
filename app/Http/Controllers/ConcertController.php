<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <--- Tambahkan ini di atas

class ConcertController extends Controller
{
    public function index(Request $request)
    {
        $query = Concert::where('is_active', true);

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('artist', 'like', '%'.$request->search.'%')
                  ->orWhere('city', 'like', '%'.$request->search.'%');
            });
        }
        if ($request->genre) {
            $query->where('genre', 'like', '%'.$request->genre.'%');
        }

        $concerts = $query->orderBy('event_date')->get();
        return view('concerts.index', compact('concerts'));
    }

    public function show(Concert $concert)
    {
        return view('concerts.show', compact('concert'));
    }

 public function store(Request $request)
    {
        $data = $request->except(['poster_image', '_token']);
        if ($request->hasFile('poster_image')) {
            $data['poster_image'] = $request->file('poster_image')->store('concerts', 'public');
        }
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        Concert::create($data);
        return redirect()->route('admin.concerts.index')->with('success', 'Berhasil!');
    }

    public function update(Request $request, Concert $concert)
    {
        $data = $request->except(['poster_image', '_token', '_method']);
        if ($request->hasFile('poster_image')) {
            if ($concert->poster_image) {
                Storage::disk('public')->delete($concert->poster_image);
            }
            $data['poster_image'] = $request->file('poster_image')->store('concerts', 'public');
        }
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $concert->update($data);
        return redirect()->route('admin.concerts.index')->with('success', 'Berhasil!');
    }
}
