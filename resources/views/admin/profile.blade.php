@extends('layouts.admin')

@section('title', 'Profil Admin - LEGIT CHEMICAL')
@section('page_title', 'Profil Admin')

@section('content')
<div class="card border-0 shadow-sm p-4" style="border-radius: 12px; background: #FFFFFF; max-width: 700px;">
    <h5 class="fw-bold text-dark font-poppins mb-4">Pengaturan Akun Profil Admin</h5>

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $admin->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="username" class="form-label fw-semibold">Username <span class="text-danger">*</span></label>
            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $admin->username) }}" required>
            @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $admin->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr class="my-4 border-secondary-subtle">
        <h6 class="fw-bold text-dark font-poppins mb-3">Ubah Password (Opsional)</h6>

        <div class="mb-3">
            <label for="current_password" class="form-label fw-semibold">Password Saat Ini</label>
            <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Masukkan password lama jika ingin mengubah">
            @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <label for="password" class="form-label fw-semibold">Password Baru</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 6 karakter">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Ketik ulang password baru">
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary px-4 fw-semibold" style="background-color: var(--admin-navy); border-color: var(--admin-navy);">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
