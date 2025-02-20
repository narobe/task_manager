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
    Schema::create('tasks', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(\App\Models\User::class, 'user_id')->constrained()->cascadeOnDelete();
      $table->string('title');
      $table->text('description')->nullable();
      $table->dateTime('due_date');
      $table->enum('priority', ["low", "medium", "high"]);
      $table->enum('status', ["todo", "in_progress", "completed"])->default('todo');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tasks');
  }
};
