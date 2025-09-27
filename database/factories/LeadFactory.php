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

        $tenant = Tenant::inRandomOrder()->first();

        $createdBy = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();

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
