<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        // \App\Models\EventCategory::factory(25)->create();
        // \App\Models\Event::factory(15)->create();
        // \App\Models\Ticket::factory(35)->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@depublic.com',
            'password' => Hash::make('rahasia'),
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@depublic.com',
            'password' => Hash::make('rahasia'),
            'role' => 'user',
        ]);
    }
}
