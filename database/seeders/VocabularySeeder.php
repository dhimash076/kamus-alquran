<?php

namespace Database\Seeders;

use App\Models\Vocabulary;
use App\Models\Category; // 1. Tambahkan import ini
use Illuminate\Database\Seeder;

class VocabularySeeder extends Seeder
{
    public function run(): void
    {
        // 2. Buat kategori pertama dulu agar ID 1 tersedia
        Category::create(['name' => 'Umum']);

        $data = [
            [
                'arabic' => 'ٱلْحَمْدُ',
                'transliteration' => 'Al-hamdu',
                'meaning' => 'Segala puji',
                'video_path' => 'videos/alhamdu.mp4',
                'category_id' => 1, // Sekarang ID 1 sudah ada!
            ],
            // ... data lainnya
        ];

        foreach ($data as $item) {
            Vocabulary::create($item);
        }
    }
}