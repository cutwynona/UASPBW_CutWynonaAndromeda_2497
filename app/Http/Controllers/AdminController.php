<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalConcerts' => Concert::count(),
            'totalOrders'   => Order::count(),
            'totalRevenue'  => Order::where('status','confirmed')->sum('total_price'),
            'totalUsers'    => User::where('role','customer')->count(),
            'recentOrders'  => Order::with(['user','concert'])->latest()->take(6)->get(),
        ]);
    }

    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function deleteUser(User $user)
    {
        if ($user->id === auth()->id()) return back()->with('error','Tidak bisa hapus akun sendiri.');
        $user->delete();
        return back()->with('success','Pengguna dihapus.');
    }
}
