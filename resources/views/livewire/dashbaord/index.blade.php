<div>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-4">
        <x-button primary label="{{ __('dolist.create') }}" wire:click="$emit('openModal', 'task.create')"  />
    </div>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-4">
        @foreach($tasks as $task)
            <div class="mt-4 mb-4">
                <x-card title="{{ $task->title }}">
                    <x-slot name="action">
                        <button wire:click="done({{ $task }})" class="rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600">
                            <x-icon name="check" class="w-4 h-4 text-gray-500" />
                        </button>
                        <button class="rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600" wire:click='$emit("openModal", "task.edit", {{ json_encode(["task" => $task->id]) }})'><x-icon name="pencil-alt" class="w-4 h-4 text-gray-500" /></button>

                    </x-slot>
                    {{ __('dolist.duration') }}:{{ $task->duration }}
                    {{ $task->description }}
                </x-card>
            </div>
        @endforeach
    </div>

</div>
