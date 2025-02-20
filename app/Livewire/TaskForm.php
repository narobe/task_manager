<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskForm extends Component
{

  public $title;
  public $description;
  public $due_date;
  public $priority = 'medium';
  public $status = 'todo';

  public function save()
  {
    $this->validate([
      'title' => 'required|string|max:255',
      'description' => 'nullable|string',
      'due_date' => 'required|date',
      'priority' => 'required|in:low,medium,high',
      'status' => 'required|in:todo,in_progress,completed',
    ]);

    Task::create([
      'user_id' => auth()->id(),
      'title' => $this->title,
      'description' => $this->description,
      'due_date' => $this->due_date,
      'priority' => $this->priority,
      'status' => $this->status,
    ]);

    $this->reset();
    session()->flash('message', 'Task created successfully!');
  }


  public function render()
  {
    return view('livewire.task-form');
  }
}
