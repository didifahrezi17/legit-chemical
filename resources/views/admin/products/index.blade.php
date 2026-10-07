@extends('layouts.admin')

@section('title', 'Kelola Produk - LEGIT CHEMICAL')
@section('page_title', 'Produk')

@section('content')
<div class="card border-0 shadow-sm p-4" style="border-radius: 12px; background: #FFFFFF;">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <h5 class="fw-bold text-dark font-poppins mb-0">Daftar Produk</h5>
        <a href="{{ route('admin.produk.create') }}" class="btn btn-primary px-3 py-2 fw-semibold" style="background-color: var(--admin-navy); border-color: var(--admin-navy);">
            <i class="bi bi-plus-lg me-1"></i> Tambah Produk
        </a>
    </div>

    <!-- FILTER & SEARCH -->
    <form action="{{ route('admin.produk.index') }}" method="GET" class="row g-2 mb-4">
        <div class="col-md-5 col-lg-6">
            <input type="text" name="search" class="form-control" placeholder="Cari nama produk..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4 col-lg-4">
            <select name="category_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Semua Kategori --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3 col-lg-2">
            <button type="submit" class="btn btn-secondary w-100"><i class="bi bi-search me-1"></i> Cari</button>
        </div>
    </form>

    <!-- TABLE MATCHING REFERENCE IMAGE -->
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 50px;">No</th>
                    <th scope="col" style="width: 70px;">Foto</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col" class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $prod)
                    <tr>
                        <td>{{ $products->firstItem() + $index }}</td>
                        <td>
                            <div class="rounded border p-1 text-center bg-light" style="width: 50px; height: 50px;">
                                @if($prod->image)
                                    <img src="{{ asset('storage/' . $prod->image) }}" alt="{{ $prod->name }}" class="img-fluid h-100 object-fit-cover rounded">
                                @else
                                    <img src="https://via.placeholder.com/50/F8FAFC/0B3B82?text=LC" alt="{{ $prod->name }}" class="img-fluid h-100 object-fit-cover rounded">
                                @endif
                            </div>
                        </td>
                        <td class="fw-bold text-dark">
                            <a href="{{ route('admin.produk.show', $prod->id) }}" class="text-decoration-none text-dark">
                                {{ $prod->name }}
                            </a>
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $prod->category->name ?? '-' }}</span></td>
                        <td class="fw-semibold text-primary">{{ $prod->formatted_price }}</td>
                        <td>
                            <span class="badge {{ $prod->stock_badge_class }}">{{ $prod->stock_status }} ({{ $prod->stock }})</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('admin.produk.edit', $prod->id) }}" class="btn btn-warning btn-sm text-dark px-2" title="Edit">
                                    Edit
                                </a>
                                <form action="{{ route('admin.produk.destroy', $prod->id) }}" method="POST" id="deleteProductForm{{ $prod->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm px-2" onclick="confirmDelete('deleteProductForm{{ $prod->id }}', 'Apakah Anda yakin ingin menghapus produk {{ $prod->name }}?')" title="Hapus">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
