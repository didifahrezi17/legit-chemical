<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\File;

class GenerateProductImages
{
    public static function generate(): void
    {
        $dir = storage_path('app/public/products');
        if (! File::exists($dir)) {
            File::makeDirectory($dir, 0777, true, true);
        }

        $products = [
            'asam_sulfat.jpg' => self::svgAsamSulfat(),
            'soda_api.jpg' => self::svgSodaApi(),
            'caustic_soda.jpg' => self::svgCausticSoda(),
            'engsel_pintu.jpg' => self::svgEngselPintu(),
            'handle_pintu.jpg' => self::svgHandlePintu(),
            'baut_stainless.jpg' => self::svgBautStainless(),
            'bibit_kelapa.jpg' => self::svgBibitKelapa(),
            'bibit_durian.jpg' => self::svgBibitDurian(),
            'bibit_cabai.jpg' => self::svgBibitCabai(),
            'deterjen_bubuk.jpg' => self::svgDeterjenBubuk(),
            'pembersih_lantai.jpg' => self::svgPembersihLantai(),
            'shampoo_mobil.jpg' => self::svgShampooMobil(),
        ];

        foreach ($products as $filename => $svgContent) {
            File::put($dir.'/'.$filename, $svgContent);
        }
    }

    private static function svgAsamSulfat(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="asBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#F8FAFC"/><stop offset="100%" stop-color="#E2E8F0"/></linearGradient>
                <linearGradient id="asCan" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#072552"/><stop offset="50%" stop-color="#0B3B82"/><stop offset="100%" stop-color="#1E40AF"/></linearGradient>
                <linearGradient id="asAmb" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#F59E0B"/><stop offset="100%" stop-color="#D97706"/></linearGradient>
                <filter id="asSh" x="-10%" y="-10%" width="120%" height="120%"><feDropShadow dx="0" dy="12" stdDeviation="16" flood-color="#0B3B82" flood-opacity="0.15"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#asBg)" rx="24"/>
            <ellipse cx="250" cy="440" rx="160" ry="25" fill="#CBD5E1"/>
            
            <g filter="url(#asSh)">
                <rect x="150" y="150" width="200" height="260" rx="30" fill="url(#asCan)"/>
                <path d="M190 150 C190 100 310 100 310 150" fill="none" stroke="url(#asCan)" stroke-width="28" stroke-linecap="round"/>
                <path d="M190 150 C190 112 310 112 310 150" fill="none" stroke="#072552" stroke-width="12" stroke-linecap="round"/>
                <rect x="280" y="105" width="45" height="32" rx="6" fill="url(#asAmb)"/>
                <line x1="285" y1="115" x2="320" y2="115" stroke="#FFFFFF" stroke-width="2.5"/>
                <line x1="285" y1="123" x2="320" y2="123" stroke="#FFFFFF" stroke-width="2.5"/>

                <rect x="175" y="210" width="150" height="170" rx="12" fill="#FFFFFF"/>
                <rect x="175" y="210" width="150" height="10" fill="#DC2626"/>
                
                <g transform="translate(225, 235)">
                    <polygon points="25,0 50,25 25,50 0,25" fill="#FEF3C7" stroke="#DC2626" stroke-width="2.5"/>
                    <path d="M18 30 L32 30 M25 15 L25 26" stroke="#000" stroke-width="3" stroke-linecap="round"/>
                    <circle cx="25" cy="38" r="2.5" fill="#DC2626"/>
                </g>
                <text x="250" y="310" font-family="Arial, sans-serif" font-size="15" font-weight="900" fill="#0B3B82" text-anchor="middle">ASAM SULFAT</text>
                <text x="250" y="328" font-family="Arial, sans-serif" font-size="13" font-weight="bold" fill="#DC2626" text-anchor="middle">H2SO4 - 98% PURITY</text>
                <text x="250" y="348" font-family="Arial, sans-serif" font-size="10" font-weight="600" fill="#64748B" text-anchor="middle">NETTO: 25 LITER</text>
                <rect x="195" y="358" width="110" height="6" rx="3" fill="#E2E8F0"/>
            </g>
            <rect x="340" y="40" width="120" height="34" rx="8" fill="#DC2626"/>
            <text x="400" y="62" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">GRADE A 98%</text>
        </svg>';
    }

