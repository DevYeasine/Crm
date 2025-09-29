<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(function($tenant) {
            Project::factory()->count(rand(1, 2))->create([
                'tenant_id' => $tenant->id
            ]);
        });
    }
}
