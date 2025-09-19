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

            $table->string('lead_status')->default('new'); 
            $table->string('priority')->default('medium'); 
            $table->text('notes')->nullable();

            // Assigned to user (nullable, set null on delete)
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users')->nullOnDelete();

            // Tenant
            $table->foreignId('tenant_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            // Created by user
            $table->foreignId('created_by')->constrained('users')->cascadeOnDelete();

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
