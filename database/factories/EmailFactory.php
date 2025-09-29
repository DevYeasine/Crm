<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\Email;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Email>
 */
class EmailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Email::class;

    public function definition(): array
    {

        $tenant = Tenant::inRandomOrder()->first();
        $contact = Contact::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $lead = Lead::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $deal = Deal::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $project = Project::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $user = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();

        return [
            'subject' => $this->faker->sentence(12),
            'body' => $this->faker->optional()->paragraph(500),
            'direction' => $this->faker->randomElement(['outgoing', 'incoming']),
            'from_user_id' => $user->id,
            'from_email' => $user->email,
            'to' => [$this->faker->safeEmail()],  // Remove json_encode
            'cc' => $this->faker->boolean(30) ? [$this->faker->safeEmail()] : null,  // Remove json_encode
            'bcc' => $this->faker->boolean(20) ? [$this->faker->safeEmail(), $this->faker->safeEmail()] : null,
            'lead_id' => $lead->id,
            'deal_id' => $deal->id,
            'project_id' => $project->id,
            'contact_id' => $contact->id,
            'attachments' => $this->faker->boolean(40) ? [$this->faker->filePath(), $this->faker->filePath()] :null,
            'status' => $this->faker->randomElement(['draft', 'inbox', 'sent', 'trash']),
            'tenant_id' => $tenant->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
