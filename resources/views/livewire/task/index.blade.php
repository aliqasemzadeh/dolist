<div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-4">
    @foreach($tasks as $task)
        <div class="mt-4 mb-4">
            <x-card title="{{ $task->title }}">
                <x-slot name="action">
                    <button wire:click="remove({{ $task }})" class="rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <x-icon name="trash" class="w-4 h-4 text-gray-500" />
                    </button>
                </x-slot>
                @if($task->status == 'done')
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-green-100 text-green-800">
                  {{ __('dolist.'.$task->status) }}
                </span>
                @endif
                {{ __('dolist.duration') }}:{{ $task->duration }}
                <br />
                {{ $task->description }}
            </x-card>
        </div>
    @endforeach

    {{ $tasks->links() }}
</div>
