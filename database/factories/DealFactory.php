<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Deal;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Contact;
use App\Models\Lead;

class DealFactory extends Factory
{
    protected $model = Deal::class;

    public function definition(): array
    {
        $tenant = Tenant::inRandomOrder()->first();
        $user = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        
        $contact = Contact::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $lead = Lead::where('tenant_id', $tenant->id)->inRandomOrder()->first();

        return [
            'deal_name' => $this->faker->catchPhrase(),
            'description' => $this->faker->optional()->paragraph(),
            'amount' => $this->faker->optional()->randomFloat(2, 1000, 50000),
            'stage' => $this->faker->randomElement(['prospecting','qualification','proposal','negotiation','closed won','closed lost']),
            'probability' => $this->faker->optional()->numberBetween(10,100),
            'close_date' => $this->faker->optional()->date(),
            'contact_id' => $contact->id,
            'lead_id' => $lead->id,
            'priority' => $this->faker->randomElement(['low','medium','high']),
            'deal_source' => $this->faker->optional()->word(),
            'assigned_to' => $user->id,
            'created_by' => $user->id,
            'tenant_id' => $tenant->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
