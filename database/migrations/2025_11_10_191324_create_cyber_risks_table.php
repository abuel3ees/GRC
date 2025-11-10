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
        Schema::create('cyber_risks', function (Blueprint $table) {
                  $table->id();
        $table->string('code')->unique(); // R1, R2, etc.
        $table->string('title'); // Plain-text passwords, etc.
        $table->text('risk_statement');
        $table->text('cause')->nullable();
        $table->text('consequence')->nullable();
        $table->text('existing_control')->nullable();
        $table->integer('likelihood');
        $table->integer('impact');
        $table->integer('score');
        $table->enum('residual_level', ['Low','Medium','High'])->default('High');
        $table->text('mitigation_plan')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cyber_risks');
    }
};
