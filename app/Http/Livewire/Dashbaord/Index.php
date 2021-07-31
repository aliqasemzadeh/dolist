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

    public function mount()
    {
        $this->tasks = Task::where('user_id', auth()->user()->id)->latest()->get();
    }

    public function create()
    {
        $this->validate([
           'title' => 'string|required'
        ]);

        Task::Create(['title' => $this->title, 'user_id' => auth()->user()->id]);

        $this->tasks = Task::where('user_id', auth()->user()->id)->latest()->get();

        $this->alert(
            'success',
            __('dolist.created')
        );
    }



    public function render()
    {
        return view('livewire.dashbaord.index');
    }
}
