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
        Schema::create('assessment_results', function (Blueprint $table) {
             $table->id();
    $table->foreignId('assessment_id')->constrained('assessments')->onDelete('cascade');
    $table->foreignId('compliance_control_id')->constrained('compliance_controls')->onDelete('cascade');
    $table->enum('result', ['Compliant', 'Non-Compliant', 'Partial'])->default('Partial');
    $table->text('comments')->nullable();
    $table->softDeletes();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assesment_results');
    }
};
