<div class="bg-white p-6 rounded-lg shadow-md">
  <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
    Task Statistics
  </h2>

  <!-- Filter Buttons -->
  <div class="flex space-x-4 mb-6">
    <button wire:click="filterPeriodTo('week')"
      class="inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 {{ $filterPeriod === 'week' ? 'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900' : 'bg-gray-200 hover:bg-gray-300 text-gray-900 focus:bg-gray-300 active:bg-gray-100' }}">
      This Week
    </button>

    <button wire:click="filterPeriodTo('month')"
      class="inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 {{ $filterPeriod === 'month' ? 'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900' : 'bg-gray-200 hover:bg-gray-300 text-gray-900 focus:bg-gray-300 active:bg-gray-100' }}">
      This Month
    </button>
    <button wire:click="filterPeriodTo('year')"
      class="inline-flex items-center px-4 py-2  border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 {{ $filterPeriod === 'year' ? 'bg-gray-800 text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900' : 'bg-gray-200 hover:bg-gray-300 text-gray-900 focus:bg-gray-300 active:bg-gray-100' }}">
      This Year
    </button>
  </div>

  <!-- Stats Cards -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- To Do -->
    <div class="p-4 bg-blue-50 rounded-lg">
      <h3 class="text-lg font-semibold">To Do</h3>
      <p class="text-2xl font-bold">{{ round($statusPercentages['todo'], 1) }}%</p>
      <p class="text-sm text-gray-600">{{ $totalTasks }} total tasks</p>
    </div>

    <!-- In Progress -->
    <div class="p-4 bg-yellow-50 rounded-lg">
      <h3 class="text-lg font-semibold">In Progress</h3>
      <p class="text-2xl font-bold">{{ round($statusPercentages['in_progress'], 1) }}%</p>
      <p class="text-sm text-gray-600">{{ $totalTasks }} total tasks</p>
    </div>

    <!-- Completed -->
    <div class="p-4 bg-green-50 rounded-lg">
      <h3 class="text-lg font-semibold">Completed</h3>
      <p class="text-2xl font-bold">{{ round($statusPercentages['completed'], 1) }}%</p>
      <p class="text-sm text-gray-600">{{ $totalTasks }} total tasks</p>
    </div>
  </div>
  <!-- Doughnut Chart -->
  <div class="mt-6 sm:w-96 max-sm:w-full">
    <canvas id="taskStatusChart" width="400" height="400"></canvas>
  </div>


  <script>
    document.addEventListener('livewire:init', function () {
    //    console.log('Livewire initialized');
    // console.log('Chart.js available:', window.Chart);
        const ctx = document.getElementById('taskStatusChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['To Do', 'In Progress', 'Completed'],
                datasets: [{
                    label: 'Task Status',
                    data: [
                        {{round($statusPercentages['todo'], 1)}},
                        {{round($statusPercentages['in_progress'], 1)}},
                        {{round($statusPercentages['completed'], 1)}},
                    ],
                    backgroundColor: [
                        '#f97316', // Blue for To Do
                        '#2563eb', // Yellow for In Progress
                        '#22c55e'  // Green for Completed
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `${context.label}: ${context.raw}%`;
                            }
                        }
                    }
                }
            }
        });

        // Update the chart when Livewire updates the data
        Livewire.on('statsUpdated', () => {
            chart.data.datasets[0].data = [
              {{round($statusPercentages['todo'], 1)}},
              {{round($statusPercentages['in_progress'], 1)}},
              {{round($statusPercentages['completed'], 1)}},
            ];
            chart.update();
        });
    });
  </script>
</div>