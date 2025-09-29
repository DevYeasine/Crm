<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Team::class;


    public function definition(): array
    {
        $tenant = Tenant::inRandomOrder()->first();

        $user = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        return [
            'name' => $this->faker->unique()->company(),
            'user_id' => $user->id,
            'personal_team' => true,
        ];
    }
}
