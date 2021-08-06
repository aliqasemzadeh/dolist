<div>
    <x-card title="{{ __('dolist.add_task') }}">
        <x-input label="{{ __('dolist.title') }} *" placeholder="{{ __('dolist.title') }}" wire:model="title" value="{{ old('title', $task->title) }}" />
        <x-textarea label="{{ __('dolist.description') }}" placeholder="{{ __('dolist.description') }}" wire:model="description"  value="{{ old('title', $task->description) }}" />
        <x-slot name="footer">
            <div class="flex justify-between items-center">
                <x-button label="{{ __('dolist.edit') }}" wire:click="edit" primary />
            </div>
        </x-slot>
    </x-card>
</div>
