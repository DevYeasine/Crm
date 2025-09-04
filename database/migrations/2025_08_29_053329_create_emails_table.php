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

            $table->enum('direction', ['outgoing', 'incoming']); 

            $table->foreignId('from_user_id')->nullable()->constrained('users')->onDelete('set null'); 
            $table->string('from_email')->nullable();
            $table->json('to')->nullable();
            $table->json('cc')->nullable()->nullable();
            $table->json('bcc')->nullable()->nullable();

            $table->foreignId('lead_id')->nullable()->constrained('leads')->onDelete('cascade');
            $table->foreignId('deal_id')->nullable()->constrained('deals')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->foreignId('contact_id')->nullable()->constrained('contacts')->onDelete('cascade');

            $table->json('attachments')->nullable(); 

            $table->enum('status', ['draft', 'sent', 'delivered', 'failed'])->default('draft');

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
        Schema::dropIfExists('emails');
    }
};
