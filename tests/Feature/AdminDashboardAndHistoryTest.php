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

class AdminDashboardAndHistoryTest extends TestCase
{
    use RefreshDatabase;

    protected Admin $admin;

    protected Category $category;

    protected Product $productA;

    protected Product $productB;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::create([
            'name' => 'Admin Legit',
            'username' => 'adminlegit',
            'email' => 'admin@legitchemical.com',
            'password' => Hash::make('Admin123!'),
        ]);

        $this->category = Category::create([
            'name' => 'Chemical',
            'slug' => 'chemical',
            'status' => 'active',
        ]);

        $this->productA = Product::create([
            'category_id' => $this->category->id,
            'name' => 'Soda Api (NaOH)',
            'slug' => 'soda-api-naoh',
            'price' => 55000,
            'stock' => 20,
            'status' => 'active',
        ]);

        $this->productB = Product::create([
            'category_id' => $this->category->id,
            'name' => 'Asam Sulfat 98%',
            'slug' => 'asam-sulfat-98',
            'price' => 65000,
            'stock' => 15,
            'status' => 'active',
        ]);
    }

    public function test_guest_cannot_access_dashboard_and_order_history()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/admin/login');

        $responseHistory = $this->get('/admin/riwayat-pesanan');
        $responseHistory->assertRedirect('/admin/login');
    }

    public function test_admin_can_view_dashboard_with_real_statistics_and_top_products()
    {
        // Create sample orders
        $order1 = Order::create([
            'order_code' => 'ORD-2026-001',
            'total' => 110000,
            'status' => 'dikonfirmasi',
        ]);
        OrderDetail::create([
            'order_id' => $order1->id,
            'product_id' => $this->productA->id,
            'quantity' => 2,
            'price' => 55000,
            'subtotal' => 110000,
        ]);

        $order2 = Order::create([
            'order_code' => 'ORD-2026-002',
            'total' => 195000,
            'status' => 'selesai',
        ]);
        OrderDetail::create([
            'order_id' => $order2->id,
            'product_id' => $this->productB->id,
            'quantity' => 3,
            'price' => 65000,
            'subtotal' => 195000,
        ]);

        $response = $this->actingAs($this->admin, 'admin')
            ->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Selamat Datang di Dashboard Admin');
        $response->assertSee('Total Produk');
        $response->assertSee('Total Pesanan');
        $response->assertSee('Pesanan Bulan Ini');
        $response->assertSee('Penghasilan Bulan Ini');
        $response->assertSee('Produk Paling Banyak Dipesan');
        $response->assertSee('Penghasilan Bulanan');
        $response->assertSee('Pesanan Terbaru');
        $response->assertSee('Soda Api (NaOH)');
        $response->assertSee('Asam Sulfat 98%');
        $response->assertSee('ORD-2026-001');
    }

    public function test_admin_can_view_order_history_and_filter_by_status_and_search()
    {
        Order::create([
            'order_code' => 'ORD-HIST-001',
            'total' => 100000,
            'status' => 'dikonfirmasi',
        ]);

        Order::create([
            'order_code' => 'ORD-HIST-002',
            'total' => 200000,
            'status' => 'dibatalkan',
        ]);

        // Access Riwayat Pesanan
        $response = $this->actingAs($this->admin, 'admin')
            ->get('/admin/riwayat-pesanan');

        $response->assertStatus(200);
        $response->assertSee('Riwayat &amp; Arsip Pesanan', false);
        $response->assertSee('ORD-HIST-001');
        $response->assertSee('ORD-HIST-002');

        // Filter by status 'dikonfirmasi'
        $responseFilter = $this->actingAs($this->admin, 'admin')
            ->get('/admin/riwayat-pesanan?status=dikonfirmasi');
        $responseFilter->assertStatus(200);
        $responseFilter->assertSee('ORD-HIST-001');
        $responseFilter->assertDontSee('ORD-HIST-002');

        // Search by order code
        $responseSearch = $this->actingAs($this->admin, 'admin')
            ->get('/admin/riwayat-pesanan?search=HIST-002');
        $responseSearch->assertStatus(200);
        $responseSearch->assertSee('ORD-HIST-002');
        $responseSearch->assertDontSee('ORD-HIST-001');
    }
}
