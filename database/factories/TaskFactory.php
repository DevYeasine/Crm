<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Task;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Task::class;

    public function definition(): array
    {

        $tenant = Tenant::inRandomOrder()->first();
        $contact = Contact::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $lead = Lead::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $deal = Deal::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $project = Project::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $user = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();

        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->optional()->paragraph(200),
            'lead_id' => $lead->id,
            'deal_id' => $deal->id,
            'project_id' => $project->id,
            'contact_id' => $contact->id,
            'assigned_to' => $user->id,
            'created_by' => $user->id,
            'due_date' => $this->faker->optional()->date(),
            'reminder_at' => $this->faker->optional()->date(),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'cancelled']),
            'priority' => $this->faker->randomElement(['low', 'medium', 'high', 'urgent']),
            'task_type' => $this->faker->optional()->randomElement(['call', 'meeting', 'email', 'follow-up']),
            'is_recurring' => $this->faker->boolean(20),
            'recurrence_rule' => $this->faker->optional()->randomElement([
                json_encode(['frequency' => 'daily', 'interval' => 1]),
                json_encode(['frequency' => 'weekly', 'interval' => 1]),
                null
            ]),
            'tenant_id' => $tenant->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
