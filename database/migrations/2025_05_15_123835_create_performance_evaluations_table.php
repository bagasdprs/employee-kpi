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
        Schema::create('performance_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employee_profiles');
            $table->foreignId('evaluator_id')->constrained('users');
            $table->foreignId('period_id')->constrained('evaluation_periods');
            $table->text('notes')->nullable();
            $table->decimal('final_score', 5, 2)->nullable();
            $table->enum('performance_level', ['excellent', 'good', 'satisfactory', 'needs_improvement', 'poor'])->nullable();
            $table->boolean('is_finalized')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_evaluations');
    }
};
