<div>
    <x-card title="{{ __('dolist.add_task') }}">
        <x-input label="{{ __('dolist.title') }} *" placeholder="{{ __('dolist.title') }}" wire:model="title" />

        <x-input label="{{ __('dolist.duration') }}" placeholder="{{ __('dolist.duration') }}" wire:modal="duration" class="pl-12">
            <x-slot name="prepend">
                <div class="absolute inset-y-0 left-0 flex items-center p-0.5">
                    <x-button
                        class="rounded-l-md h-full"
                        wire:click="minus"
                        icon="minus"
                        primary
                        flat
                        squared
                    />
                </div>
            </x-slot>

            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                    <x-button
                        wire:click="plus"
                        class="rounded-r-md h-full"
                        icon="plus"
                        primary
                        flat
                        squared
                    />
                </div>
            </x-slot>
        </x-input>

        <x-textarea label="{{ __('dolist.description') }}" placeholder="{{ __('dolist.description') }}" wire:model="description" />
        <x-slot name="footer">
            <div class="flex justify-between items-center">
                <x-button label="{{ __('dolist.save') }}" wire:click="create" primary />
            </div>
        </x-slot>
    </x-card>

</div>
