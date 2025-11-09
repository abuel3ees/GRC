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
        Schema::create('risks', function (Blueprint $table) {
              $table->id();
    $table->string('risk_code')->unique(); // e.g. RSK-001
    $table->string('title');
    $table->text('description')->nullable();
    $table->enum('category', ['Operational', 'Financial', 'IT', 'Strategic', 'Compliance'])->default('Operational');
    $table->unsignedTinyInteger('likelihood')->default(1);
    $table->unsignedTinyInteger('impact')->default(1);
    $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
    $table->enum('status', ['Open', 'Mitigating', 'Closed'])->default('Open');
    $table->softDeletes();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risks');
    }
};
