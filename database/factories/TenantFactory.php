<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Plan;
use App\Models\Tenant;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\Tenant::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'plan_id' => Plan::inRandomOrder()->first()->id ?? Plan::factory(), 
            'data' => json_encode([
                'address' => $this->faker->address(),
                'phone' => $this->faker->phoneNumber(),
            ]),
        ];
    }
}
