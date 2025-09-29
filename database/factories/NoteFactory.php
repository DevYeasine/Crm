<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\Deal;
use App\Models\Lead;
use App\Models\Note;
use App\Models\Project;
use App\Models\Task;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Note::class;


    public function definition(): array
    {
        $tenant = Tenant::inRandomOrder()->first();
        $user   = User::where('tenant_id', $tenant->id)->inRandomOrder()->first();

        // Randomly pick a related model type
        $relatedTypes = [
            Deal::class,
            Lead::class,
            Project::class,
            Contact::class,
            Task::class,
        ];

        $relatedType = $this->faker->randomElement($relatedTypes);

        // Find one record for that type in the same tenant
        $relatedId = null;

        if ($relatedType === Deal::class) {
            $relatedId = Deal::where('tenant_id', $tenant->id)->inRandomOrder()->value('id');
        } elseif ($relatedType === Lead::class) {
            $relatedId = Lead::where('tenant_id', $tenant->id)->inRandomOrder()->value('id');
        } elseif ($relatedType === Project::class) {
            $relatedId = Project::where('tenant_id', $tenant->id)->inRandomOrder()->value('id');
        } elseif ($relatedType === Contact::class) {
            $relatedId = Contact::where('tenant_id', $tenant->id)->inRandomOrder()->value('id');
        } elseif ($relatedType === Task::class) {
            $relatedId = Task::where('tenant_id', $tenant->id)->inRandomOrder()->value('id');
        }

        return [
            'note_text'    => $this->faker->paragraph(),
            'related_type' => $relatedType,
            'related_id'   => $relatedId,
            'created_by'   => $user?->id,
            'tenant_id'    => $tenant->id,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}
