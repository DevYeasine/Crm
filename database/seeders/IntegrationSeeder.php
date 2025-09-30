<?php

namespace Database\Seeders;

use App\Models\Integration;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntegrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $tenants = Tenant::all();

        $tenants->each(function($tenant) {
            $users = $tenant->users; // User::where('tenant_id', $tenant->id)->get();

            $users->each(function($user) use ($tenant) {
                Integration::factory()->create([
                    'tenant_id' => $tenant->id,
                    'created_by' => $user->id,
                    'name' => $user->name . "'s Integration",
                ]);
            });
        });
    }
}
