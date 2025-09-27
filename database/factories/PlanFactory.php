<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Plan',
            'price' => $this->faker->randomFloat(2, 5, 500), // 5 থেকে 500 এর মধ্যে দাম
            'features' => json_encode([
                'users' => $this->faker->numberBetween(1, 50) . ' Users',
                'storage' => $this->faker->numberBetween(1, 100) . ' GB Storage',
                'support' => $this->faker->randomElement(['Email Support', '24/7 Support']),
            ]),
        ];
    }
}
