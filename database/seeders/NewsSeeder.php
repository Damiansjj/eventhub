<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('is_admin', true)->first();
        
        if (!$admin) {
            // Maak een admin als die er niet is
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@eventhub.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
            ]);
        }

        News::create([
            'title' => 'Welkom bij EventHub!',
            'slug' => 'welkom-bij-eventhub',
            'content' => 'Dit is het eerste nieuwsartikel op EventHub. Hier kun je alle laatste nieuwtjes en updates vinden over onze evenementen en community.',
            'excerpt' => 'Welkom bij EventHub, jouw nieuwe thuis voor evenementen en community nieuws.',
            'is_published' => true,
            'published_at' => now(),
            'author_id' => $admin->id,
        ]);

        News::create([
            'title' => 'Nieuwe functies toegevoegd',
            'slug' => 'nieuwe-functies-toegevoegd',
            'content' => 'We hebben verschillende nieuwe functies toegevoegd aan het platform, waaronder betere profielen en een verbeterde zoekfunctie.',
            'excerpt' => 'Ontdek de nieuwe functies die we hebben toegevoegd.',
            'is_published' => true,
            'published_at' => now()->subDays(1),
            'author_id' => $admin->id,
        ]);
    }
}