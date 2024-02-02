<?php

namespace Modules\DigitalBoard\Http\Livewire;

use Livewire\Component;
use Modules\DigitalBoard\Entities\ServiceProcess;

class ServiceProcessLivewire extends Component
{
    public $serviceProcesses = [];

    public function mount($service = null)
    {
        if (!empty($service)) {
            foreach ($service->serviceProcesses as $serviceProcess) {
                $this->serviceProcesses[] = [
                    'id' => $serviceProcess->id,
                    'description' => $serviceProcess->description,
                ];
            }
        } else {
            $this->serviceProcesses[] = [];
        }
    }

    public function addRow()
    {
        $this->serviceProcesses[] = [];
    }

    public function removeRow($index)
    {
        if (!empty($this->serviceProcesses[$index]['id'])) {
            ServiceProcess::find($this->serviceProcesses[$index]['id'])->delete();
        }

        unset($this->serviceProcesses[$index]);
        $this->serviceProcesses = array_values($this->serviceProcesses);
    }

    public function render()
    {
        return view('digitalboard::livewire.service-process-livewire');
    }
}
