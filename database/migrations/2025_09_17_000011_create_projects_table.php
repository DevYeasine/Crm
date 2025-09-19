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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('deal_id')->nullable()->constrained('deals')->onDelete('set null'); 
            $table->foreignId('client_id')->nullable()->constrained('contacts')->onDelete('set null'); 

            $table->string('project_name');
            $table->text('description')->nullable();

            $table->decimal('budget', 15, 2)->nullable();
            $table->decimal('actual_cost', 15, 2)->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('expected_delivery_date')->nullable();

            $table->string('status')->default('planned');
            $table->integer('progress')->default(0);

            $table->string('priority')->default('medium');

            $table->foreignId('project_manager')->nullable()->constrained('users')->onDelete('set null');
            $table->json('team_members')->nullable();

            $table->foreignId('created_by')->constrained('users');
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
        Schema::dropIfExists('projects');
    }
};
