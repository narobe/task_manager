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
    Schema::create('tag_task', function (Blueprint $table) {
      $table->foreignIdFor(\App\Models\Tag::class, 'tag_id')->constrained()->cascadeOnDelete();
      $table->foreignIdFor(\App\Models\Task::class, 'task_id')->constrained()->cascadeOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('tag_task');
  }
};
