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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
    $table->foreignId('framework_id')->constrained('compliance_frameworks')->onDelete('cascade');
    $table->foreignId('auditor_id')->nullable()->constrained('users')->onDelete('set null');
    $table->date('assessment_date');
    $table->enum('status', ['Planned', 'Ongoing', 'Completed'])->default('Planned');
    $table->text('summary')->nullable();
    $table->integer('score')->nullable();
    $table->softDeletes();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assesments');
    }
};
