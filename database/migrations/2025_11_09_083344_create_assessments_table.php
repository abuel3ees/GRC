<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('owner')->nullable();

            // ✅ Properly nullable foreign key
            $table->foreignId('framework_id')
                  ->nullable()
                  ->constrained('compliance_frameworks')
                  ->onDelete('cascade');

            $table->foreignId('auditor_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            $table->date('assessment_date')->nullable();
            $table->enum('status', ['Draft', 'Active', 'Closed'])->default('Draft');
            $table->text('summary')->nullable();
            $table->integer('score')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
