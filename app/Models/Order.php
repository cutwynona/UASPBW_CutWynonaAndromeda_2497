<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Kita tambahkan kolom baru ke $fillable agar data tidak hilang saat disimpan
    protected $fillable = [
        'user_id',
        'concert_id',
        'qty',
        'total_price',
        'ticket_code',
        'status',
        'name',
        'nik',
        'phone',
        'payment_method'
    ];

    public function user()    { return $this->belongsTo(User::class); }
    public function concert() { return $this->belongsTo(Concert::class); }

    public function getStatusLabelAttribute(): string {
        return match($this->status) {
            'pending'   => '⏳ Menunggu',
            'confirmed' => '✅ Dikonfirmasi',
            'cancelled' => '❌ Dibatal',
            default     => $this->status,
        };
    }

    public function getStatusClassAttribute(): string {
        return match($this->status) {
            'pending'   => 'badge-pending',
            'confirmed' => 'badge-confirmed',
            'cancelled' => 'badge-cancelled',
            default     => '',
        };
    }
}
