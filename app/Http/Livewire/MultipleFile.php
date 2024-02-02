<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MultipleFile extends Component
{
    public $files = [];

    public function mount()
    {
    }

    public function addFileRow()
    {
        $this->files[] = [];
    }

    public function removeFileRow($index)
    {
        unset($this->files[$index]);
        $this->files = array_values($this->files);
    }

    public function render()
    {
        return view('livewire.multiple-file');
    }
}
