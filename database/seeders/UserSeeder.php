<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(function($tenant) {
            $users = User::factory()->count(rand(1, 3))->create([
                'tenant_id' => $tenant->id
            ]);

            $users->each(function($user) {
                $user->assignRole('user');
            });
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
