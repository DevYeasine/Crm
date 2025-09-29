<?php

namespace Database\Factories;

use App\Models\Integration;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IntegrationFactory extends Factory
{

    protected $model = Integration::class;

    public function definition(): array
    {
        $tenant = Tenant::inRandomOrder()->first();
        $user = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();
        $integrationTypes = [
            'facebook' => 'social_media',
            'whatsapp' => 'messaging', 
            'zapier' => 'automation',
            'slack' => 'communication',
            'stripe' => 'payment',
            'mailchimp' => 'marketing',
            'google_calendar' => 'calendar',
            'gmail' => 'email'
        ];

        $integrationName = $this->faker->randomElement(array_keys($integrationTypes));
        
        return [
            'name' => $integrationName,
            'type' => $integrationTypes[$integrationName],
            'credentials' => $this->faker->boolean(60) ? [
                'api_key' => $this->faker->sha256(),
                'access_token' => $this->faker->uuid(),
                'refresh_token' => $this->faker->boolean(40) ? $this->faker->uuid() : null,
                'expires_at' => $this->faker->boolean(50) ? $this->faker->dateTimeBetween('+1 week', '+1 month') : null,
            ] : null,
            'webhook_url' => $this->faker->boolean(30) ? $this->faker->url() : null,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'tenant_id' => $tenant->id,
            'created_by' => $tenant->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}