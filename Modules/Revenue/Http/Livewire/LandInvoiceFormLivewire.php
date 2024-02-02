<?php

namespace Modules\Revenue\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LandInvoiceFormLivewire extends Component
{
    public $particulars = [];
    public $revenueCategories = [];
    public $revenues = [];
    public $form = [
        'quantity' => 1,
        'rate' => 0,
        'fine' => 0,
        'due' => 0,
        'remarks' => ''

    ];
    public $index = null;

    public function mount($formDetail = [])
    {
        foreach ($formDetail as $value) {
            $this->particulars[] = $value;
        }
    }

    protected $rules = [
        'form.revenue' => ['required', 'string'],
        'form.quantity' => ['required', 'numeric', 'min:0'],
        'form.rate' => ['required', 'numeric', 'min:0'],
        'form.fine' => ['required', 'numeric', 'min:0'],
        'form.due' => ['required', 'numeric', 'min:0'],
        'form.remarks' => ['nullable', 'string'],
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addDetail()
    {
        $this->validate();
        if ($this->index !== null) {
            $this->particulars[$this->index] = $this->form;
            $this->index = null;
        } else {
            $this->particulars[] = $this->form;
        }

        $this->reset('form');
    }

    public function editDetail($index)
    {
        $this->index = $index;
        $this->form = $this->particulars[$index];
    }


    public function removeDetail($index)
    {
        unset($this->particulars[$index]);
        $this->particulars = array_values($this->particulars);
    }


    public function render(): Factory|View|Application
    {
        return view('revenue::livewire.land-invoice-form');
    }
}
