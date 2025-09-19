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
        Schema::create('automations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Workflow name

            $table->foreignId('tenant_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->foreignId('created_by') // Who created workflow
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('trigger_type'); // Event trigger (select from config/constant)
            $table->json('trigger_condition')->nullable(); // Optional JSON conditions

            $table->string('action_type'); // Action type (send_email, create_task, assign_user)
            $table->json('action_details')->nullable(); // Action specifics JSON

            $table->enum('status', ['active', 'inactive'])->default('active'); // Enable/Disable workflow
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('automations');
    }
};
