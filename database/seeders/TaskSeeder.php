<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(function($tenant) {
            Task::factory()->count(rand(1, 2))->create([
                'tenant_id' => $tenant->id
            ]);
        });
    }
}
