<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->decimal('original_price', 15, 2)
                ->nullable()
                ->after('price');

            $table->decimal('discount_percentage', 5, 2)
                ->default(0)
                ->after('original_price');

            $table->decimal('discount_amount', 15, 2)
                ->default(0)
                ->after('discount_percentage');
        });
    }

    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn([
                'original_price',
                'discount_percentage',
                'discount_amount',
            ]);
        });
    }
};