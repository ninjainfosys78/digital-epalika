<?php

namespace Modules\Grant\Http\Livewire;

use Livewire\Component;
use Modules\Grant\Entities\Cooperative;
use Modules\Grant\Entities\Enterprise;
use Modules\Grant\Entities\Farmer;
use Modules\Grant\Entities\Grant;
use Modules\Grant\Entities\Group;

class GrantCheckLivewire extends Component
{
    public $grants = [];
    public Grant $grant;

    public $grantees = [];


    public $cooperativeTypes = [];

    public $enterpriseTypes = [];

    public string $citizenship_no;


    public array $form = [
        'grant_id' => null,
        'grant_for' => null,
        'model_type' => null,
        'model_id' => null,
    ];

    protected $listeners = ['fetchGranteesData'];
    public $families = [];

    public function mount(): void
    {
    }

    protected array $rules = [
        'citizenship_no' => ['required'],
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }


    public function submitFormData()
    {
        $this->validate();

        $this->getGrantData();
    }



    public function fetchGranteesData(): void
    {
        if (!empty($this->form['grant_for'])) {
            switch ($this->form['grant_for']) {
                case 'cooperative':
                    $this->grantees = Cooperative::all();
                    $this->form['model_type'] = Cooperative::class;
                    break;
                case 'group':
                    $this->grantees = Group::all();
                    $this->form['model_type'] = Group::class;
                    break;
                case 'enterprise':
                    $this->grantees = Enterprise::all();
                    $this->form['model_type'] = Enterprise::class;
                    break;
                default:
                    $this->grantees = Farmer::all();
                    $this->form['model_type'] = Farmer::class;
            }
        }
    }

    public function render()
    {
        if (!empty($this->form['grant_id'])) {
            $this->grant = Grant::find($this->form['grant_id']);
        }

        $this->fetchGranteesData();

        return view('grant::livewire.grant-check-livewire');
    }

}
