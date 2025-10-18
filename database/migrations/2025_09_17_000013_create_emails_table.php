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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();

            $table->string('subject')->nullable();
            $table->longText('body')->nullable();

            $table->enum('direction', ['incoming', 'outgoing']);

            $table->foreignId('from_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('from_email')->nullable();

            $table->json('to')->nullable();
            $table->json('cc')->nullable();
            $table->json('bcc')->nullable();

            $table->foreignId('lead_id')->nullable()->constrained('leads')->onDelete('cascade');
            $table->foreignId('deal_id')->nullable()->constrained('deals')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->onDelete('cascade');

            $table->json('attachments')->nullable();
            $table->enum('status', ['inbox', 'draft', 'sent', 'failed', 'queued', 'trash'])->default('draft');
            $table->enum('folder', ['inbox', 'sent', 'draft', 'trash'])->default('inbox');

            $table->boolean('is_read')->default(false);
            $table->boolean('is_starred')->default(false);

            $table->string('external_id')->nullable()->index(); // Message ID from Gmail/Outlook
            $table->string('provider')->nullable(); // 'gmail' or 'outlook'

            $table->unsignedBigInteger('parent_email_id')->nullable(); // For threading
            $table->foreign('parent_email_id')->references('id')->on('emails')->onDelete('cascade');
            $table->foreignId('email_account_id')->nullable()->constrained('email_accounts')->onDelete('cascade');

            $table->foreignId('tenant_id')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

            // Indexes for better performance
            $table->index(['tenant_id', 'folder']);
            $table->index(['tenant_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
