<?php

namespace Modules\DigitalBoard\Http\Livewire;

use Livewire\Component;
use Modules\DigitalBoard\Entities\ServiceDocument;

class ServiceDocumentLivewire extends Component
{
    public $serviceDocuments = [];

    public function mount($service = null)
    {
        if (!empty($service)) {
            foreach ($service->serviceDocuments as $serviceDocument) {
                $this->serviceDocuments[] = [
                    'id' => $serviceDocument->id,
                    'description' => $serviceDocument->description,
                ];
            }
        } else {
            $this->serviceDocuments[] = [];
        }
    }

    public function addRow()
    {
        $this->serviceDocuments[] = [];
    }

    public function removeRow($index)
    {
        if (!empty($this->serviceDocuments[$index]['id'])) {
            ServiceDocument::find($this->serviceDocuments[$index]['id'])->delete();
        }
        unset($this->serviceDocuments[$index]);
        $this->serviceDocuments = array_values($this->serviceDocuments);
    }

    public function render()
    {
        return view('digitalboard::livewire.service-document-livewire');
    }
}
