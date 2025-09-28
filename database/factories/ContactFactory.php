<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Contact::class;

    public function definition(): array
    {
        $tenant = Tenant::inRandomOrder()->first();
        $user = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'alternate_phone' => $this->faker->optional()->phoneNumber(),
            'company' => $this->faker->company(),
            'job_title' => $this->faker->jobTitle(),
            'department' => $this->faker->optional()->randomElement(['Sales','Marketing','HR','IT','Finance']),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'lead_source' => $this->faker->randomElement(['website', 'social-media', 'other']),
            'contact_type' => $this->faker->randomElement(['indivisual', 'office', 'other']),
            'status' => $this->faker->randomElement(['active', 'deactivated']),
            'notes' => $this->faker->paragraph(),
            'created_by' => $user->id,
            'tenant_id' => $tenant->id,
            'created_at' => now(),
            'updated_at' => now(),
         ];
    }
}