    private static function svgSodaApi(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="saBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#F0F9FF"/><stop offset="100%" stop-color="#E0F2FE"/></linearGradient>
                <linearGradient id="saBottle" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#FFFFFF"/><stop offset="50%" stop-color="#F8FAFC"/><stop offset="100%" stop-color="#E2E8F0"/></linearGradient>
                <linearGradient id="saCap" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#1E40AF"/><stop offset="100%" stop-color="#1D4ED8"/></linearGradient>
                <filter id="saSh"><feDropShadow dx="0" dy="12" stdDeviation="15" flood-color="#0284C7" flood-opacity="0.15"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#saBg)" rx="24"/>
            <ellipse cx="250" cy="435" rx="140" ry="22" fill="#BAE6FD" opacity="0.6"/>

            <g filter="url(#saSh)">
                <rect x="170" y="160" width="160" height="240" rx="20" fill="url(#saBottle)" stroke="#CBD5E1" stroke-width="2"/>
                <path d="M195 160 L195 125 L305 125 L305 160 Z" fill="url(#saBottle)" stroke="#CBD5E1" stroke-width="2"/>
                <rect x="185" y="95" width="130" height="35" rx="8" fill="url(#saCap)"/>
                
                <rect x="185" y="210" width="130" height="150" rx="10" fill="#0B3B82"/>
                <text x="250" y="245" font-family="Arial, sans-serif" font-size="16" font-weight="900" fill="#FBBF24" text-anchor="middle">SODA API</text>
                <text x="250" y="265" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">NaOH MURNI</text>
                <circle cx="250" cy="295" r="18" fill="#1565C0"/>
                <text x="250" y="300" font-family="Arial, sans-serif" font-size="10" font-weight="bold" fill="#FFFFFF" text-anchor="middle">99%</text>
                <text x="250" y="332" font-family="Arial, sans-serif" font-size="10" fill="#93C5FD" text-anchor="middle">PELET / KRISTAL 1KG</text>
                <rect x="205" y="342" width="90" height="4" rx="2" fill="#3B82F6"/>
            </g>
        </svg>';
    }

    private static function svgCausticSoda(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="csBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#F8FAFC"/><stop offset="100%" stop-color="#E2E8F0"/></linearGradient>
                <linearGradient id="csSack" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#FFFFFF"/><stop offset="100%" stop-color="#F1F5F9"/></linearGradient>
                <filter id="csSh"><feDropShadow dx="0" dy="12" stdDeviation="15" flood-color="#0F172A" flood-opacity="0.12"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#csBg)" rx="24"/>
            <ellipse cx="250" cy="440" rx="160" ry="24" fill="#CBD5E1"/>

            <g filter="url(#csSh)">
                <path d="M150 140 C150 120 350 120 350 140 L370 410 C370 425 350 435 250 435 C150 435 130 425 130 410 Z" fill="url(#csSack)" stroke="#94A3B8" stroke-width="2"/>
                <path d="M140 140 L360 140" stroke="#0B3B82" stroke-width="8" stroke-dasharray="10 4"/>
                
                <rect x="170" y="190" width="160" height="180" rx="10" fill="#EBF3FC" stroke="#0B3B82" stroke-width="2"/>
                <text x="250" y="230" font-family="Arial, sans-serif" font-size="16" font-weight="900" fill="#0B3B82" text-anchor="middle">CAUSTIC SODA</text>
                <text x="250" y="252" font-family="Arial, sans-serif" font-size="14" font-weight="bold" fill="#1565C0" text-anchor="middle">FLAKES 98%</text>
                <polygon points="250,265 270,285 250,305 230,285" fill="#F59E0B"/>
                <text x="250" y="290" font-family="Arial, sans-serif" font-size="11" font-weight="bold" fill="#FFFFFF" text-anchor="middle">LC</text>
                <text x="250" y="330" font-family="Arial, sans-serif" font-size="13" font-weight="bold" fill="#0F172A" text-anchor="middle">NETTO: 25 KG</text>
                <text x="250" y="350" font-family="Arial, sans-serif" font-size="9" fill="#64748B" text-anchor="middle">INDUSTRIAL CHEMICAL GRADE</text>
            </g>
        </svg>';
    }

