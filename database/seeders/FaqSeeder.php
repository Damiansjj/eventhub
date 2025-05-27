<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaqCategory;
use App\Models\FaqItem;

class FaqSeeder extends Seeder
{
    public function run()
    {
        // Algemene categorie
        $general = FaqCategory::create([
            'name' => 'Algemeen',
            'slug' => 'algemeen',
            'description' => 'Algemene vragen over onze diensten',
            'sort_order' => 1
        ]);

        FaqItem::create([
            'faq_category_id' => $general->id,
            'question' => 'Wat is dit voor website?',
            'answer' => 'Dit is een evenementen platform waar je events kunt vinden en organiseren.',
            'sort_order' => 1
        ]);

        FaqItem::create([
            'faq_category_id' => $general->id,
            'question' => 'Hoe kan ik een account aanmaken?',
            'answer' => 'Klik op de "Registreren" knop rechtsboven en vul het formulier in.',
            'sort_order' => 2
        ]);

        // Events categorie
        $events = FaqCategory::create([
            'name' => 'Evenementen',
            'slug' => 'evenementen', 
            'description' => 'Vragen over het organiseren en bezoeken van evenementen',
            'sort_order' => 2
        ]);

        FaqItem::create([
            'faq_category_id' => $events->id,
            'question' => 'Hoe kan ik een evenement aanmaken?',
            'answer' => 'Log in op je account en ga naar "Evenement Aanmaken" in het menu.',
            'sort_order' => 1
        ]);
    }
}