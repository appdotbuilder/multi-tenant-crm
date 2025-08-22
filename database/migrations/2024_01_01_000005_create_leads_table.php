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
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('job_title')->nullable();
            $table->enum('source', ['website', 'referral', 'social_media', 'cold_call', 'email_campaign', 'other'])->default('website');
            $table->enum('status', ['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost'])->default('new');
            $table->decimal('estimated_value', 12, 2)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['first_name', 'last_name']);
            $table->index('email');
            $table->index('company');
            $table->index('status');
            $table->index('source');
            $table->index('assigned_to');
            $table->index(['status', 'created_at']);
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