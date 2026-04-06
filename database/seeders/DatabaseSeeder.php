<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Administrator ATK',
            'email' => 'admin@atk.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Regular User
        User::create([
            'name' => 'Budi Pelanggan',
            'email' => 'user@atk.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Ensure storage directories exist
        Storage::disk('public')->makeDirectory('products/original');
        Storage::disk('public')->makeDirectory('products/card');
        Storage::disk('public')->makeDirectory('products/thumbnail');

        // Copy seed images from database/seeders/images to storage
        $seedImagePath = database_path('seeders/images/products');
        if (File::isDirectory($seedImagePath)) {
            foreach (['original', 'card', 'thumbnail'] as $variant) {
                $sourceDir = $seedImagePath . '/' . $variant;
                if (File::isDirectory($sourceDir)) {
                    foreach (File::files($sourceDir) as $file) {
                        $destination = 'products/' . $variant . '/' . $file->getFilename();
                        if (!Storage::disk('public')->exists($destination)) {
                            Storage::disk('public')->put($destination, File::get($file->getPathname()));
                        }
                    }
                }
            }
        }

        // Collect all available image filenames from storage
        $availableImages = [];
        $cardFiles = Storage::disk('public')->files('products/card');
        foreach ($cardFiles as $cardFile) {
            $availableImages[] = basename($cardFile);
        }

        // Sort for consistent ordering
        sort($availableImages);

        // Define products with real ATK (Alat Tulis Kantor) data
        $productData = [
            'Buku Tulis' => [
                [
                    'name' => 'Buku Tulis Sidu 58 Lembar',
                    'sku' => 'BKT-0001',
                    'description' => 'Buku tulis Sidu 58 lembar dengan kertas berkualitas tinggi, tidak mudah tembus tinta. Cocok untuk pelajar dan mahasiswa.',
                    'price' => 5500,
                    'stock' => 200,
                ],
                [
                    'name' => 'Buku Tulis Sinar Dunia 38 Lembar',
                    'sku' => 'BKT-0002',
                    'description' => 'Buku tulis Sinar Dunia 38 lembar. Pilihan ekonomis untuk kebutuhan menulis sehari-hari di sekolah.',
                    'price' => 3500,
                    'stock' => 300,
                ],
                [
                    'name' => 'Buku Folio Bergaris 100 Lembar',
                    'sku' => 'BKT-0003',
                    'description' => 'Buku folio bergaris 100 lembar, cocok untuk catatan kuliah dan meeting. Kertas tebal dan tidak mudah robek.',
                    'price' => 15000,
                    'stock' => 80,
                ],
                [
                    'name' => 'Buku Gambar A3 Kiky',
                    'sku' => 'BKT-0004',
                    'description' => 'Buku gambar ukuran A3 merk Kiky, 10 lembar. Kertas tebal ideal untuk menggambar dan sketsa.',
                    'price' => 12000,
                    'stock' => 50,
                ],
                [
                    'name' => 'Buku Tulis Kiky 58 Lembar',
                    'sku' => 'BKT-0005',
                    'description' => 'Buku tulis Kiky 58 lembar dengan cover menarik. Kertas halus dan nyaman untuk menulis.',
                    'price' => 5000,
                    'stock' => 250,
                ],
            ],
            'Alat Tulis Dasar' => [
                [
                    'name' => 'Pensil 2B Faber Castell',
                    'sku' => 'ATD-0001',
                    'description' => 'Pensil 2B Faber Castell kualitas premium. Ideal untuk ujian dan menggambar, tidak mudah patah.',
                    'price' => 3500,
                    'stock' => 500,
                ],
                [
                    'name' => 'Pulpen Pilot G-2 0.5mm',
                    'sku' => 'ATD-0002',
                    'description' => 'Pulpen gel Pilot G-2 dengan ujung 0.5mm. Tinta halus dan tidak mudah macet. Nyaman digenggam.',
                    'price' => 15000,
                    'stock' => 150,
                ],
                [
                    'name' => 'Penghapus Stadler',
                    'sku' => 'ATD-0003',
                    'description' => 'Penghapus Stadler Mars Plastic, menghapus dengan bersih tanpa meninggalkan noda di kertas.',
                    'price' => 5000,
                    'stock' => 300,
                ],
                [
                    'name' => 'Rautan Pensil Joyko',
                    'sku' => 'ATD-0004',
                    'description' => 'Rautan pensil Joyko dengan wadah penampung serbuk. Pisau tajam dan tahan lama.',
                    'price' => 4500,
                    'stock' => 200,
                ],
                [
                    'name' => 'Spidol Snowman Hitam',
                    'sku' => 'ATD-0005',
                    'description' => 'Spidol permanen Snowman warna hitam. Tinta tahan air dan dapat digunakan di berbagai permukaan.',
                    'price' => 7000,
                    'stock' => 180,
                ],
            ],
            'Peralatan Kantor' => [
                [
                    'name' => 'Stapler Kangaro No.10',
                    'sku' => 'PRK-0001',
                    'description' => 'Stapler Kangaro No.10 dengan kapasitas menjilid hingga 20 lembar kertas. Kokoh dan tahan lama.',
                    'price' => 25000,
                    'stock' => 60,
                ],
                [
                    'name' => 'Gunting Kenko SC-848',
                    'sku' => 'PRK-0002',
                    'description' => 'Gunting stainless steel Kenko SC-848, tajam dan ergonomis. Cocok untuk pemotongan kertas dan kardus tipis.',
                    'price' => 18000,
                    'stock' => 80,
                ],
                [
                    'name' => 'Lem Kertas UHU Stick 21g',
                    'sku' => 'PRK-0003',
                    'description' => 'Lem kertas UHU Glue Stick 21 gram. Tidak berantakan, cepat kering, dan daya rekat kuat.',
                    'price' => 12000,
                    'stock' => 150,
                ],
                [
                    'name' => 'Paper Clip Kenko No.3',
                    'sku' => 'PRK-0004',
                    'description' => 'Paper clip Kenko No.3 isi 100 pcs per box. Terbuat dari kawat berkualitas, tidak mudah berkarat.',
                    'price' => 5000,
                    'stock' => 250,
                ],
                [
                    'name' => 'Map Plastik Bantex F4',
                    'sku' => 'PRK-0005',
                    'description' => 'Map plastik Bantex ukuran F4 dengan kancing snap. Tersedia dalam berbagai warna, cocok untuk pengarsipan.',
                    'price' => 8500,
                    'stock' => 100,
                ],
            ],
            'Kertas & Karton' => [
                [
                    'name' => 'Kertas HVS A4 70gsm Sidu (Rim)',
                    'sku' => 'KRT-0001',
                    'description' => 'Kertas HVS A4 70 gram merk Sinar Dunia, 1 rim (500 lembar). Putih bersih, cocok untuk print dan fotokopi.',
                    'price' => 52000,
                    'stock' => 40,
                ],
                [
                    'name' => 'Kertas HVS F4 80gsm PaperOne',
                    'sku' => 'KRT-0002',
                    'description' => 'Kertas HVS F4 (folio) 80 gram PaperOne, 1 rim. Kualitas premium untuk dokumen penting dan presentasi.',
                    'price' => 65000,
                    'stock' => 30,
                ],
                [
                    'name' => 'Karton Manila Warna A4',
                    'sku' => 'KRT-0003',
                    'description' => 'Karton manila warna ukuran A4, tersedia merah, kuning, hijau, biru. Per lembar. Cocok untuk prakarya dan dekorasi.',
                    'price' => 1500,
                    'stock' => 500,
                ],
                [
                    'name' => 'Kertas Origami 16x16cm (50 Lembar)',
                    'sku' => 'KRT-0004',
                    'description' => 'Kertas origami aneka warna ukuran 16x16cm, isi 50 lembar. Ideal untuk kegiatan seni dan kerajinan tangan.',
                    'price' => 8000,
                    'stock' => 120,
                ],
                [
                    'name' => 'Kertas Buffalo A4 Putih',
                    'sku' => 'KRT-0005',
                    'description' => 'Kertas buffalo A4 warna putih, ketebalan 210gsm. Cocok untuk sertifikat, cover, dan keperluan jilid.',
                    'price' => 2000,
                    'stock' => 400,
                ],
            ],
        ];

        // Build flat list of all products
        $allProducts = [];
        foreach ($productData as $catName => $products) {
            foreach ($products as $product) {
                $allProducts[] = array_merge($product, ['category' => $catName]);
            }
        }

        // Distribute images evenly across products
        $totalProducts = count($allProducts);
        $totalImages = count($availableImages);
        $imageIndex = 0;

        foreach ($productData as $catName => $products) {
            $category = Category::create([
                'name' => $catName,
                'slug' => Str::slug($catName),
            ]);

            foreach ($products as $product) {
                // Assign 1 image per product, cycling through available images
                $productImages = [];
                if ($totalImages > 0) {
                    $productImages[] = $availableImages[$imageIndex % $totalImages];
                    $imageIndex++;
                }

                Product::create([
                    'category_id' => $category->id,
                    'name' => $product['name'],
                    'slug' => Str::slug($product['name']) . '-' . Str::random(5),
                    'sku' => $product['sku'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'stock' => $product['stock'],
                    'images' => $productImages,
                ]);
            }
        }

        $this->command->info("Seeded " . count($allProducts) . " products with " . $totalImages . " images distributed.");
    }
}
