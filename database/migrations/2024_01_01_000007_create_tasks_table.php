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
            $table->enum('type', ['call', 'email', 'meeting', 'follow_up', 'demo', 'other'])->default('call');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->datetime('due_date');
            $table->datetime('completed_at')->nullable();
            $table->foreignId('assigned_to')->constrained('users')->cascadeOnDelete();
            $table->morphs('taskable'); // Can be related to contact, company, deal, or lead
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index('title');
            $table->index('type');
            $table->index('priority');
            $table->index('status');
            $table->index('due_date');
            $table->index('assigned_to');
            $table->index(['status', 'due_date']);
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