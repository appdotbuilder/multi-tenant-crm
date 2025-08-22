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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('job_title')->nullable();
            $table->foreignId('company_id')->nullable()->constrained()->nullOnDelete();
            $table->text('address')->nullable();
            $table->date('birthday')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'inactive', 'lead'])->default('active');
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['first_name', 'last_name']);
            $table->index('email');
            $table->index('company_id');
            $table->index('status');
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};