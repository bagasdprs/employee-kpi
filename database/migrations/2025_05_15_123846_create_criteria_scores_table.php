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
        Schema::create('criteria_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')->constrained('performance_evaluations')->onDelete('cascade');
            $table->foreignId('criteria_id')->constrained('evaluation_criterias');
            $table->integer('score');
            $table->text('comment')->nullable();
            $table->timestamps();

            // Unique constraint to prevent duplicate criteria in same evaluation
            $table->unique(['evaluation_id', 'criteria_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria_scores');
    }
};
