<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        News::create([
            'title' => 'Eerste Nieuwsitem',
            'image' => 'news1.jpg',
            'content' => 'Dit is het eerste nieuwsartikel.',
            'published_at' => now(),
        ]);

        News::create([
            'title' => 'Tweede Nieuwsitem',
            'image' => 'news2.jpg',
            'content' => 'Nog een interessant nieuwsbericht.',
            'published_at' => now(),
        ]);
    }
}

