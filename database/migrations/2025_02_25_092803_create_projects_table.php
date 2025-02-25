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
    Schema::create('projects', function (Blueprint $table) {
      $table->id();
      $table->string('title');
      $table->string('slug')->unique();
      $table->text('description');
      $table->text('content');
      $table->string('featured_image')->nullable();
      $table->date('start_date');
      $table->date('end_date')->nullable();
      $table->enum('status', ['current', 'completed', 'upcoming']);
      $table->json('gallery')->nullable();
      $table->json('meta_data')->nullable();
      $table->timestamps();
      $table->fullText(['title', 'description', 'content']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('projects');
  }
};
