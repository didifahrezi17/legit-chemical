@extends('layouts.admin')

@section('title', 'Detail Produk Admin - LEGIT CHEMICAL')
@section('page_title', 'Detail Produk')

@section('content')
<div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 12px; background: #FFFFFF; max-width: 900px;">
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h5 class="fw-bold text-dark font-poppins mb-0">{{ $product->name }}</h5>
        <div>
            <a href="{{ route('admin.produk.edit', $product->id) }}" class="btn btn-warning btn-sm me-1"><i class="bi bi-pencil"></i> Edit</a>
            <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4 text-center">
            <div class="border rounded p-2 bg-light mb-2">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" style="max-height: 250px; object-fit: contain;">
                @else
                    <img src="https://via.placeholder.com/300/F8FAFC/0B3B82?text=LC" class="img-fluid rounded">
                @endif
            </div>
            <span class="badge {{ $product->stock_badge_class }} px-3 py-2 fs-6">{{ $product->stock_status }} ({{ $product->stock }} Pcs)</span>
        </div>

        <div class="col-md-8">
            <table class="table table-borderless">
                <tr>
                    <td style="width: 140px;" class="fw-semibold text-muted">Kategori</td>
                    <td class="fw-bold text-dark">{{ $product->category->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="fw-semibold text-muted">Harga</td>
                    <td class="fw-bold text-primary fs-5">{{ $product->formatted_price }}</td>
                </tr>
                <tr>
                    <td class="fw-semibold text-muted">Status Catalog</td>
                    <td><span class="badge {{ $product->status == 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($product->status) }}</span></td>
                </tr>
                <tr>
                    <td class="fw-semibold text-muted">Deskripsi</td>
                    <td class="text-secondary" style="white-space: pre-line;">{{ $product->description ?: '-' }}</td>
                </tr>
                <tr>
                    <td class="fw-semibold text-muted">Spesifikasi</td>
                    <td class="text-secondary" style="white-space: pre-line;">{{ $product->specifications ?: '-' }}</td>
                </tr>
                <tr>
                    <td class="fw-semibold text-muted">Manfaat</td>
                    <td class="text-secondary" style="white-space: pre-line;">{{ $product->benefits ?: '-' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- RIWAYAT STOK PRODUK -->
<div class="card border-0 shadow-sm p-4" style="border-radius: 12px; background: #FFFFFF; max-width: 900px;">
    <h6 class="fw-bold text-dark font-poppins mb-3">Riwayat Perubahan Stok Produk Ini</h6>
    <div class="table-responsive">
        <table class="table table-sm align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Jumlah</th>
                    <th>Stok Sebelum</th>
                    <th>Stok Sesudah</th>
                    <th>Admin</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($product->stockHistories as $h)
                    <tr>
                        <td class="small">{{ $h->created_at->format('d/m/Y H:i') }}</td>
                        <td><span class="badge {{ $h->type_badge_class }}">{{ ucfirst($h->type) }}</span></td>
                        <td class="fw-bold">{{ $h->quantity }}</td>
                        <td>{{ $h->stock_before }}</td>
                        <td class="fw-bold text-primary">{{ $h->stock_after }}</td>
                        <td class="small">{{ $h->admin->name ?? 'Sistem' }}</td>
                        <td class="small text-muted">{{ $h->note ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-3">Belum ada riwayat stok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
