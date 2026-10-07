<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'admin_id',
        'type',
        'quantity',
        'stock_before',
        'stock_after',
        'note',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function getTypeBadgeClassAttribute(): string
    {
        return match ($this->type) {
            'masuk' => 'bg-success',
            'keluar' => 'bg-danger',
            'penyesuaian' => 'bg-warning text-dark',
            default => 'bg-secondary',
        };
    }
}
