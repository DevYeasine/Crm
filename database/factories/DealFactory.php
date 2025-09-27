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
        $userIds = User::pluck('id')->toArray();
        $tenantIds = Tenant::pluck('id')->toArray();
        $contactIds = Contact::pluck('id')->toArray();
        $leadIds = Lead::pluck('id')->toArray();

        return [
            'deal_name' => $this->faker->catchPhrase(),
            'description' => $this->faker->optional()->paragraph(),
            'amount' => $this->faker->optional()->randomFloat(2, 1000, 50000),
            'stage' => $this->faker->randomElement(['prospecting','qualification','proposal','negotiation','closed won','closed lost']),
            'probability' => $this->faker->optional()->numberBetween(10,100),
            'close_date' => $this->faker->optional()->date(),
            'contact_id' => $this->faker->optional()->randomElement($contactIds),
            'lead_id' => $this->faker->optional()->randomElement($leadIds),
            'priority' => $this->faker->randomElement(['low','medium','high']),
            'deal_source' => $this->faker->optional()->word(),
            'assigned_to' => $this->faker->optional()->randomElement($userIds),
            'created_by' => $this->faker->randomElement($userIds),
            'tenant_id' => $this->faker->randomElement($tenantIds),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
