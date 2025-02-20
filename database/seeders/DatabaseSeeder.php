<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    \App\Models\User::factory()->create([
      'name' => 'cube',
      'email' => 'cube@mail.me',
      'password' => Hash::make('123'),
    ]);
    \App\Models\User::factory(4)->create()->each(function ($user) {
      $user->tasks()->saveMany(\App\Models\Task::factory(4)->create([
        'user_id' => $user,
      ]));
      $user->tags()->saveMany(\App\Models\Tag::factory(3)->create([
        'user_id' => $user,
      ]));
    });

    \App\Models\Task::all()->each(function ($task) {
      $task->tags()->attach(\App\Models\Tag::inRandomOrder()->take(2)->pluck('id'));
      $task->notes()->saveMany(\App\Models\Note::factory(2)->create([
        'task_id' => $task,
      ]));
    });
  }
}
