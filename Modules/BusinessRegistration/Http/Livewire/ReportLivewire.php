<?php

namespace Modules\BusinessRegistration\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\BusinessRegistration\Entities\BusinessDetail;

class ReportLivewire extends Component
{
    public $businessDetails = [];
    public $fiscalYears = [];
    public $businessPurposes = [];
    public $objectTransactions = [];
    public $investmentRevenues = [];
    public $businessYears = [];
    public $columnData = [];

    public array $form = [
        'date' => [
            'from_date' => null,
            'to_date' => null,
        ],
        'fiscal_year' => [],
        'business_nature' => [],
        'business_purpose' => [],
        'object_transaction' => [],
        'investment_revenue' => [],
        'registration_renewal' => [],
        'investment' => [],
        'employment' => [],
        'business_year' => [],
        'introBoard' => [],
        'column' => [],
    ];

    public array $class = ["card-body", "d-none"];

    protected $rules = [
        'form.date.from_date' => ['nullable', 'date', 'before_or_equal:form.date.to_date'],
        'form.date.to_date' => ['nullable', 'date', 'after_or_equal:form.date.from_date']
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function mount(): void
    {
    }

    protected $listeners = ['fromDateChanged', 'toDateChanged'];

    public function fromDateChanged($nepaliDate): void
    {
        $this->form['date']['from_date'] = $nepaliDate;
    }

    public function toDateChanged($nepaliDate): void
    {
        $this->form['date']['to_date'] = $nepaliDate;
    }

    public function submitForm(): void
    {
        $this->validate();

        if (!empty($this->form['column']['business_details'])) {
            $filteredColumns = $this->form['column']['business_details'];
        }

        $this->businessDetails = BusinessDetail::select(!empty($filteredColumns) ? array_merge($filteredColumns, ['id']) : '*')
            ->where(function ($q) {
                $this->filterDataFromUser($q);
            })
            ->get();

        $this->filterIntroBoardData();

        $this->filterObjectTransaction();

        $this->filterRegistrationRenewal();
        $this->reset('class');
    }

    public function render(): Factory|View|Application
    {
        return view('businessregistration::livewire.report-livewire');
    }

    public function showFilterForm(): void
    {
        if (in_array('d-none', $this->class)) {
            unset($this->class[1]);
        } else {
            $this->class[] = "d-none";
        }
    }





    private function filterIntroBoardData(): void
    {
        if (!empty($this->form['introBoard']['from']) && !empty($this->form['introBoard']['to'])) {
            $this->businessDetails = $this->businessDetails->filter(function ($detail) {
                if (!empty($detail->proprietorDetail)
                    && !empty($detail->proprietorDetail->introboard)) {
                    $square = (int)$detail->proprietorDetail->introboard->square;
                    return $this->form['introBoard']['from'] <= $square && $square <= $this->form['introBoard']['to'];
                }
                return false;
            });
        }
    }

    private function filterObjectTransaction(): void
    {
        if (!empty($this->form['object_transaction'])) {
            $this->businessDetails = $this->businessDetails->filter(function ($detail) {
                if (!empty($detail->investmentRevenue)) {
                    $objectTransactionId = (int)$detail->investmentRevenue->object_transaction_id;
                    return in_array($objectTransactionId, $this->form['object_transaction'], true);
                }
                return false;
            });
        }
    }

    private function filterRegistrationRenewal(): void
    {
        if (!empty($this->form['registration_renewal'])) {
            $this->businessDetails = $this->businessDetails->filter(function ($detail) {
                if (!empty($detail->proprietorDetail)) {
                    $businessType = (int)$detail->proprietorDetail->business_type;
                    return in_array($businessType, $this->form['registration_renewal'], true);
                }
                return false;
            });
        }
    }
}
