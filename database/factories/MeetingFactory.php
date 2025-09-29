<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\Meeting;
use App\Models\Project;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Meeting::class;


    public function definition(): array
    {

        $tenant = Tenant::inRandomOrder()->first();
        $contact = Contact::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $lead = Lead::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $deal = Deal::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $project = Project::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $user = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();

        return [
            'title' => $this->faker->sentence(12),
            'description' => $this->faker->optional()->paragraph(200),
            'created_by' => $user->id,
            'lead_id' => $lead->id,
            'deal_id' => $deal->id,
            'project_id' => $project->id,
            'contact_id' => $contact->id,
            'start_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_time' => $this->faker->optional(0.7)->dateTimeBetween('+1 hour', '+2 hours'),
            'meeting_platform' => $this->faker->randomElement(['zoom', 'google_meet',  'teams', 'in_person']),
            'meeting_link' => $this->faker->url(),
            'meeting_id' => $this->faker->optional(0.8)->randomNumber(9),
            'meeting_password' => $this->faker->optional(0.6)->password(),
            'internal_users' => json_encode([$user->id]),
            'external_clients' => json_encode([$this->faker->unique()->safeEmail()]),
            'status' => $this->faker->randomElement(['scheduled', 'completed',  'canceled']),
            'tenant_id' => $tenant->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
