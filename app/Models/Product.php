<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'discount_percentage',
        'stock',
        'image',
        'description',
        'specifications',
        'benefits',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function stockHistories()
    {
        return $this->hasMany(StockHistory::class);
    }

    /** Whether this product has an active discount. */
    public function getHasDiscountAttribute(): bool
    {
        return (int) $this->discount_percentage > 0;
    }

    /** Price after discount applied (raw numeric). */
    public function getDiscountedPriceAttribute(): float
    {
        if (! $this->has_discount) {
            return (float) $this->price;
        }

        return round((float) $this->price * (1 - $this->discount_percentage / 100));
    }

    /** Amount saved in Rupiah. */
    public function getDiscountAmountAttribute(): float
    {
        return (float) $this->price - $this->discounted_price;
    }

    /**
     * Final selling price (after discount) — what customers pay.
     * Used across cart, orders, and WhatsApp message.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp'.number_format($this->discounted_price, 0, ',', '.');
    }

    /** Original price before discount. */
    public function getFormattedOriginalPriceAttribute(): string
    {
        return 'Rp'.number_format((float) $this->price, 0, ',', '.');
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->stock > 5) {
            return 'Tersedia';
        }

        if ($this->stock > 0) {
            return 'Stok Menipis';
        }

        return 'Habis';
    }

    public function getStockBadgeClassAttribute(): string
    {
        if ($this->stock > 5) {
            return 'bg-success';
        }

        if ($this->stock > 0) {
            return 'bg-warning text-dark';
        }

        return 'bg-danger';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
