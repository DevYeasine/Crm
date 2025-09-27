<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Deal;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\Tenant;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Project::class;


    public function definition(): array
    {
        $tenant = Tenant::inRandomOrder()->first();
        $deal = Deal::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $contact = Contact::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $user = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();

        return [
            'deal_id' => $deal->id,
            'client_id' => $contact->id,
            'project_name' => $this->faker->sentence(5),
            'description' => $this->faker->optional()->paragraph(),
            'budget' => $this->faker->optional()->randomFloat(2, 0, 50000),
            'actual_cost' => $this->faker->optional()->randomFloat(2, 0, 50000),
            'start_date' => $this->faker->optional()->date(),
            'end_date' => $this->faker->optional()->date(),
            'expected_delivery_date' => $this->faker->optional()->date(),
            'status' => $this->faker->optional()->randomElement(['planned','start','done']),
            'progress' => $this->faker->numberBetween(0, 100),
            'priority' => $this->faker->optional()->randomElement(['low','medium','high']),
            'project_manager' => $user->id,
            'team_members' => json_encode($user->id),
            'created_by' => $user->id,
            'tenant_id' => $tenant->id,
            'created_at' => now(),
            'updated_at' => now(),
            
        ];
    }
}
