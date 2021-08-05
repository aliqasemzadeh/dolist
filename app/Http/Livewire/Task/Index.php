<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $task;
    public $tasks;

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
        $this->task->delete();

        $this->tasks = Task::where('user_id', auth()->user()->id)->latest()->get();

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
        $this->tasks = Task::where('user_id', auth()->user()->id)->latest()->get();
        return view('livewire.task.index');
    }
}
