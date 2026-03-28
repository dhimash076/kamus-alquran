<?php

namespace Database\Seeders;

use App\Models\Vocabulary;

use Illuminate\Database\Seeder;

class VocabularySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'arabic' => 'ٱلْحَمْدُ',
                'transliteration' => 'Al-hamdu',
                'meaning' => 'Segala puji',
                'video_path' => 'videos/alhamdu.mp4',
            ],
            // ... data lainnya
        ];

        foreach ($data as $item) {
            Vocabulary::create($item);
        }
    }
}