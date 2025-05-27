<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    User::create([
        'name' => 'admin',
        'email' => 'admin@ehb.be',
        'password' => Hash::make('Password!321'),
        'is_admin' => true, // Voeg deze kolom toe in de volgende stap
    ]);
}
}