    private static function svgEngselPintu(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="epBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#F8FAFC"/><stop offset="100%" stop-color="#E2E8F0"/></linearGradient>
                <linearGradient id="epMetal" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#94A3B8"/><stop offset="25%" stop-color="#F1F5F9"/><stop offset="50%" stop-color="#CBD5E1"/><stop offset="75%" stop-color="#FFFFFF"/><stop offset="100%" stop-color="#64748B"/></linearGradient>
                <linearGradient id="epPin" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#475569"/><stop offset="50%" stop-color="#94A3B8"/><stop offset="100%" stop-color="#334155"/></linearGradient>
                <filter id="epSh"><feDropShadow dx="0" dy="12" stdDeviation="15" flood-color="#0F172A" flood-opacity="0.15"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#epBg)" rx="24"/>
            <ellipse cx="250" cy="430" rx="150" ry="20" fill="#CBD5E1"/>

            <g filter="url(#epSh)">
                <rect x="140" y="120" width="100" height="260" rx="6" fill="url(#epMetal)" stroke="#64748B"/>
                <circle cx="180" cy="160" r="10" fill="#334155" stroke="#94A3B8" stroke-width="2"/>
                <circle cx="180" cy="250" r="10" fill="#334155" stroke="#94A3B8" stroke-width="2"/>
                <circle cx="180" cy="340" r="10" fill="#334155" stroke="#94A3B8" stroke-width="2"/>

                <rect x="260" y="120" width="100" height="260" rx="6" fill="url(#epMetal)" stroke="#64748B"/>
                <circle cx="320" cy="160" r="10" fill="#334155" stroke="#94A3B8" stroke-width="2"/>
                <circle cx="320" cy="250" r="10" fill="#334155" stroke="#94A3B8" stroke-width="2"/>
                <circle cx="320" cy="340" r="10" fill="#334155" stroke="#94A3B8" stroke-width="2"/>

                <rect x="235" y="100" width="30" height="300" rx="10" fill="url(#epPin)" stroke="#1E293B"/>
                <circle cx="250" cy="110" r="12" fill="#E2E8F0"/>
                <circle cx="250" cy="390" r="12" fill="#E2E8F0"/>
            </g>
            <rect x="330" y="40" width="130" height="34" rx="8" fill="#0B3B82"/>
            <text x="395" y="62" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">SUS 304 (4 INCH)</text>
        </svg>';
    }

    private static function svgHandlePintu(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="hpBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#F8FAFC"/><stop offset="100%" stop-color="#E2E8F0"/></linearGradient>
                <linearGradient id="hpSilver" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#F1F5F9"/><stop offset="35%" stop-color="#94A3B8"/><stop offset="70%" stop-color="#FFFFFF"/><stop offset="100%" stop-color="#475569"/></linearGradient>
                <filter id="hpSh"><feDropShadow dx="0" dy="14" stdDeviation="16" flood-color="#0F172A" flood-opacity="0.18"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#hpBg)" rx="24"/>
            <ellipse cx="250" cy="430" rx="150" ry="20" fill="#CBD5E1"/>

            <g filter="url(#hpSh)">
                <rect x="170" y="80" width="70" height="340" rx="12" fill="url(#hpSilver)" stroke="#475569" stroke-width="2"/>
                <circle cx="205" cy="140" r="18" fill="#334155" stroke="#CBD5E1" stroke-width="2"/>
                <rect x="200" y="270" width="10" height="30" rx="5" fill="#1E293B"/>

                <rect x="190" y="125" width="210" height="32" rx="8" fill="url(#hpSilver)" stroke="#334155" stroke-width="2"/>
                <circle cx="205" cy="141" r="8" fill="#E2E8F0"/>
            </g>
            <rect x="30" y="40" width="140" height="34" rx="8" fill="#475569"/>
            <text x="100" y="62" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">SILVER SATIN 30CM</text>
        </svg>';
    }

