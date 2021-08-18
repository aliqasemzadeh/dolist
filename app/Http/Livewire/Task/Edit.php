<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{

    public $task;
    public $title;
    public $duration;
    public $description;

    public function edit()
    {
        $this->validate([
            'title' => 'string|required',
            'duration' => 'numeric|required'
        ]);

        $this->task->title = $this->title;
        $this->task->duration = $this->duration;
        $this->task->description = $this->description;
        $this->task->save();

        $this->closeModalWithEvents(['updateTasksList']);

        $this->alert(
            'success',
            __('dolist.edited')
        );
    }


    public function minus()
    {
        if($this->duration == 0) {
            $this->duration = 0;
        } else {
            $this->duration = $this->duration - 1;
        }
    }

    public function plus()
    {
        $this->duration = $this->duration + 1;
    }



    public function mount(Task $task)
    {
        if(auth()->user()->id != $task->user_id) {
            abort(400);
        }

        $this->task = $task;
        $this->title = $task->title;
        $this->duration = $task->duration;
        $this->description = $task->description;

    }

    public function render()
    {
        return view('livewire.task.edit');
    }
}
