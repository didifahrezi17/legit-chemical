@extends('layouts.admin')

@section('title', 'Riwayat Pesanan - LEGIT CHEMICAL')
@section('page_title', 'Riwayat Pesanan')

@section('content')

<div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 14px; background: #FFFFFF;">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h5 class="fw-bold text-dark font-poppins mb-1">
                <i class="bi bi-receipt text-primary me-2"></i>Riwayat &amp; Arsip Pesanan
            </h5>
            <p class="text-muted small mb-0">Daftar riwayat seluruh pesanan dan konsultasi pelanggan yang tercatat di sistem.</p>
        </div>
    </div>

    <!-- FILTER & SEARCH FORM -->
    <form action="{{ route('admin.riwayat_pesanan.index') }}" method="GET" class="row g-3 mb-4 align-items-center">
        <!-- Search Input -->
        <div class="col-12 col-md-5 col-lg-5">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0 text-muted">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="Cari Kode Pesanan (misal: ORD-...)" value="{{ request('search') }}">
            </div>
        </div>

        <!-- Status Filter Select -->
        <div class="col-12 col-md-4 col-lg-4">
            <div class="input-group">
                <label class="input-group-text bg-light text-muted small" for="statusFilter">Status</label>
                <select name="status" id="statusFilter" class="form-select" onchange="this.form.submit()">
                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>Semua Status</option>
                    <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    <option value="konsultasi" {{ request('status') == 'konsultasi' ? 'selected' : '' }}>Konsultasi Baru</option>
                    <option value="menunggu_konfirmasi" {{ request('status') == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                </select>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="col-12 col-md-3 col-lg-3 d-flex gap-2">
            <button type="submit" class="btn btn-navy w-100 py-2">
                <i class="bi bi-funnel me-1"></i> Filter
            </button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.riwayat_pesanan.index') }}" class="btn btn-outline-secondary py-2" title="Reset Filter">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            @endif
        </div>
    </form>

    <!-- TABLE RIWAYAT PESANAN -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 60px;" class="text-center">No</th>
                    <th scope="col">Kode Pesanan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah Item</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $index => $ord)
                    <tr>
                        <td class="text-center text-muted fw-semibold">
                            {{ $orders->firstItem() ? ($orders->firstItem() + $index) : ($index + 1) }}
                        </td>
                        <td>
                            <span class="fw-bold font-poppins text-dark">#{{ $ord->order_code }}</span>
                        </td>
                        <td>
                            <div class="small fw-semibold text-dark">{{ $ord->created_at->format('d M Y') }}</div>
                            <div class="text-muted" style="font-size: 0.78rem;"><i class="bi bi-clock me-1"></i>{{ $ord->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1">
                                <i class="bi bi-box me-1 text-secondary"></i>{{ $ord->orderDetails->count() }} Produk ({{ $ord->orderDetails->sum('quantity') }} Qty)
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
                        <td colspan="7" class="text-center text-muted py-5">
                            <div class="mb-2">
                                <i class="bi bi-receipt-cutoff fs-1 text-secondary opacity-50"></i>
                            </div>
                            <h6 class="fw-bold text-dark">Tidak Ada Riwayat Pesanan</h6>
                            <p class="small text-muted mb-0">Belum ada pesanan yang sesuai dengan kriteria pencarian atau filter Anda.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-4 pt-3 border-top">
        <div class="small text-muted">
            Menampilkan {{ $orders->firstItem() ?? 0 }} - {{ $orders->lastItem() ?? 0 }} dari total {{ $orders->total() }} pesanan
        </div>
        <div>
            {{ $orders->links() }}
        </div>
    </div>
</div>

@endsection
