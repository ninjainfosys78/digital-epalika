<?php

namespace Modules\Revenue\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class InvoiceFormLivewire extends Component
{
    public $particulars = [];
    public $revenueCategories = [];
    public $revenues = [];
    public $form = [
        'quantity' => 1,
        'rate' => 0,
        'fine' => 0,
        'remarks' => ''

    ];
    public $index = null;

    public function mount($formDetail = [])
    {
        $this->revenueCategories = get_revenue_categories();
        foreach ($formDetail as $value) {
            $this->particulars[] = $value;
        }

        //        dd($this->particulars);
    }

    protected $rules = [
        'form.revenue_category_id' => ['required', 'exists:revenue_categories,id,deleted_at,NULL'],
        'form.revenue_id' => ['required', 'exists:revenues,id,deleted_at,NULL'],
        'form.quantity' => ['required', 'numeric', 'min:0'],
        'form.rate' => ['required', 'numeric', 'min:0'],
        'form.fine' => ['required', 'numeric', 'min:0'],
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

    public function setRate()
    {
        if (!empty($this->form['revenue_id'])) {
            $this->form['rate'] = get_revenues(revenueId: $this->form['revenue_id'])->amount;
        }
    }

    public function render(): Factory|View|Application
    {
        if (!empty($this->form['revenue_category_id'])) {
            $this->revenues = get_revenues(revenueCategories: $this->form['revenue_category_id']);
        }

        return view('revenue::livewire.invoice-form-livewire');
    }
}
