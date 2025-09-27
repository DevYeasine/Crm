<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Lead;
use App\Models\User;
use App\Models\Tenant;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        // Random tenant
        $tenant = Tenant::inRandomOrder()->first() ?? Tenant::factory()->create();

        // Random created_by user (এই tenant এর একজন)
        $createdBy = User::where('tenant_id', $tenant->id)->inRandomOrder()->first() ?? User::factory()->create([
            'tenant_id' => $tenant->id,
        ]);

        // Random assigned_to user (এই tenant এর অন্য একজন, না থাকলে null)
        $assignedTo = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->optional()->phoneNumber(),
            'company_name' => $this->faker->company(),
            'job_title' => $this->faker->jobTitle(),
            'lead_source' => $this->faker->randomElement(['Website', 'Facebook', 'Referral', 'LinkedIn']),
            'lead_status' => $this->faker->randomElement(['new', 'contacted', 'qualified', 'won', 'lost']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high']),
            'notes' => $this->faker->sentence(10),

            'assigned_to' => $assignedTo?->id,
            'tenant_id' => $tenant->id,
            'created_by' => $createdBy->id,

            'status_changed_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'last_contacted_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
