<?php

namespace Database\Seeders;

use App\Models\Email;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(function($tenant) {
            Email::factory()->count(rand(1, 10))->create([
                'tenant_id' => $tenant->id
            ]);
        });
    }
}
