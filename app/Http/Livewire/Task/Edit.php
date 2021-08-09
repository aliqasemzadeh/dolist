<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{

    public $task;
    public $title;
    public $description;

    public function edit()
    {
        $this->validate([
            'title' => 'string|required'
        ]);

        $this->task->title = $this->title;
        $this->task->description = $this->description;
        $this->task->save();

        $this->closeModalWithEvents([
            \App\Http\Livewire\Dashbaord\Index::getName() => 'updateTasks',
            \App\Http\Livewire\Task\Index::getName() => 'render',

        ]);

        $this->alert(
            'success',
            __('dolist.edited')
        );
    }

    public function mount(Task $task)
    {
        if(auth()->user()->id != $task->user_id) {
            abort(400);
        }

        $this->task = $task;
        $this->title = $task->title;
        $this->description = $task->description;

    }

    public function render()
    {
        return view('livewire.task.edit');
    }
}
