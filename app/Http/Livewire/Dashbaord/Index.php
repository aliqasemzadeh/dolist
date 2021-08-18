<?php

namespace App\Http\Livewire\Dashbaord;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $task;

    protected $listeners = [
        'confirmedDone',
        'cancelledDone',
        'updateTasksList' => '$refresh',
    ];

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
        $tasks = Task::where('user_id', auth()->user()->id)->where('status', 'create')->latest()->paginate(config('dolist.per_page'));
        return view('livewire.dashbaord.index', compact('tasks'));
    }
}
