<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(function($tenant) {
            Contact::factory()->count(rand(1, 2))->create([
                'tenant_id' => $tenant->id
            ]);
        });
    }
}
