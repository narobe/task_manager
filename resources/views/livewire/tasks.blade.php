<div>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Tasks') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="space-y-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
      <livewire:task-stats />
      <livewire:task-list />
      <livewire:task-form />
    </div>

  </div>

</div>