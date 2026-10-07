@extends('layouts.admin')

@section('title', 'Kelola Pesanan & Konsultasi - LEGIT CHEMICAL')
@section('page_title', 'Pesanan / Konsultasi')

@section('content')
<div class="card border-0 shadow-sm p-4" style="border-radius: 12px; background: #FFFFFF;">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <h5 class="fw-bold text-dark font-poppins mb-0">Daftar Konsultasi &amp; Pesanan</h5>
    </div>

    <!-- FILTER & SEARCH -->
    <form action="{{ route('admin.pesanan.index') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-5 col-lg-6">
            <input type="text" name="search" class="form-control" placeholder="Cari Kode Order (misal: ORD-2026...)" value="{{ request('search') }}">
        </div>
        <div class="col-md-4 col-lg-4">
            <select name="status" class="form-select" onchange="this.form.submit()">
                <option value="">-- Semua Status --</option>
                <option value="konsultasi" {{ request('status') == 'konsultasi' ? 'selected' : '' }}>Konsultasi</option>
                <option value="menunggu_konfirmasi" {{ request('status') == 'menunggu_konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>
        </div>
        <div class="col-md-3 col-lg-2">
            <button type="submit" class="btn btn-secondary w-100"><i class="bi bi-search me-1"></i> Filter</button>
        </div>
    </form>

    <!-- TABLE -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col">Kode Order</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah Produk</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center" style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $ord)
                    <tr>
                        <td class="fw-bold text-dark">#{{ $ord->order_code }}</td>
                        <td class="small text-muted">{{ $ord->created_at->format('d/m/Y H:i') }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $ord->orderDetails->count() }} Jenis Item</span></td>
                        <td class="fw-bold text-primary">{{ $ord->formatted_total }}</td>
                        <td><span class="badge {{ $ord->status_badge_class }}">{{ $ord->status_label }}</span></td>
                        <td class="text-center">
                            <a href="{{ route('admin.pesanan.show', $ord->id) }}" class="btn btn-navy btn-sm px-3 py-1 font-poppins fw-semibold" style="font-size: 0.82rem;">
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada pesanan / konsultasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
