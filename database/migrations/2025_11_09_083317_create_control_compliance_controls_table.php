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
        Schema::create('control_compliance_controls', function (Blueprint $table) {
             $table->id();
    $table->foreignId('control_id')->constrained('controls')->onDelete('cascade');
    $table->foreignId('compliance_control_id')->constrained('compliance_controls')->onDelete('cascade');
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('control_compliance_controls');
    }
};
