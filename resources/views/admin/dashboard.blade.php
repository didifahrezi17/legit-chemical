@extends('layouts.admin')

@section('title', 'Admin Dashboard - LEGIT CHEMICAL')
@section('page_title', 'Dashboard')

@section('content')

<!-- GREETING / STATS HEADER -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
    <div>
        <h4 class="fw-bold text-dark font-poppins mb-1">Selamat Datang di Dashboard Admin</h4>
        <p class="text-muted small mb-0">Ringkasan performa penjualan, stok produk, dan konsultasi pesanan LEGIT CHEMICAL.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.produk.create') }}" class="btn btn-navy btn-sm px-3 py-2">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
        <a href="{{ route('admin.riwayat_pesanan.index') }}" class="btn btn-outline-secondary btn-sm px-3 py-2">
            <i class="bi bi-receipt me-1"></i> Riwayat Pesanan
        </a>
    </div>
</div>

<!-- 4 KARTU STATISTIK UTAMA (REAL DATA) -->
<div class="row g-3 mb-4">
    <!-- Total Produk -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card-stat h-100">
            <div class="stat-icon" style="background-color: #EBF3FC; color: var(--admin-navy);">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <div class="text-muted small fw-medium">Total Produk</div>
                <h4 class="fw-bold mb-0 text-dark font-poppins">{{ $totalProducts }} <span class="fs-6 fw-normal text-muted">Produk</span></h4>
            </div>
        </div>
    </div>

    <!-- Total Pesanan -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card-stat h-100">
            <div class="stat-icon" style="background-color: #E0F2FE; color: #0284C7;">
                <i class="bi bi-cart-check"></i>
            </div>
            <div>
                <div class="text-muted small fw-medium">Total Pesanan</div>
                <h4 class="fw-bold mb-0 text-dark font-poppins">{{ $totalOrders }} <span class="fs-6 fw-normal text-muted">Pesanan</span></h4>
            </div>
        </div>
    </div>

    <!-- Pesanan Bulan Ini -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card-stat h-100">
            <div class="stat-icon" style="background-color: #FEF3C7; color: #D97706;">
                <i class="bi bi-calendar2-check"></i>
            </div>
            <div>
                <div class="text-muted small fw-medium">Pesanan Bulan Ini</div>
                <h4 class="fw-bold mb-0 text-dark font-poppins">{{ $ordersThisMonth }} <span class="fs-6 fw-normal text-muted">Pesanan</span></h4>
            </div>
        </div>
    </div>

    <!-- Penghasilan Bulan Ini -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card-stat h-100">
            <div class="stat-icon" style="background-color: #DCFCE7; color: #16A34A;">
                <i class="bi bi-wallet2"></i>
            </div>
            <div>
                <div class="text-muted small fw-medium">Penghasilan Bulan Ini</div>
                <h4 class="fw-bold mb-0 text-dark font-poppins" style="font-size: 1.25rem;">{{ $revenueThisMonth }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- SECTION PENGHASILAN BULANAN & PRODUK PALING BANYAK DIPESAN -->
<div class="row g-4 mb-4">
    <!-- GRAFIK PENGHASILAN BULANAN -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 14px; background: #FFFFFF;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold text-dark font-poppins mb-1">
                        <i class="bi bi-graph-up text-primary me-2"></i>Penghasilan Bulanan
                    </h5>
                    <p class="text-muted small mb-0">Total pendapatan pesanan terkonfirmasi tahun {{ $currentYear }}</p>
                </div>
                <div class="text-end">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 fw-semibold" style="font-size: 0.85rem;">
                        Tahun {{ $currentYear }}: {{ $formattedAnnualRevenue }}
                    </span>
                </div>
            </div>

            <!-- Chart Container -->
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="monthlyRevenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- PRODUK PALING BANYAK DIPESAN (TOP 5 BEST SELLING) -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 14px; background: #FFFFFF;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold text-dark font-poppins mb-1">
                        <i class="bi bi-trophy text-warning me-2"></i>Produk Paling Banyak Dipesan
                    </h5>
                    <p class="text-muted small mb-0">Top 5 produk dengan penjualan tertinggi</p>
                </div>
                <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary btn-sm" title="Kelola Produk">
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 40px;">#</th>
                            <th scope="col">Produk</th>
                            <th scope="col" class="text-end">Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topProducts as $index => $top)
                            <tr>
                                <td>
                                    @if($index == 0)
                                        <span class="badge bg-warning text-dark rounded-circle p-1" style="width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center;">1</span>
                                    @elseif($index == 1)
                                        <span class="badge bg-secondary text-white rounded-circle p-1" style="width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center;">2</span>
                                    @elseif($index == 2)
                                        <span class="badge bg-danger-subtle text-danger rounded-circle p-1" style="width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center;">3</span>
                                    @else
                                        <span class="text-muted fw-bold ps-1">{{ $index + 1 }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width: 38px; height: 38px; flex-shrink: 0;" class="bg-light rounded overflow-hidden border">
                                            @if($top->image)
                                                <img src="{{ asset('storage/' . $top->image) }}" alt="{{ $top->name }}" class="w-100 h-100 object-fit-cover">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted small fw-bold">LC</div>
                                            @endif
                                        </div>
                                        <div class="overflow-hidden">
                                            <div class="fw-semibold text-dark text-truncate" style="max-width: 180px;" title="{{ $top->name }}">
                                                {{ $top->name }}
                                            </div>
                                            <span class="text-muted small" style="font-size: 0.75rem;">{{ $top->category_name ?? 'Umum' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span class="badge bg-success-subtle text-success px-2 py-1 fw-bold">
                                        {{ $top->total_sold }} Terjual
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4 small">
                                    <i class="bi bi-bag-x fs-3 d-block mb-1 text-secondary opacity-50"></i>
                                    Belum ada data pesanan selesai/dikonfirmasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SECTION PESANAN TERBARU -->
<div class="card border-0 shadow-sm p-4" style="border-radius: 14px; background: #FFFFFF;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold text-dark font-poppins mb-1">
                <i class="bi bi-clock-history text-primary me-2"></i>Pesanan Terbaru
            </h5>
            <p class="text-muted small mb-0">5 pesanan &amp; konsultasi terakhir yang masuk ke sistem</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-primary btn-sm px-3">
                Lihat Semua Pesanan <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">Kode Pesanan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Item Dipesan</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestOrders as $ord)
                    <tr>
                        <td>
                            <span class="fw-bold font-poppins text-dark">#{{ $ord->order_code }}</span>
                        </td>
                        <td>
                            <div class="small fw-semibold text-dark">{{ $ord->created_at->format('d M Y') }}</div>
                            <div class="text-muted" style="font-size: 0.78rem;"><i class="bi bi-clock me-1"></i>{{ $ord->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1">
                                {{ $ord->orderDetails->count() }} Produk ({{ $ord->orderDetails->sum('quantity') }} Qty)
                            </span>
                        </td>
                        <td>
                            <span class="fw-bold text-primary">{{ $ord->formatted_total }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $ord->status_badge_class }} px-2 py-1" style="font-size: 0.8rem;">
                                {{ $ord->status_label }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.pesanan.show', $ord->id) }}" class="btn btn-navy btn-sm px-3 py-1 font-poppins fw-semibold" style="font-size: 0.82rem;">
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-2 text-secondary opacity-50 d-block mb-2"></i>
                            <h6 class="fw-bold text-dark mb-0">Belum Ada Pesanan Masuk</h6>
                            <p class="small text-muted mb-0">Pesanan dari konsultasi pelanggan akan muncul di sini.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('monthlyRevenueChart');
        if (!ctx) return;

        const labels = @json($chartLabels);
        const dataValues = @json($chartData);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Penghasilan (Rp)',
                    data: dataValues,
                    backgroundColor: 'rgba(11, 59, 130, 0.85)',
                    borderColor: '#0B3B82',
                    borderWidth: 1,
                    borderRadius: 6,
                    hoverBackgroundColor: '#1565C0',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#072552',
                        titleFont: { family: 'Poppins', size: 13, weight: 'bold' },
                        bodyFont: { family: 'Inter', size: 12 },
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(context) {
                                let val = context.parsed.y || 0;
                                return ' Penghasilan: Rp ' + val.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: 'Inter', size: 11 },
                            color: '#64748B'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#F1F5F9',
                            drawBorder: false
                        },
                        ticks: {
                            font: { family: 'Inter', size: 11 },
                            color: '#64748B',
                            callback: function(value) {
                                if (value >= 1000000) {
                                    return 'Rp ' + (value / 1000000).toFixed(1) + 'M';
                                } else if (value >= 1000) {
                                    return 'Rp ' + (value / 1000).toFixed(0) + 'k';
                                }
                                return 'Rp ' + value;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
