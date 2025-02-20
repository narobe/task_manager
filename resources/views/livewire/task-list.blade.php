<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
  <div class="p-6 text-gray-900">
    <h2 class=" mb-4 font-semibold text-xl text-gray-800 leading-tight">
      All Tasks
    </h2>

    <div>
      <select class=" border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        wire:model.live="sortBy">
        <option value="due_date">Sort by Due Date</option>
        <option value="priority">Sort by Priority</option>
      </select>

      <select class=" border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        wire:model.live="filterStatus">
        <option value="">All</option>
        <option value="todo">To Do</option>
        <option value="in_progress">In Progress</option>
        <option value="completed">Completed</option>
      </select>

      <label class="max-sm:block max-sm:mt-2 font-medium text-gray-700">
        <input class=" border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
          type="checkbox" wire:model.live="filterWeek"> Show Tasks for This Week
      </label>
    </div>
    <ul class="mt-4 grid sm:grid-cols-2 sm:gap-4 gap-2">
      @forelse ($tasks as $task)
      <li wire:key="{{ $task->id }}"
        class="flex flex-col justify-between border border-gray-200 p-2 shadow-sm sm:rounded-lg">
        <div class="">
          @if ($editorMode == $task)
          <input
            class="mb-1 block font-medium  text-gray-700 border-gray-300 py-1 px-2 w-full focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
            type="text" wire:model.live="title" value="{{ $task->description }}">

          <textarea rows="4" wire:model.live="description"
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm  text-gray-700 text-sm ">{{ $task->description }}</textarea>
          @else
          <span class="mb-1 block font-medium  text-gray-700">{{ $task->title }}</span>
          <p class="text-gray-700 text-sm">{{ $task->description }}</p>
          @endif
        </div>
        <div class="mt-2 px-2 py-1 flex items-center justify-between">
          <div class="flex items-center gap-2 text-sm text-gray-700">
            <span class="italic">{{ $task->due_date->format('Y-m-d') }}</span>

            @if ($editorMode == $task)
            <select
              class="px-2 text-xs font-medium leading-none pb-1 pt-0.5 rounded-full {{ $task->status === 'completed' ? 'bg-green-500 text-gray-50' : 'bg-gray-200' }} {{ $task->status === 'todo' ? 'bg-orange-500 text-gray-50' : 'bg-gray-200' }} {{ $task->status === 'in_progress' ? 'bg-blue-600 text-gray-50' : 'bg-gray-200' }}"
              wire:model.live="status">
              <option class="bg-orange-500 text-gray-50" {{ $task->status === "todo" ? 'selected' : ''}} value="todo">
                To Do
              </option>
              <option class="bg-blue-600 text-gray-50" {{ $task->status === "in_progress" ? 'selected' : ''}}
                value="in_progress">
                In Progress
              </option>
              <option class="bg-green-500 text-gray-50" {{ $task->status === "completed" ? 'selected' : ''}}
                value="completed">
                Completed
              </option>
            </select>
            @else
            <span
              class="px-2 text-xs font-medium leading-none pb-1 pt-0.5 rounded-full {{ $task->status === 'completed' ? 'bg-green-500 text-gray-50' : 'bg-gray-200' }} {{ $task->status === 'todo' ? 'bg-orange-500 text-gray-50' : 'bg-gray-200' }} {{ $task->status === 'in_progress' ? 'bg-blue-600 text-gray-50' : 'bg-gray-200' }}">
              {{ ucfirst($task->status) }}
            </span>
            @endif

          </div>
          <div class="flex items-center gap-2">
            @if ($editorMode == $task)
            <span wire:click="upd({{$task}})" class="cursor-pointer font-medium text-sm text-gray-700 ">Done</span>
            @else
            <span wire:click="editor({{$task}})" class="cursor-pointer font-medium text-sm text-gray-700 ">Edit</span>
            @endif
            <span wire:click="delete({{$task}})" class="cursor-pointer font-medium text-sm text-gray-700 ">Delete</span>
          </div>
        </div>
      </li>
      @empty
      <span class="font-medium text-gray-700">
        No Task
      </span>
      @endforelse
    </ul>
  </div>
</div>