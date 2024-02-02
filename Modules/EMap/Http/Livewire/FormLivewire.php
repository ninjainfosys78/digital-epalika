<?php

namespace Modules\EMap\Http\Livewire;

use Livewire\Component;
use Modules\EMap\Entities\New\MapPassGroup;

class FormLivewire extends Component
{
    public $mapPassGroups = [];
    public array $form = [];

    public function mount($data = null): void
    {
        $this->mapPassGroups = MapPassGroup::latest()->get();
    }

    public function addDocument(): void
    {
        $this->form['documents'][] = [];
    }

    public function save()
    {
        dd($this->form);
    }

    public function render()
    {
        return view('emap::livewire.form-livewire');
    }
}
