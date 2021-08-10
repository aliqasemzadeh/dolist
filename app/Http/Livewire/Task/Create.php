<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    public $title;
    public $description;
    public $projectId;
    public $duration = 0;

    public function create()
    {
        $this->validate([
            'title' => 'string|required',
            'duration' => 'numeric|required'
        ]);

        $task = new Task();
        $task->title = $this->title;
        $task->description = $this->description;
        $task->duration = $this->duration;
        $task->user_id = auth()->user()->id;
        $task->save();

        $this->closeModalWithEvents([
           'updateTasks',
        ]);

        $this->alert(
            'success',
            __('dolist.created')
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

    public function render()
    {
        return view('livewire.task.create');
    }
}
