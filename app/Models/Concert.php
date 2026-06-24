<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Concert extends Model
{
    protected $fillable = ['title','artist','description','venue','city','event_date','event_time','poster_image','genre','price','quota','sold','bg_color','is_active'];

    public function orders() { return $this->hasMany(Order::class); }

    public function getAvailableAttribute(): int { return $this->quota - $this->sold; }

    public function getIsFullAttribute(): bool { return $this->available <= 0; }

    public function getStatusLabelAttribute(): string {
        if (!$this->is_active) return 'Tidak Aktif';
        if ($this->is_full) return 'Sold Out';
        if ($this->available < ($this->quota * 0.1)) return 'Hampir Habis';
        return 'Tersedia';
    }
}
