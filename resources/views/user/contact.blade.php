@extends('layouts.app')

@section('title', 'Kontak Kami - LEGIT CHEMICAL')

@section('content')
<div class="container py-5">
    <div class="mb-5 text-center" style="max-width: 650px; margin: 0 auto;">
        <h2 class="fw-bold text-dark font-poppins mb-2 display-6">Hubungi LEGIT CHEMICAL</h2>
        <p class="text-secondary fs-5">Ada pertanyaan seputar produk, spesifikasi, atau ingin berkonsultasi mengenai pemesanan? Tim kami siap melayani Anda.</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 12px; background: #FFFFFF;">
                <h4 class="fw-bold text-dark font-poppins mb-4">Informasi Kontak</h4>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background-color: var(--primary-navy);">
                        <i class="bi bi-geo-alt fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Alamat Kantor &amp; Gudang</h6>
                        <p class="text-muted small mb-0">Jl. Soekarno Hatta No. 123, Pekanbaru, Riau, Indonesia</p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background-color: var(--wa-green);">
                        <i class="bi bi-whatsapp fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">WhatsApp Admin</h6>
                        <p class="text-muted small mb-1">+{{ $waAdminNumber }}</p>
                        <a href="{{ $waGeneralUrl }}" target="_blank" class="btn btn-wa btn-sm px-3 py-1 text-white text-decoration-none">
                            <i class="bi bi-chat-dots me-1"></i> Chat WhatsApp Sekarang
                        </a>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background-color: var(--primary-blue);">
                        <i class="bi bi-envelope fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Email Resmi</h6>
                        <p class="text-muted small mb-0">info@legitchemical.com</p>
                    </div>
                </div>

                <div class="d-flex align-items-start gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white flex-shrink-0" style="width: 48px; height: 48px; background-color: #64748B;">
                        <i class="bi bi-clock fs-5"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-1">Jam Operasional</h6>
                        <p class="text-muted small mb-0">Senin - Sabtu: 08:00 - 17:00 WIB<br>Minggu &amp; Libur Nasional: Tutup</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 12px; background: #FFFFFF;">
                <h4 class="fw-bold text-dark font-poppins mb-3">Lokasi Gudang Kami</h4>
                <!-- Google Maps Embed Placeholder -->
                <div class="ratio ratio-16x9 rounded-3 overflow-hidden border">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127668.04353457002!2d101.37803362624403!3d0.5104445831558235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ab860d5e12f3%3A0xd67a30cf191456d9!2sPekanbaru%2C%20Pekanbaru%20City%2C%20Riau!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
