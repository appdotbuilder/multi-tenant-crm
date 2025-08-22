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
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('value', 12, 2);
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('contact_id')->nullable()->constrained()->nullOnDelete();
            $table->enum('stage', ['prospecting', 'qualification', 'proposal', 'negotiation', 'closed_won', 'closed_lost'])->default('prospecting');
            $table->integer('probability')->default(10)->comment('Probability of closing (0-100)');
            $table->date('expected_close_date');
            $table->text('description')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            
            // Indexes for performance
            $table->index('name');
            $table->index('company_id');
            $table->index('contact_id');
            $table->index('stage');
            $table->index('assigned_to');
            $table->index(['stage', 'expected_close_date']);
            $table->index(['value', 'stage']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};