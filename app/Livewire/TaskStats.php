<?php

namespace App\Livewire;

use App\Models\Task;
use Illuminate\Support\Carbon;
use Livewire\Component;

class TaskStats extends Component
{

  public $filterPeriod = 'week'; // Default filter: week
  public $statusPercentages = [];
  public $totalTasks = 0;

  public function mount()
  {
    $this->loadStats();
  }

  public function filterPeriodTo($time)
  {
    $this->filterPeriod = $time;
    $this->loadStats();
  }

  public function loadStats()
  {
    $query = Task::where('user_id', auth()->id());

    // Apply period filter
    if ($this->filterPeriod === 'week') {
      $start = Carbon::now()->startOfWeek();
      $end = Carbon::now()->endOfWeek();
    } elseif ($this->filterPeriod === 'month') {
      $start = Carbon::now()->startOfMonth();
      $end = Carbon::now()->endOfMonth();
    } elseif ($this->filterPeriod === 'year') {
      $start = Carbon::now()->startOfYear();
      $end = Carbon::now()->endOfYear();
    } else {
      $start = null;
      $end = null;
    }
    if ($start && $end) {
      $query->whereBetween('due_date', [$start, $end]);
    }

    // Get total tasks
    $this->totalTasks = $query->count();

    // Calculate status percentages
    $statusCounts = $query->selectRaw('status, count(*) as count')
      ->groupBy('status')
      ->pluck('count', 'status');

    $this->statusPercentages = [
      'todo' => ($statusCounts['todo'] ?? 0) / max($this->totalTasks, 1) * 100,
      'in_progress' => ($statusCounts['in_progress'] ?? 0) / max($this->totalTasks, 1) * 100,
      'completed' => ($statusCounts['completed'] ?? 0) / max($this->totalTasks, 1) * 100,
    ];
  }

  public function updatedFilterPeriod()
  {
    $this->loadStats();
    $this->emit('statsUpdated'); // Emit event to update the chart
  }

  public function render()
  {
    return view('livewire.task-stats');
  }
}
