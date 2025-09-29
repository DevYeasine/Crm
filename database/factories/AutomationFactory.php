<?php

namespace Database\Factories;

use App\Models\Automation;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Automation>
 */
class AutomationFactory extends Factory
{
    protected $model = Automation::class;

    public function definition(): array
    {
        $tenant = Tenant::inRandomOrder()->first();
        $user = User::where('tenant_id', $tenant?->id)->inRandomOrder()->first();

        return [
            'name' => $this->faker->sentence(3), // Random workflow name
            'tenant_id' => $tenant->id,
            'created_by' => $user->id,

            // Trigger
            'trigger_type' => $this->faker->randomElement([
                'lead_created', 
                'deal_won', 
                'task_completed', 
                'project_created'
            ]),
            'trigger_condition' => $this->faker->boolean(70) 
                ? json_encode(['priority' => 'high', 'time' => 'immediate']) 
                : null,

            // Action
            'action_type' => $this->faker->randomElement([
                'send_email', 
                'create_task', 
                'assign_user'
            ]),
            'action_details' => $this->faker->boolean(70) 
                ? json_encode(['user_id' => $user?->id ?? 1, 'message' => $this->faker->sentence()]) 
                : null,

            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
