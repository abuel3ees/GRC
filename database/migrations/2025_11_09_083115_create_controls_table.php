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
        Schema::create('controls', function (Blueprint $table) {
              $table->id();
    $table->string('control_code')->unique(); // e.g. CTRL-001
    $table->string('title');
    $table->text('description')->nullable();
    $table->foreignId('policy_id')->nullable()->constrained('policies')->onDelete('set null');
    $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
    $table->softDeletes();
    $table->timestamps();
        });

        Schema::create('risk_controls', function (Blueprint $table) {
    $table->id();
    $table->foreignId('risk_id')->constrained('risks')->onDelete('cascade');
    $table->foreignId('control_id')->constrained('controls')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controls');
    }
};
