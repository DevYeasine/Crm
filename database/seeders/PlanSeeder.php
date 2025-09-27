<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::factory()->count(5)->create();

        Plan::create([
            'name' => 'Premium',
            'price' => 99.99,
            'features' => json_encode([
                'users' => 'Unlimited Users',
                'storage' => '500 GB Storage',
                'support' => '24/7 Support',
            ]),
        ]);
    }
}
