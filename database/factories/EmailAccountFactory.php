<?php

namespace Database\Factories;

use App\Models\EmailAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailAccount>
 */
class EmailAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = EmailAccount::class;


    public function definition(): array
    {
        return [
            'user_id' => 1, // example user
            'tenant_id' => 1, // example tenant
            'provider' => $this->faker->randomElement(['gmail','outlook']),
            'email' => $this->faker->unique()->safeEmail,
            'access_token' => Str::random(60),
            'refresh_token' => Str::random(60),
            'token_expires_at' => now()->addHours(1),
        ];
    }
}
