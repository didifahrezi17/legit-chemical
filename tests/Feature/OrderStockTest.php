<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class OrderStockTest extends TestCase
{
    use RefreshDatabase;

    protected Admin $admin;

    protected Category $category;

    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('Admin123!'),
        ]);

        $this->category = Category::create([
            'name' => 'Chemical',
            'slug' => 'chemical',
            'status' => 'active',
        ]);

        $this->product = Product::create([
            'category_id' => $this->category->id,
            'name' => 'Asam Sulfat 98%',
            'slug' => 'asam-sulfat-98',
            'price' => 65000,
            'stock' => 10,
            'status' => 'active',
        ]);
    }

    public function test_cart_whatsapp_consultation_creates_order_without_deducting_stock()
    {
        // Add item to session cart
        $this->post('/keranjang/add', [
            'product_id' => $this->product->id,
            'quantity' => 2,
        ]);

        // Submit WhatsApp consultation checkout
        $response = $this->post('/keranjang/checkout');

        // Verify order created in database with status 'konsultasi'
        $this->assertDatabaseHas('orders', [
            'total' => 130000,
            'status' => 'konsultasi',
        ]);

        // Stock MUST NOT be reduced yet!
        $this->assertEquals(10, $this->product->fresh()->stock);
    }

    public function test_admin_confirming_order_deducts_stock_and_records_history()
    {
        $order = Order::create([
            'order_code' => 'ORD-20260920-TEST',
            'total' => 130000,
            'status' => 'konsultasi',
        ]);

        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'quantity' => 3,
            'price' => 65000,
            'subtotal' => 195000,
        ]);

        // Act as admin and confirm order
        $response = $this->actingAs($this->admin, 'admin')
            ->put("/admin/pesanan/{$order->id}/konfirmasi");

        // Verify status changed to 'dikonfirmasi'
        $this->assertEquals('dikonfirmasi', $order->fresh()->status);

        // Verify stock deducted from 10 to 7
        $this->assertEquals(7, $this->product->fresh()->stock);

        // Verify stock history recorded
        $this->assertDatabaseHas('stock_histories', [
            'product_id' => $this->product->id,
            'admin_id' => $this->admin->id,
            'type' => 'keluar',
            'quantity' => 3,
            'stock_before' => 10,
            'stock_after' => 7,
        ]);
    }

    public function test_confirming_already_confirmed_order_does_not_deduct_stock_twice()
    {
        $order = Order::create([
            'order_code' => 'ORD-20260920-TEST2',
            'total' => 130000,
            'status' => 'dikonfirmasi',
        ]);

        OrderDetail::create([
            'order_id' => $order->id,
            'product_id' => $this->product->id,
            'quantity' => 3,
            'price' => 65000,
            'subtotal' => 195000,
        ]);

        // Confirm second time
        $response = $this->actingAs($this->admin, 'admin')
            ->put("/admin/pesanan/{$order->id}/konfirmasi");

        // Stock must remain 10
        $this->assertEquals(10, $this->product->fresh()->stock);
    }
}