    private static function svgBautStainless(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="btBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#F8FAFC"/><stop offset="100%" stop-color="#E2E8F0"/></linearGradient>
                <linearGradient id="btMetal" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#64748B"/><stop offset="40%" stop-color="#F8FAFC"/><stop offset="70%" stop-color="#CBD5E1"/><stop offset="100%" stop-color="#475569"/></linearGradient>
                <filter id="btSh"><feDropShadow dx="0" dy="12" stdDeviation="15" flood-color="#0F172A" flood-opacity="0.15"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#btBg)" rx="24"/>
            <ellipse cx="250" cy="430" rx="140" ry="20" fill="#CBD5E1"/>

            <g filter="url(#btSh)" transform="translate(0, 20)">
                <polygon points="170,120 250,75 330,120 330,170 250,215 170,170" fill="url(#btMetal)" stroke="#334155" stroke-width="3"/>
                <ellipse cx="250" cy="145" rx="45" ry="25" fill="#334155" opacity="0.2"/>

                <rect x="220" y="195" width="60" height="190" fill="url(#btMetal)" stroke="#334155" stroke-width="2"/>
                <path d="M220 220 L280 235 M220 245 L280 260 M220 270 L280 285 M220 295 L280 310 M220 320 L280 335 M220 345 L280 360 M220 370 L280 385" stroke="#334155" stroke-width="5"/>
                <path d="M220 385 L250 405 L280 385 Z" fill="url(#btMetal)" stroke="#334155" stroke-width="2"/>
            </g>
            <rect x="330" y="40" width="130" height="34" rx="8" fill="#334155"/>
            <text x="395" y="62" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">STAINLESS M8 x 40</text>
        </svg>';
    }

    private static function svgBibitKelapa(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="bkBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#F0FDF4"/><stop offset="100%" stop-color="#DCFCE7"/></linearGradient>
                <linearGradient id="bkLeaf" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#4ADE80"/><stop offset="100%" stop-color="#15803D"/></linearGradient>
                <filter id="bkSh"><feDropShadow dx="0" dy="12" stdDeviation="15" flood-color="#166534" flood-opacity="0.15"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#bkBg)" rx="24"/>
            <ellipse cx="250" cy="440" rx="150" ry="22" fill="#BBF7D0"/>

            <g filter="url(#bkSh)">
                <ellipse cx="250" cy="370" rx="75" ry="60" fill="#78350F" stroke="#451A03" stroke-width="3"/>
                <path d="M250 320 C250 220 220 120 140 90 C200 130 250 200 250 320 Z" fill="url(#bkLeaf)"/>
                <path d="M250 320 C250 200 290 100 370 70 C320 120 270 200 250 320 Z" fill="url(#bkLeaf)"/>
                <path d="M250 320 C250 160 250 90 250 60 C265 110 265 200 250 320 Z" fill="#22C55E"/>
                
                <ellipse cx="250" cy="350" rx="20" ry="10" fill="#B45309"/>
                <circle cx="250" cy="335" r="8" fill="#15803D"/>
            </g>
            <rect x="320" y="40" width="140" height="34" rx="8" fill="#16A34A"/>
            <text x="390" y="62" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">KELAPA GENJAH</text>
        </svg>';
    }

    private static function svgBibitDurian(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="bdBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#FEFCE8"/><stop offset="100%" stop-color="#FEF08A"/></linearGradient>
                <linearGradient id="bdGreen" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#84CC16"/><stop offset="100%" stop-color="#4D7C0F"/></linearGradient>
                <filter id="bdSh"><feDropShadow dx="0" dy="12" stdDeviation="15" flood-color="#854D0E" flood-opacity="0.15"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#bdBg)" rx="24"/>
            <ellipse cx="250" cy="440" rx="150" ry="22" fill="#E2E8F0"/>

            <g filter="url(#bdSh)">
                <path d="M190 320 L210 420 L290 420 L310 320 Z" fill="#1E293B"/>
                <ellipse cx="250" cy="320" rx="60" ry="14" fill="#334155"/>
                <path d="M250 320 C250 240 240 180 250 120" stroke="#78350F" stroke-width="12" stroke-linecap="round"/>

                <path d="M245 220 C200 200 160 210 140 230 C165 245 210 240 245 220 Z" fill="url(#bdGreen)"/>
                <path d="M255 200 C300 180 340 190 360 210 C335 225 290 220 255 200 Z" fill="url(#bdGreen)"/>
                <path d="M245 150 C210 130 180 140 160 160 C180 175 220 170 245 150 Z" fill="url(#bdGreen)"/>
                <path d="M255 130 C290 110 320 120 340 140 C320 155 280 150 255 130 Z" fill="url(#bdGreen)"/>
                <path d="M250 120 C240 90 250 60 250 50 C260 70 260 100 250 120 Z" fill="#65A30D"/>
            </g>
            <rect x="300" y="40" width="160" height="34" rx="8" fill="#CA8A04"/>
            <text x="380" y="62" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">MUSANG KING OKULASI</text>
        </svg>';
    }

