<div>
  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">

      <h2 class="mb-4 font-semibold text-xl text-gray-800 leading-tight">
        Add Task
      </h2>
      <form wire:submit.prevent="save">
        <div class="flex max-sm:flex-col gap-x-8 gap-y-2">

          <div class="grow space-y-4">
            <!-- Title -->
            <div>
              <x-input-label for="title" :value="__('Title')" />
              <x-text-input wire:model="title" id="title" class="block mt-1 w-full" type="text" wire:model="title"
                name="title" required autocomplete="title" />
              <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <!-- Description -->
            <div class="">
              <x-input-label for="description" :value="__('Description')" />
              <textarea
                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                wire:model="description" id="description" class="block mt-1 w-full" type="text" name="description"
                required autocomplete="username"></textarea>
              <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
          </div>
          <div class="grow  space-y-4">
            <!-- Due Date -->
            <div class="w-full">
              <x-input-label for="password" :value="__('Due Date')" />
              <x-text-input class="w-full" type="date" wire:model="due_date" id="password" required />
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <!-- Priority -->
            <div class="w-full">
              <x-input-label for="priority" :value="__('Priority')" />
              <select
                class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                wire:model="priority">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
              </select>
              <x-input-error :messages="$errors->get('priority')" class="mt-2" />
            </div>
            <!-- Status -->
            <div class="w-full">
              <x-input-label for="priority" :value="__('Priority')" />
              <select
                class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sms"
                wire:model="status">
                <option value="todo">To Do</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
              </select>
            </div>

          </div>
        </div>

        <div class="flex items-center justify-center ">
          <x-primary-button class="mt-2 max-sm:w-full justify-center text-center">
            {{ __('Save') }}
          </x-primary-button>
        </div>
      </form>

      @if (session()->has('message'))
      <div>{{ session('message') }}</div>
      @endif
    </div>
  </div>
</div>