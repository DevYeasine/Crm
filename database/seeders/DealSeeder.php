<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Deal;
use App\Models\Tenant;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(function($tenant) {
            Deal::factory()->count(rand(1, 2))->create([
                'tenant_id' => $tenant->id
            ]);
        });

    }
}
