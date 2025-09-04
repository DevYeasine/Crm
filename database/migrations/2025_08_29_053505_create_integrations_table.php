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
        Schema::create('integrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id') // Tenant-wise integration
                ->constrained()
                ->onDelete('cascade');

            $table->string('name'); // Integration name (Gmail, Zoom, Slack)
            $table->string('type'); // Integration type (email, calendar, messaging, payment)
            $table->json('credentials')->nullable(); // API keys / OAuth tokens (encrypted)
            $table->string('webhook_url')->nullable(); // Optional webhook URL for incoming events
            $table->enum('status', ['active', 'inactive'])->default('active'); // Enable/Disable

            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Who created integration

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integrations');
    }
};
