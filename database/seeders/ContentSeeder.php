<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Content;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $numberOfContents = 20;

        $authorId = User::where('role', 'author')->first()?->id;
        $categoryId = Category::first()?->id;

        if (!$authorId || !$categoryId) {
            $this->command->info('Tidak dapat menemukan user author atau kategori. Pastikan seeder User dan Category sudah dijalankan.');
            return;
        }

        for ($i = 1; $i <= $numberOfContents; $i++) {
            // Gunakan Faker untuk membuat judul yang lebih realistis
            $title = fake()->sentence(rand(4, 8));

            // Siapkan array kosong untuk blok konten yang akan kita buat secara dinamis
            $blocks = [];

            // 1. Selalu tambahkan Header
            $blocks[] = [
                "id" => "header_" . uniqid(),
                "type" => "header",
                "data" => [
                    "text" => fake()->sentence(rand(5, 10)),
                    "level" => 2
                ]
            ];

            // 2. Tambahkan beberapa Paragraf
            for ($p = 0; $p < rand(2, 4); $p++) {
                $blocks[] = [
                    "id" => "paragraph_" . uniqid(),
                    "type" => "paragraph",
                    "data" => [
                        "text" => fake()->paragraph(rand(5, 12))
                    ]
                ];
            }

            // 3. Kadang-kadang, tambahkan Gambar acak
            if (rand(0, 1)) {
                $blocks[] = [
                    "id" => "image_" . uniqid(),
                    "type" => "image",
                    "data" => [
                        "file" => [
                            // Gunakan layanan lorem picsum untuk gambar placeholder acak
                            "url" => 'https://picsum.photos/900/600?random=' . rand(1, 1000)
                        ],
                        "caption" => fake()->sentence(4),
                    ]
                ];
            }

            // 4. Kadang-kadang, tambahkan Daftar (List)
            if (rand(0, 1)) {
                $items = [];
                for ($l = 0; $l < rand(3, 5); $l++) {
                    $items[] = fake()->sentence(rand(6, 12));
                }
                $blocks[] = [
                    "id" => "list_" . uniqid(),
                    "type" => "list",
                    "data" => [
                        "style" => fake()->randomElement(['unordered', 'ordered']),
                        "items" => $items
                    ]
                ];
            }

            // 5. Buat data JSON dari blok-blok yang sudah kita kumpulkan
            $dynamicContentJson = json_encode([
                "time" => now()->timestamp,
                "blocks" => $blocks,
                "version" => "2.29.1"
            ]);

            // Buat record di database
            Content::create([
                'title' => $title,
                // Tambahkan ID unik untuk memastikan slug tidak akan pernah sama
                'slug' => Str::slug($title) . '-' . uniqid(),
                'content' => $dynamicContentJson,
                'created_by' => $authorId,
                'category_id' => $categoryId,
            ]);
        }
    }
}
