<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have an admin user
        $admin = User::where('email', 'admin@ehb.be')->first();
        
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@ehb.be',
                'password' => bcrypt('Password!321'),
                'is_admin' => true,
                'username' => 'admin'
            ]);
        }

        // Create some test events
        $events = [
            [
                'title' => 'Tech Conference 2024',
                'description' => 'Een geweldige tech conferentie met sprekers van over de hele wereld.',
                'location' => 'Brussel Expo',
                'start_date' => '2024-06-15 09:00:00',
                'end_date' => '2024-06-15 17:00:00',
                'category' => 'Technology',
                'max_participants' => 500,
                'price' => 99.99,
                'is_published' => true,
            ],
            [
                'title' => 'Muziekfestival Zomer',
                'description' => 'Het grootste muziekfestival van België met nationale en internationale artiesten.',
                'location' => 'Park van Brussel',
                'start_date' => '2024-07-20 12:00:00',
                'end_date' => '2024-07-22 23:00:00',
                'category' => 'Music',
                'max_participants' => 10000,
                'price' => 149.99,
                'is_published' => true,
            ],
            [
                'title' => 'Kunstworkshop',
                'description' => 'Leer schilderen van professionele kunstenaars in een gezellige omgeving.',
                'location' => 'Kunstacademie Brussel',
                'start_date' => '2024-05-10 14:00:00',
                'end_date' => '2024-05-10 17:00:00',
                'category' => 'Art',
                'max_participants' => 20,
                'price' => 45.00,
                'is_published' => true,
            ],
        ];

        foreach ($events as $eventData) {
            $admin->events()->create($eventData);
        }
    }
} 