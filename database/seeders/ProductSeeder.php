<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all()->keyBy('name');

        $products = [
            [
                'category_name' => 'Chemical',
                'name' => 'Asam Sulfat 98%',
                'price' => 65000,
                'stock' => 15,
                'image' => 'products/asam_sulfat.jpg',
                'description' => 'Asam sulfat 98% berkualitas tinggi, banyak digunakan untuk keperluan industri, pupuk, pengolahan air, dan berbagai aplikasi lainnya.',
                'specifications' => "• Kemurnian : 98%\n• Bentuk : Cair\n• Warna : Tidak berwarna\n• Kemasan : Jerigen 25 Liter\n• Asal : Lokal",
                'benefits' => 'Digunakan untuk kebutuhan industri, pembuatan pupuk, pengolahan air, aki, dan berbagai proses kimia lainnya.',
            ],
            [
                'category_name' => 'Chemical',
                'name' => 'Soda Api (NaOH)',
                'price' => 55000,
                'stock' => 12,
                'image' => 'products/soda_api.jpg',
                'description' => 'Natrium Hidroksida murni dalam bentuk pelet/kristal padat, ampuh melarutkan lemak dan menyumbat pada saluran pipa.',
                'specifications' => "• Kemurnian : 99%\n• Bentuk : Padat / Kristal\n• Warna : Putih\n• Kemasan : Bag 1 Kg",
                'benefits' => 'Pembersih saluran tersumbat, bahan pembuatan sabun industri, dan pengatur pH air.',
            ],
            [
                'category_name' => 'Chemical',
                'name' => 'Caustic Soda Flake',
                'price' => 60000,
                'stock' => 8,
                'image' => 'products/caustic_soda.jpg',
                'description' => 'Caustic Soda Flake grade industri untuk pembersihan alat berat, pengolahan tekstil, dan kimia proses.',
                'specifications' => "• Kemurnian : 98%\n• Bentuk : Flake / Serpihan\n• Kemasan : Sak 25 Kg",
                'benefits' => 'Efektif menghancurkan endapan organik, lemak keras, dan kerak pada instalasi industri.',
            ],
            [
                'category_name' => 'Hardware',
                'name' => 'Engsel Pintu Stainless',
                'price' => 18000,
                'stock' => 25,
                'image' => 'products/engsel_pintu.jpg',
                'description' => 'Engsel pintu berbahan stainless steel anti karat berkualitas tinggi, tahan lama dan berkapasitas beban berat.',
                'specifications' => "• Ukuran : 4 inch\n• Bahan : Stainless Steel 304\n• Ketebalan : 3 mm",
                'benefits' => 'Tahan cuaca, tidak mudah macet, dan cocok untuk pintu kayu maupun besi.',
            ],
            [
                'category_name' => 'Hardware',
                'name' => 'Handle Pintu Minimalis',
                'price' => 25000,
                'stock' => 20,
                'image' => 'products/handle_pintu.jpg',
                'description' => 'Handle pintu gaya modern minimalis dengan lapisan perak satin yang halus dan ergonomis.',
                'specifications' => "• Panjang : 30 cm\n• Warna : Silver Satin\n• Material : Alumunium Alloy",
                'benefits' => 'Menambah nilai estetika rumah dan memiliki ketahanan gores yang baik.',
            ],
            [
                'category_name' => 'Hardware',
                'name' => 'Baut Stainless',
                'price' => 2000,
                'stock' => 100,
                'image' => 'products/baut_stainless.jpg',
                'description' => 'Baut stainless presisi tinggi tahan karat untuk keperluan perkakas, mesin, dan bangunan.',
                'specifications' => "• Ukuran : M8 x 40mm\n• Material : Stainless Steel 316",
                'benefits' => 'Daya cengkeram kuat dan sangat cocok untuk penggunaan luar ruangan.',
            ],
            [
                'category_name' => 'Bahan & Bibit',
                'name' => 'Bibit Kelapa Genjah',
                'price' => 12000,
                'stock' => 4,
                'image' => 'products/bibit_kelapa.jpg',
                'description' => 'Bibit kelapa genjah pilihan, bersertifikat, cepat berbuah dan memiliki batang yang kokoh.',
                'specifications' => "• Tinggi : 50-70 cm\n• Asal Bibit : Semai Biji Unggul\n• Masa Berbuah : 3-4 Tahun",
                'benefits' => 'Produksi air kelapa manis berlimpah dan lebih cepat panen dibanding varietas lokal.',
            ],
            [
                'category_name' => 'Bahan & Bibit',
                'name' => 'Bibit Durian Musang',
                'price' => 35000,
                'stock' => 10,
                'image' => 'products/bibit_durian.jpg',
                'description' => 'Bibit durian Musang King asli hasil okulasi cabang unggul, cepat tumbuh dan adaptif.',
                'specifications' => "• Tinggi : 60-80 cm\n• Metode : Okulasi / Sambung Pucuk",
                'benefits' => 'Daging buah tebal, manis legit, biji kempes, serta tingkat keberhasilan tanam tinggi.',
            ],
            [
                'category_name' => 'Bahan & Bibit',
                'name' => 'Bibit Cabai Rawit',
                'price' => 10000,
                'stock' => 0,
                'image' => 'products/bibit_cabai.jpg',
                'description' => 'Bibit cabai rawit hijau dan merah unggul tahan hama penyakit.',
                'specifications' => "• Kemasan : Polybag Siap Tanam\n• Potensi Panen : Melimpah",
                'benefits' => 'Tahan musim hujan maupun kemarau.',
            ],
            [
                'category_name' => 'Laundry',
                'name' => 'Deterjen Bubuk',
                'price' => 22000,
                'stock' => 30,
                'image' => 'products/deterjen_bubuk.jpg',
                'description' => 'Deterjen konsentrat khusus laundry dengan konsentrasi tinggi perontok noda bandel.',
                'specifications' => "• Berat : 1 Kg\n• Busa : Rendah (Aman untuk mesin cuci front/top load)",
                'benefits' => 'Pakaian lebih bersih, wangi segar tahan lama, dan menjaga serat kain.',
            ],
            [
                'category_name' => 'Home Care',
                'name' => 'Pembersih Lantai',
                'price' => 16000,
                'stock' => 18,
                'image' => 'products/pembersih_lantai.jpg',
                'description' => 'Cairan pembersih dan disinfektan lantai dengan aroma pinus alami yang menyegarkan.',
                'specifications' => "• Isi : 1.5 Liter\n• Formula : Anti Bakteri 99.9%",
                'benefits' => 'Membunuh kuman, menghilangkan bau tidak sedap, dan membuat lantai kilap tidak lengket.',
            ],
            [
                'category_name' => 'Car Care',
                'name' => 'Shampoo Mobil',
                'price' => 35000,
                'stock' => 15,
                'image' => 'products/shampoo_mobil.jpg',
                'description' => 'Shampoo mobil dengan formula pH seimbang dan kandungan wax pelindung cat.',
                'specifications' => "• Kemasan : Botol 1 Liter\n• Formula : Touchless Foam & High Gloss",
                'benefits' => 'Mencegah goresan halus saat mencuci dan mengkilapkan lapisan wewangian mobil.',
            ],
        ];

        foreach ($products as $p) {
            $cat = $categories->get($p['category_name']);
            if ($cat) {
                Product::updateOrCreate(
                    ['slug' => Str::slug($p['name'])],
                    [
                        'category_id' => $cat->id,
                        'name' => $p['name'],
                        'price' => $p['price'],
                        'stock' => $p['stock'],
                        'image' => $p['image'],
                        'description' => $p['description'],
                        'specifications' => $p['specifications'],
                        'benefits' => $p['benefits'],
                        'status' => 'active',
                    ]
                );
            }
        }
    }
}
