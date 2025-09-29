<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        $tenants->each(function($tenant) {
            Note::factory()->count(rand(1, 5))->create([
                'tenant_id' => $tenant->id
            ]);
        });
    }
}
