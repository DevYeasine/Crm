<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();

        

        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(TenantSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(LeadSeeder::class);
        $this->call(DealSeeder::class);
        $this->call(ProjectSeeder::class);
    }
}
