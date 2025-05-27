<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default admin account
        if (!User::where('email', 'admin@ehb.be')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@ehb.be',
                'password' => Hash::make('Password!321'),
                'is_admin' => true,
                'email_verified_at' => now(),
                'username' => 'admin'
            ]);
        }

        // Create test user
        if (!User::where('email', 'test@example.com')->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('Password!321'),
                'email_verified_at' => now(),
                'username' => 'testuser'
            ]);
        }

        // Run other seeders
        $this->call([
            EventSeeder::class,
            FaqSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
