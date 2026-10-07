<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'original_price',
        'discount_percentage',
        'discount_amount',
        'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp'.number_format((float) $this->price, 0, ',', '.');
    }

    public function getFormattedOriginalPriceAttribute(): string
    {
        return 'Rp'.number_format((float) ($this->original_price ?? $this->price), 0, ',', '.');
    }

    public function getFormattedDiscountAmountAttribute(): string
    {
        return 'Rp'.number_format((float) ($this->discount_amount ?? 0), 0, ',', '.');
    }

    public function getFormattedSubtotalAttribute(): string
    {
        return 'Rp'.number_format((float) $this->subtotal, 0, ',', '.');
    }

    public function getHasDiscountAttribute(): bool
    {
        return (float) ($this->discount_amount ?? 0) > 0;
    }
}