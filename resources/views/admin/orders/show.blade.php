@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $order->order_code . ' - LEGIT CHEMICAL')
@section('page_title', 'Detail Pesanan')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 12px; background: #FFFFFF;">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <div>
                    <h5 class="fw-bold text-dark font-poppins mb-1">Kode Order: #{{ $order->order_code }}</h5>
                    <span class="text-muted small"><i class="bi bi-clock me-1"></i> Waktu Konsultasi: {{ $order->created_at->format('d F Y, H:i:s') }}</span>
                </div>
                <div>
                    <span class="badge {{ $order->status_badge_class }} fs-6 px-3 py-2">{{ $order->status_label }}</span>
                </div>
            </div>

            <!-- PRODUCT ITEMS TABLE -->
            <h6 class="fw-bold text-dark font-poppins mb-3">Daftar Produk yang Dikonsultasikan</h6>
            <div class="table-responsive mb-4">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th class="text-center">Jumlah</th>
                            <th>Stok Saat Ini</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $detail)
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark">{{ $detail->product->name ?? 'Produk Dihapus' }}</div>
                                    <span class="text-muted small">{{ $detail->product->category->name ?? '-' }}</span>
                                </td>
                                <td>{{ $detail->formatted_price }}</td>
                                <td class="text-center fw-bold">{{ $detail->quantity }}</td>
                                <td>
                                    @if($detail->product)
                                        <span class="badge {{ $detail->product->stock_badge_class }}">
                                            {{ $detail->product->stock }} Pcs
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-end fw-bold text-primary">{{ $detail->formatted_subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <td colspan="4" class="fw-bold text-end">Total Estimasi:</td>
                            <td class="text-end fw-bold fs-5 text-primary">{{ $order->formatted_total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @if($order->notes)
                <div class="alert alert-light border p-3 rounded-3 mb-0">
                    <span class="fw-bold text-dark d-block mb-1"><i class="bi bi-chat-left-text me-1"></i> Catatan:</span>
                    <span class="text-secondary small">{{ $order->notes }}</span>
                </div>
            @endif
        </div>
    </div>

    <!-- ACTION CONTROL CARD -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 12px; background: #FFFFFF;">
            <h5 class="fw-bold text-dark font-poppins mb-3">Aksi Status Pesanan</h5>

            <div class="alert alert-info py-2 small mb-4">
                <i class="bi bi-info-circle me-1"></i>
                Stok produk <strong>TIDAK BERKURANG</strong> pada status <em>Konsultasi</em>. Stok hanya berkurang saat Anda menekan <strong>Konfirmasi Pesanan</strong>.
            </div>

            <div class="d-flex flex-column gap-3">
                <!-- KONFIRMASI PESANAN (DEDUCT STOCK) -->
                @if($order->status !== 'dikonfirmasi' && $order->status !== 'selesai' && $order->status !== 'dibatalkan')
                    <form action="{{ route('admin.pesanan.konfirmasi', $order->id) }}" method="POST" id="confirmOrderForm">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success w-100 py-2.5 font-poppins fw-bold shadow-sm">
                            <i class="bi bi-check-circle-fill me-2"></i> Konfirmasi Pesanan (Kurangi Stok)
                        </button>
                    </form>
                @elseif($order->status === 'dikonfirmasi')
                    <div class="alert alert-success py-2 small mb-0">
                        <i class="bi bi-check-all me-1"></i> Pesanan ini sudah dikonfirmasi. Stok telah berkurang.
                    </div>
                @endif

                <!-- TANDAI SELESAI -->
                @if($order->status === 'dikonfirmasi')
                    <form action="{{ route('admin.pesanan.selesai', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary w-100 py-2 font-poppins fw-semibold" style="background-color: var(--admin-navy); border-color: var(--admin-navy);">
                            <i class="bi bi-box-seam me-2"></i> Tandai Pesanan Selesai
                        </button>
                    </form>
                @endif

                <!-- BATALKAN PESANAN -->
                @if($order->status !== 'selesai' && $order->status !== 'dibatalkan')
                    <form action="{{ route('admin.pesanan.batal', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-outline-danger w-100 py-2 fw-semibold">
                            <i class="bi bi-x-circle me-2"></i> Batalkan Pesanan
                        </button>
                    </form>
                @endif

                <hr class="my-2 border-secondary-subtle">

                <!-- WHATSAPP ADMIN BUTTON -->
                @php
                    $waMsg = "Halo, ini Admin Legit Chemical mengonfirmasi pesanan #{$order->order_code}.\nTotal: {$order->formatted_total}.";
                    $waUrl = \App\Services\WhatsAppService::generateUrl($waMsg);
                @endphp
                <a href="{{ $waUrl }}" target="_blank" class="btn btn-wa w-100 py-2 fw-bold text-center">
                    <i class="bi bi-whatsapp me-2"></i> Hubungi Pembeli via WA
                </a>

                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-light w-100 text-muted border">
                    Kembali ke Daftar Pesanan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
