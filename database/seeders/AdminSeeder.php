<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ehb.be'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Password!321'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
} 