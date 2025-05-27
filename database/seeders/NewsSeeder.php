<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create admin user
        $admin = User::where('email', 'admin@ehb.be')->first();
        
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@ehb.be',
                'password' => bcrypt('Password!321'),
                'is_admin' => true,
            ]);
        }

        // Create some test news items
        $news = [
            [
                'title' => 'Welkom bij EventHub!',
                'content' => 'EventHub is jouw nieuwe platform voor het organiseren en ontdekken van evenementen. Blijf op de hoogte van de laatste updates en nieuws over komende evenementen.',
                'excerpt' => 'Ontdek het nieuwe EventHub platform',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Nieuwe Functies Toegevoegd',
                'content' => 'We hebben verschillende nieuwe functies toegevoegd aan het platform, waaronder een verbeterd profiel systeem en een FAQ sectie. Ontdek alle nieuwe mogelijkheden!',
                'excerpt' => 'Verken de nieuwe features op EventHub',
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Tips voor Evenement Organisatoren',
                'content' => 'Ben je van plan een evenement te organiseren? Lees onze handige tips voor een succesvol evenement. Van planning tot promotie, wij helpen je op weg.',
                'excerpt' => 'Handige tips voor het organiseren van evenementen',
                'is_published' => true,
                'published_at' => now()->subDay(),
                'author_id' => $admin->id,
            ],
        ];

        foreach ($news as $item) {
            $item['slug'] = News::generateSlug($item['title']);
            News::create($item);
        }
    }
}