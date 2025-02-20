<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

class TaskList extends Component
{
  public $tasks;
  public $description;
  public $status;
  public $title;
  public $editorMode = false;
  public $sortBy = 'due_date';
  public $filterStatus = '';
  public $filterWeek = false;

  public function mount()
  {
    $this->loadTasks();
  }

  public function loadTasks()
  {
    $query = Task::where('user_id', auth()->id())
      ->orderBy($this->sortBy, 'asc');

    if ($this->filterStatus) {
      $query->where('status', $this->filterStatus);
    }

    if ($this->filterWeek) {
      $startOfWeek = Carbon::now()->startOfWeek();
      $endOfWeek = Carbon::now()->endOfWeek();
      $query->whereBetween('due_date', [$startOfWeek, $endOfWeek]);
    }

    $this->tasks = $query->get();
  }

  public function updatedSortBy()
  {
    $this->loadTasks();
  }

  public function updatedFilterStatus()
  {
    $this->loadTasks();
  }

  public function updatedFilterWeek()
  {
    $this->loadTasks();
  }


  public function upd(Task $task)
  {
    $task->description = $this->description;
    $task->status = $this->status;
    $task->title = $this->title;
    $task->save();
    $this->editorMode = false;
    $this->loadTasks();
  }
  public function delete(Task $task)
  {
    $task->delete();
    $this->loadTasks();
  }

  public function editor(Task $task)
  {
    $this->description = $task->description;
    $this->title = $task->title;
    $this->editorMode = $task;
  }

  #[Layout('layouts.app')]

  public function render()
  {
    return view('livewire.task-list');
  }
}
