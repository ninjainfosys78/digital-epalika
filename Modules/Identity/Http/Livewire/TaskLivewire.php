<?php

namespace Modules\Identity\Http\Livewire;

use Livewire\Component;

class TaskLivewire extends Component
{
    public $tasks = [];
    public $hasNameGroup = false;

    public function mount($tasks, $hasNameGroup = false)
    {
        $this->tasks = $tasks;
        $this->hasNameGroup = $hasNameGroup;
    }

    public function incrementTask()
    {
        $this->tasks[] = null;
    }

    public function decrementTask($index)
    {
        unset($this->tasks[$index]);
        $this->tasks = array_values($this->tasks);
    }

    public function render()
    {
        return view('identity::livewire.task-livewire');
    }
}
