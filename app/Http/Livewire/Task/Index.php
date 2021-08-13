<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $task;

    protected $listeners = [
        'confirmedRemove',
        'cancelledRemove',
        'updateTasksList' => '$refresh',
    ];

    public function remove(Task $task)
    {
        $this->confirm(__('dolist.are_you_sure'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('dolist.cancel'),
            'onConfirmed' => 'confirmedRemove',
            'onCancelled' => 'cancelledRemove'
        ]);

        $this->task = $task;
    }

    public function confirmedRemove()
    {
        if(auth()->user()->id != $this->task->user_id) {
            abort(400);
        }

        $this->task->delete();

        $this->alert(
            'success',
            __('dolist.done')
        );
    }

    public function cancelledRemove()
    {
        $this->alert(
            'success',
            __('dolist.cancelled')
        );
    }



    public function render()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->latest()->paginate(config('dolist.per_page'));
        return view('livewire.task.index', compact('tasks'));
    }
}
