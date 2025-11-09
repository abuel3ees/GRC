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
        Schema::create('policies', function (Blueprint $table) {
           $table->id();
    $table->string('title');
    $table->text('description')->nullable();
    $table->string('document_path')->nullable(); // uploaded file
    $table->enum('status', ['draft', 'under_review', 'approved', 'published'])->default('draft');
    $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
    $table->date('review_date')->nullable();
    $table->softDeletes();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
