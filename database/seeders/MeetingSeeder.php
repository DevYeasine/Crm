<?php

namespace Database\Seeders;

use App\Models\Meeting;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(function($tenant) {
            Meeting::factory()->count(rand(1, 3))->create([
                'tenant_id' => $tenant->id
            ]);
        });
    }
}
