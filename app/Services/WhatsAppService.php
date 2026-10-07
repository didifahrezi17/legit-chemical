<?php

namespace App\Services;

use App\Models\Product;

class WhatsAppService
{
    public static function getAdminNumber(): string
    {
        $number = env('WHATSAPP_ADMIN', '6281234567890');

        return preg_replace('/[^0-9]/', '', $number);
    }

    public static function generateSingleProductMessage(Product $product, int $quantity = 1): string
    {
        $unitPrice = 'Rp'.number_format((float) $product->price, 0, ',', '.');

        return "Halo Admin Legit Chemical,\n\n"
            ."Saya ingin berkonsultasi mengenai produk:\n\n"
            ."Produk: {$product->name}\n"
            ."Jumlah: {$quantity}\n"
            ."Harga: {$unitPrice}\n\n"
            ."Mohon informasi mengenai ketersediaan dan detail produk.\n\n"
            .'Terima kasih.';
    }

    public static function generateCartMessage(array $cartItems, float $totalEstimate): string
    {
        $message = "Halo Admin Legit Chemical,\n\n"
            ."Saya ingin berkonsultasi mengenai produk berikut:\n\n";

        $i = 1;
        foreach ($cartItems as $item) {
            $formattedPrice = 'Rp'.number_format((float) $item['price'], 0, ',', '.');
            $message .= "{$i}. {$item['name']}\n"
                ."   Jumlah: {$item['quantity']}\n"
                ."   Harga: {$formattedPrice}\n\n";
            $i++;
        }

        $formattedTotal = 'Rp'.number_format($totalEstimate, 0, ',', '.');
        $message .= "Total estimasi: {$formattedTotal}\n\n"
            ."Mohon informasi mengenai ketersediaan dan detail produk.\n\n"
            .'Terima kasih.';

        return $message;
    }

    public static function generateUrl(string $message): string
    {
        $phone = static::getAdminNumber();

        return "https://wa.me/{$phone}?text=".rawurlencode($message);
    }
}
