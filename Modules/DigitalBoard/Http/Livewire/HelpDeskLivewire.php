<?php

namespace Modules\DigitalBoard\Http\Livewire;

use App\Models\Settings\Branch;
use Livewire\Component;
use Modules\DigitalBoard\Entities\Service;

class HelpDeskLivewire extends Component
{
    public $branches = [];

    public $services = [];

    public $indexToShow = 0;

    public function mount()
    {
        $this->branches = Branch::with('branches')->whereNull('branch_id')->get();
        $this->services = Service::whereNull('branch_id')->get();
    }

    public function setBranchId(Branch $branch)
    {
        $branch->load('services');
        $this->services = $branch->services;
    }

    public function resetService()
    {
        $this->reset('services');
    }

    public function render()
    {
        return view('digitalboard::livewire.help-desk-livewire');
    }
}
