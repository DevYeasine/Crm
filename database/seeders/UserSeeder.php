<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Random users with default 'user' role
        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('user');
        });

        // Fixed test user with 'admin' role
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $testUser->assignRole('admin');
    }
}
