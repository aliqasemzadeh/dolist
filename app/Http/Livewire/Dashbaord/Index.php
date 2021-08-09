<?php

namespace App\Http\Livewire\Dashbaord;

use App\Models\Task;
use Livewire\Component;

class Index extends Component
{
    public $title;
    public $description;
    public $projectId;
    public $duration;

    public $task;
    public $tasks;


    protected $listeners = [
        'confirmedDone',
        'cancelledDone',
        'updateTasks',
    ];

    public function mount()
    {
        $this->tasks = Task::where('user_id', auth()->user()->id)->where('status', 'create')->latest()->get();
    }

    public function updateTasks()
    {
        $this->tasks = Task::where('user_id', auth()->user()->id)->where('status', 'create')->latest()->get();
    }

    public function create()
    {
        $this->validate([
           'title' => 'string|required'
        ]);

        $task = new Task();
        $task->title = $this->title;
        $task->description = $this->description;
        $task->user_id = auth()->user()->id;
        $task->save();

        $this->tasks = Task::where('user_id', auth()->user()->id)->where('status', 'create')->latest()->get();

        $this->alert(
            'success',
            __('dolist.created')
        );
    }

    public function done(Task $task)
    {

        $this->confirm(__('dolist.are_you_sure'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('dolist.cancel'),
            'onConfirmed' => 'confirmedDone',
            'onCancelled' => 'cancelledDone'
        ]);
        $this->task = $task;
    }


    public function confirmedDone()
    {
        $this->task->status = 'done';
        $this->task->save();
        $this->tasks = Task::where('user_id', auth()->user()->id)->where('status', 'create')->latest()->get();
        $this->alert(
            'success',
            __('dolist.done')
        );
    }

    public function cancelledDone()
    {
        $this->alert(
            'success',
            __('dolist.cancelled')
        );
    }

    public function render()
    {
        return view('livewire.dashbaord.index');
    }
}
