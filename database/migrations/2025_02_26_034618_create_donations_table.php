<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('donations', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('email');
      $table->decimal('amount', 12, 2);
      $table->string('currency')->default('MWK');
      $table->string('paychangu_transaction_id')->nullable();
      $table->string('status')->default('pending');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('donations');
  }
};
