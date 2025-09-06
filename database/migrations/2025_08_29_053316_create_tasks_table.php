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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            
            $table->string('title');
            $table->text('description')->nullable();

            $table->foreignId('lead_id')->nullable()->constrained('leads')->onDelete('cascade');
            $table->foreignId('deal_id')->nullable()->constrained('deals')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->onDelete('cascade');

            
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('created_by')->constrained('users');

            $table->dateTime('due_date')->nullable();
            $table->dateTime('reminder_at')->nullable();

            $table->string('status')->default('pending');   // pending / in_progress / completed / cancelled
            $table->string('priority')->default('medium'); // low / medium / high / urgent

            $table->string('task_type')->nullable(); // e.g., call, meeting, email, follow-up, custom
            $table->boolean('is_recurring')->default(false);
            $table->json('recurrence_rule')->nullable(); // যদি recurring task future এ লাগে

            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
