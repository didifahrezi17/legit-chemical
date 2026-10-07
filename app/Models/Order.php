<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'total',
        'status',
        'notes',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'konsultasi' => 'Konsultasi',
            'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
            'dikonfirmasi' => 'Dikonfirmasi',
            'selesai' => 'Selesai',
            'dibatalkan' => 'Dibatalkan',
            default => ucfirst($this->status),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'konsultasi' => 'bg-info text-dark',
            'menunggu_konfirmasi' => 'bg-warning text-dark',
            'dikonfirmasi' => 'bg-primary',
            'selesai' => 'bg-success',
            'dibatalkan' => 'bg-danger',
            default => 'bg-secondary',
        };
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp'.number_format((float) $this->total, 0, ',', '.');
    }
}