    private static function svgBibitCabai(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="bcBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#FEF2F2"/><stop offset="100%" stop-color="#FEE2E2"/></linearGradient>
                <linearGradient id="bcRed" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#EF4444"/><stop offset="100%" stop-color="#991B1B"/></linearGradient>
                <filter id="bcSh"><feDropShadow dx="0" dy="12" stdDeviation="15" flood-color="#991B1B" flood-opacity="0.15"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#bcBg)" rx="24"/>
            <ellipse cx="250" cy="440" rx="140" ry="20" fill="#FECACA"/>

            <g filter="url(#bcSh)">
                <path d="M190 320 L210 420 L290 420 L310 320 Z" fill="#1E293B"/>
                <ellipse cx="250" cy="320" rx="60" ry="14" fill="#334155"/>
                <path d="M250 320 C250 250 250 180 250 140" stroke="#15803D" stroke-width="10" stroke-linecap="round"/>

                <path d="M250 230 C200 200 170 210 150 230 C180 250 220 240 250 230 Z" fill="#22C55E"/>
                <path d="M250 180 C300 150 330 160 350 180 C320 200 280 190 250 180 Z" fill="#22C55E"/>
                
                <path d="M210 240 C200 270 190 290 205 310 C210 290 215 270 210 240 Z" fill="url(#bcRed)"/>
                <path d="M285 200 C300 230 310 260 295 280 C290 260 280 230 285 200 Z" fill="url(#bcRed)"/>
            </g>
            <rect x="320" y="40" width="140" height="34" rx="8" fill="#DC2626"/>
            <text x="390" y="62" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">CABAI RAWIT UNGGUL</text>
        </svg>';
    }

    private static function svgDeterjenBubuk(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="dbBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#F5F3FF"/><stop offset="100%" stop-color="#EDE9FE"/></linearGradient>
                <linearGradient id="dbPouch" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#7C3AED"/><stop offset="100%" stop-color="#4C1D95"/></linearGradient>
                <filter id="dbSh"><feDropShadow dx="0" dy="14" stdDeviation="16" flood-color="#6D28D9" flood-opacity="0.18"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#dbBg)" rx="24"/>
            <ellipse cx="250" cy="440" rx="150" ry="22" fill="#DDD6FE"/>

            <g filter="url(#dbSh)">
                <path d="M160 140 L340 140 L360 410 C360 425 340 435 250 435 C160 435 140 425 140 410 Z" fill="url(#dbPouch)"/>
                <path d="M150 140 L350 140" stroke="#F59E0B" stroke-width="8" stroke-dasharray="12 4"/>

                <circle cx="250" cy="240" r="55" fill="#FFFFFF" opacity="0.15"/>
                <circle cx="250" cy="240" r="40" fill="#FFFFFF"/>
                <path d="M235 240 L245 250 L265 230" stroke="#7C3AED" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>

                <text x="250" y="325" font-family="Arial, sans-serif" font-size="18" font-weight="900" fill="#FFFFFF" text-anchor="middle">DETERJEN BUBUK</text>
                <text x="250" y="348" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FDE047" text-anchor="middle">SPECIAL LAUNDRY FORMULA</text>
                <text x="250" y="375" font-family="Arial, sans-serif" font-size="13" font-weight="bold" fill="#FFFFFF" text-anchor="middle">NETTO: 1 KG</text>
                
                <circle cx="170" cy="200" r="10" fill="#C4B5FD" opacity="0.6"/>
                <circle cx="330" cy="220" r="14" fill="#C4B5FD" opacity="0.5"/>
                <circle cx="310" cy="180" r="8" fill="#C4B5FD" opacity="0.7"/>
            </g>
            <rect x="330" y="40" width="130" height="34" rx="8" fill="#7C3AED"/>
            <text x="395" y="62" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">LAUNDRY GRADE</text>
        </svg>';
    }

