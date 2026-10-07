@extends('layouts.admin')

@section('title', 'Tambah Produk - LEGIT CHEMICAL')
@section('page_title', 'Tambah Produk Baru')

@section('content')
<div class="card border-0 shadow-sm p-4" style="border-radius: 12px; background: #FFFFFF; max-width: 850px;">
    <h5 class="fw-bold text-dark font-poppins mb-4">Form Tambah Produk</h5>

    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-3">
            <div class="col-md-8">
                <label for="name" class="form-label fw-semibold">Nama Produk <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Asam Sulfat 98%" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="category_id" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="price" class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" placeholder="65000" min="0" required oninput="calcDiscount()">
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="discount_percentage" class="form-label fw-semibold">
                    Diskon (%) <span class="text-muted fw-normal small">(0 = tanpa diskon)</span>
                </label>
                <div class="input-group">
                    <input type="number" name="discount_percentage" id="discount_percentage"
                           class="form-control @error('discount_percentage') is-invalid @enderror"
                           value="{{ old('discount_percentage', 0) }}" min="0" max="100" placeholder="0"
                           oninput="calcDiscount()">
                    <span class="input-group-text">%</span>
                </div>
                @error('discount_percentage')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div id="discountPreview" class="mt-1 small text-success fw-semibold" style="display:none;"></div>
            </div>

            <div class="col-md-4">
                <label for="stock" class="form-label fw-semibold">Stok Awal <span class="text-danger">*</span></label>
                <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 0) }}" min="0" required>
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label fw-semibold">Status Status <span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-select">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="col-md-12">
                <label for="image" class="form-label fw-semibold">Foto Produk (Maks 2MB)</label>
                <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="description" class="form-label fw-semibold">Deskripsi Produk</label>
                <textarea name="description" id="description" rows="3" class="form-control" placeholder="Penjelasan detail tentang produk">{{ old('description') }}</textarea>
            </div>

            <div class="col-md-6">
                <label for="specifications" class="form-label fw-semibold">Spesifikasi</label>
                <textarea name="specifications" id="specifications" rows="3" class="form-control" placeholder="• Kemurnian: 98%&#10;• Bentuk: Cair">{{ old('specifications') }}</textarea>
            </div>

            <div class="col-md-6">
                <label for="benefits" class="form-label fw-semibold">Manfaat / Kegunaan</label>
                <textarea name="benefits" id="benefits" rows="3" class="form-control" placeholder="Kegunaan produk dalam industri">{{ old('benefits') }}</textarea>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary px-4 fw-semibold" style="background-color: var(--admin-navy); border-color: var(--admin-navy);">Simpan Produk</button>
            <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary px-4">Batal</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function calcDiscount() {
        const price = parseFloat(document.getElementById('price').value) || 0;
        const disc  = parseInt(document.getElementById('discount_percentage').value) || 0;
        const preview = document.getElementById('discountPreview');
        if (price > 0 && disc > 0) {
            const final = Math.round(price * (1 - disc / 100));
            const saved = price - final;
            const fmt = n => 'Rp' + n.toLocaleString('id-ID');
            preview.style.display = 'block';
            preview.innerHTML = `✅ Harga jual: <strong>${fmt(final)}</strong> &nbsp; <span class="text-danger">(hemat ${fmt(saved)})</span>`;
        } else {
            preview.style.display = 'none';
        }
    }
</script>
@endpush
