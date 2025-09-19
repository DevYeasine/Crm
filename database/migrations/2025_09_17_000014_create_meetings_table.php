<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            // Basic Info
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('created_by')->constrained('users');

            // Relation (optional per event)
            $table->foreignId('lead_id')->nullable()->constrained('leads')->onDelete('cascade');
            $table->foreignId('deal_id')->nullable()->constrained('deals')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->onDelete('cascade');

            // Timing
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();

            // Meeting Platform
            $table->string('meeting_platform')->nullable(); // zoom / google_meet / teams / in_person
            $table->string('meeting_link')->nullable();
            $table->string('meeting_id')->nullable();
            $table->string('meeting_password')->nullable();

            // Invitees
            $table->json('internal_users')->nullable(); // team members user IDs
            $table->json('external_clients')->nullable(); // client emails or IDs

            // Invite / join status tracking (optional)
            $table->json('invite_status')->nullable(); 

            // Reminders
            $table->json('reminders')->nullable(); 

            // Status
            $table->string('status')->default('scheduled'); // scheduled / ongoing / completed / canceled

            // Tenant
            $table->foreignId('tenant_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