    private static function svgPembersihLantai(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="plBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#FFFBEB"/><stop offset="100%" stop-color="#FEF3C7"/></linearGradient>
                <linearGradient id="plBot" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#10B981"/><stop offset="50%" stop-color="#34D399"/><stop offset="100%" stop-color="#059669"/></linearGradient>
                <filter id="plSh"><feDropShadow dx="0" dy="14" stdDeviation="16" flood-color="#059669" flood-opacity="0.18"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#plBg)" rx="24"/>
            <ellipse cx="250" cy="440" rx="140" ry="20" fill="#FDE68A"/>

            <g filter="url(#plSh)">
                <path d="M180 180 C180 140 210 130 210 100 L290 100 C290 130 320 140 320 180 L320 400 C320 420 300 430 250 430 C200 430 180 420 180 400 Z" fill="url(#plBot)"/>
                <rect x="230" y="70" width="40" height="30" rx="6" fill="#F59E0B"/>

                <rect x="195" y="210" width="110" height="150" rx="10" fill="#FFFFFF"/>
                <text x="250" y="245" font-family="Arial, sans-serif" font-size="13" font-weight="900" fill="#065F46" text-anchor="middle">PEMBERSIH</text>
                <text x="250" y="262" font-family="Arial, sans-serif" font-size="15" font-weight="900" fill="#059669" text-anchor="middle">LANTAI</text>
                <circle cx="250" cy="295" r="20" fill="#D1FAE5"/>
                <path d="M250 282 C240 295 245 305 250 310 C255 305 260 295 250 282 Z" fill="#059669"/>
                <text x="250" y="335" font-family="Arial, sans-serif" font-size="10" font-weight="bold" fill="#0F172A" text-anchor="middle">AROMA PINUS SEGAR</text>
                <text x="250" y="350" font-family="Arial, sans-serif" font-size="9" fill="#64748B" text-anchor="middle">ANTI BAKTERI 99.9%</text>
            </g>
            <rect x="330" y="40" width="130" height="34" rx="8" fill="#059669"/>
            <text x="395" y="62" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">ANTI BAKTERI</text>
        </svg>';
    }

    private static function svgShampooMobil(): string
    {
        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="500" height="500" fill="none">
            <defs>
                <linearGradient id="smBg" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" stop-color="#EFF6FF"/><stop offset="100%" stop-color="#DBEAFE"/></linearGradient>
                <linearGradient id="smBot" x1="0%" y1="0%" x2="100%" y2="0%"><stop offset="0%" stop-color="#0F172A"/><stop offset="50%" stop-color="#1E293B"/><stop offset="100%" stop-color="#334155"/></linearGradient>
                <filter id="smSh"><feDropShadow dx="0" dy="14" stdDeviation="16" flood-color="#1E3A8A" flood-opacity="0.18"/></filter>
            </defs>
            <rect width="500" height="500" fill="url(#smBg)" rx="24"/>
            <ellipse cx="250" cy="440" rx="140" ry="20" fill="#BFDBFE"/>

            <g filter="url(#smSh)">
                <path d="M180 180 C180 135 220 125 220 95 L280 95 C280 125 320 135 320 180 L320 400 C320 420 300 430 250 430 C200 430 180 420 180 400 Z" fill="url(#smBot)"/>
                <rect x="235" y="65" width="30" height="30" rx="5" fill="#DC2626"/>

                <rect x="195" y="200" width="110" height="170" rx="10" fill="#0B3B82"/>
                <text x="250" y="235" font-family="Arial, sans-serif" font-size="14" font-weight="900" fill="#FBBF24" text-anchor="middle">SHAMPOO MOBIL</text>
                <text x="250" y="252" font-family="Arial, sans-serif" font-size="10" font-weight="bold" fill="#FFFFFF" text-anchor="middle">HIGH GLOSS + WAX</text>
                
                <!-- Car Silhouette -->
                <path d="M225 285 L235 272 L265 272 L275 285 L280 292 L220 292 Z" fill="#38BDF8"/>
                <circle cx="235" cy="295" r="6" fill="#FFFFFF"/>
                <circle cx="265" cy="295" r="6" fill="#FFFFFF"/>

                <text x="250" y="325" font-family="Arial, sans-serif" font-size="10" font-weight="bold" fill="#FFFFFF" text-anchor="middle">TOUCHLESS FOAM</text>
                <text x="250" y="342" font-family="Arial, sans-serif" font-size="10" fill="#93C5FD" text-anchor="middle">ISI: 1 LITER</text>
            </g>
            <rect x="330" y="40" width="130" height="34" rx="8" fill="#1D4ED8"/>
            <text x="395" y="62" font-family="Arial, sans-serif" font-size="12" font-weight="bold" fill="#FFFFFF" text-anchor="middle">HIGH GLOSS WAX</text>
        </svg>';
    }
}
