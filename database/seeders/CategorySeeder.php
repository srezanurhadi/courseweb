<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;      // Pastikan Model Category sudah di-import
use Illuminate\Support\Str;   // Import Str untuk membuat slug

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Daftar kategori yang ingin Anda buat.
        // Anda bisa menambah, mengubah, atau menghapus daftar ini sesuai kebutuhan.
        $category = [
            'Pemrograman Web',
            'Pengembangan Mobile',
            'Sains Data & Analitika',
            'Pemasaran Digital',
            'Desain Grafis & UI/UX',
            'Pengembangan Diri',
            'Bisnis & Manajemen',
            'Fotografi & Video',
            'Kecerdasan Buatan (AI)',
            'Keamanan Siber',
        ];

        // Looping untuk setiap nama kategori dalam array di atas
        foreach ($category as $categoryName) {
            Category::create([
                'category' => $categoryName,
            ]);
        }
    }
}
