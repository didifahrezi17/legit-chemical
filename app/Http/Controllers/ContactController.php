<?php

namespace App\Http\Controllers;

use App\Services\WhatsAppService;

class ContactController extends Controller
{
    public function index()
    {
        $waAdminNumber = env('WHATSAPP_ADMIN', '6281234567890');
        $waGeneralUrl = WhatsAppService::generateUrl('Halo Admin Legit Chemical, saya ingin bertanya seputar produk dan layanan Anda.');

        return view('user.contact', compact('waAdminNumber', 'waGeneralUrl'));
    }
}
