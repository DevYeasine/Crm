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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();

            $table->string('company_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('lead_source')->nullable();

            // Priority and Status as plain strings (flexible, frontend controlled)
            $table->string('lead_status')->default('new'); // e.g. new, contacted, etc.
            $table->string('priority')->default('medium'); // e.g. high, medium, low

            $table->text('notes')->nullable();

            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users');

            $table->timestamp('status_changed_at')->nullable();
            $table->timestamp('last_contacted_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
