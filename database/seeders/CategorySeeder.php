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
        $categories = [
            [
                'name' => 'Pemrograman Web',
                'icon' => 'fas fa-code',
                'color' => '#3B82F6'
            ],
            [
                'name' => 'Pengembangan Mobile',
                'icon' => 'fas fa-mobile-alt',
                'color' => '#10B981'
            ],
            [
                'name' => 'Sains Data & Analitika',
                'icon' => 'fas fa-chart-bar',
                'color' => '#F59E0B'
            ],
            [
                'name' => 'Pemasaran Digital',
                'icon' => 'fas fa-bullhorn',
                'color' => '#EF4444'
            ],
            [
                'name' => 'Desain Grafis & UI/UX',
                'icon' => 'fas fa-palette',
                'color' => '#8B5CF6'
            ],
            [
                'name' => 'Pengembangan Diri',
                'icon' => 'fas fa-user-graduate',
                'color' => '#06B6D4'
            ],
            [
                'name' => 'Bisnis & Manajemen',
                'icon' => 'fas fa-briefcase',
                'color' => '#6B7280'
            ],
            [
                'name' => 'Fotografi & Video',
                'icon' => 'fas fa-camera',
                'color' => '#EC4899'
            ],
            [
                'name' => 'Kecerdasan Buatan (AI)',
                'icon' => 'fas fa-robot',
                'color' => '#7C3AED'
            ],
            [
                'name' => 'Keamanan Siber',
                'icon' => 'fas fa-shield-alt',
                'color' => '#DC2626'
            ],
        ];
        
        // Looping untuk setiap data kategori dalam array di atas
        foreach ($categories as $data) {
            // Menggunakan firstOrCreate untuk menghindari duplikasi jika seeder dijalankan lagi
            Category::firstOrCreate(
                ['category' => $data['name']], // Kolom unik untuk pengecekan
                [
                    'icon' => $data['icon'],
                    'color' => $data['color'],
                    // 'slug' => Str::slug($data['name']) // Opsional: jika Anda punya kolom slug
                ]
            );
        }
    }
}
