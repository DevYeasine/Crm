<?php

namespace Database\Seeders;

use App\Models\EmailAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailAccount::factory()->count(2)->create([
            'user_id' => 1,
            'tenant_id' => 1,
        ]);
    }
}
