<?php

namespace Modules\Grant\Http\Livewire;

use App\Models\Settings\FiscalYear;
use App\Models\Settings\OfficeSetting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Livewire\Component;
use Modules\Grant\Entities\Cooperative;
use Modules\Grant\Entities\CooperativeType;
use Modules\Grant\Entities\Enterprise;
use Modules\Grant\Entities\EnterpriseType;
use Modules\Grant\Entities\Farmer;
use Modules\Grant\Entities\Grant;
use Modules\Grant\Entities\GrantDetail;
use Modules\Grant\Entities\Group;

class GrantDetailLivewire extends Component
{
    public $grants = [];
    public Grant $grant;

    public $grantees = [];

    public $fiscalYears = [];

    public $cooperativeTypes = [];

    public $enterpriseTypes = [];

    public bool $forceStore = true;

    public GrantDetail $grantDetail;

    public array $form = [
        'grant_id' => null,
        'grant_for' => null,
        'model_type' => null,
        'model_id' => null,
        'personal_investment' => null,
        'grant_amount' => 0,
        'is_old' => 0,
        'prev_fiscal_year_id' => null,
        'investment_amount' => 0,
        'remarks' => null,
        'ward_no' => null,
        'village' => null,
        'tole' => null,
        'plot_no' => null,
        'contact_person' => null,
        'contact' => null,
    ];

    protected $listeners = ['fetchGranteesData', "storeData" => 'storeAndUpdateData'];
    private array $families = [];

    public function mount($grantDetail = null): void
    {
        $this->grants = Grant::with('fiscalYear')->latest()->get();
        $this->fiscalYears = FiscalYear::all();
        $this->cooperativeTypes = CooperativeType::all();
        $this->enterpriseTypes = EnterpriseType::all();

        if (!empty($grantDetail)) {
            $this->grantDetail = $grantDetail;
            foreach (Arr::except($this->form, ['grant_for', 'model_type']) as $key => $data) {
                $this->form[$key] = $grantDetail[$key];
            }
            $this->form['grant_for'] = $grantDetail->grant_for->value;
        }
    }

    public function getGrantData()
    {
        if ($this->form['grant_for'] == 'farmer' && !is_null($this->form['model_id'])) {
            $farmer = Farmer::with(
                'farmers',
                'farmer'
            )
                ->find($this->form['model_id']);
            $familyId = [];
            $familyId[] = $farmer->id;

            if ($farmer->farmer) {
                $familyId[] = $farmer->farmer->id;
            }

            if ($farmer->farmers) {
                foreach ($farmer->farmers as $farmersData) {
                    $familyId[] = $farmersData->id;
                }
            }

            return GrantDetail::where('model_type', Farmer::class)
                ->whereIn('model_id', $familyId)
                ->with('model', 'grant.fiscalYear')
                ->latest()
                ->get();
        }
    }

    protected array $rules = [
        'form.grant_id' => ['required', 'exists:grants,id'],
        'form.grant_for' => ['required', 'in:farmer,cooperative,group,enterprise'],
        'form.model_id' => ['required'],
        'form.personal_investment' => ['required', 'numeric'],
        'form.is_old' => ['nullable', 'boolean'],
        'form.prev_fiscal_year_id' => ['required_if:form.is_old,1'],
        'form.investment_amount' => ['required_if:form.is_old,1', 'numeric'],
        'form.remarks' => ['nullable'],
        'form.ward_no' => ['required', 'integer'],
        'form.village' => ['nullable'],
        'form.tole' => ['nullable'],
        'form.plot_no' => ['nullable'],
        'form.contact_person' => ['nullable'],
        'form.contact' => ['nullable'],
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function submitFormData(): void
    {
        $this->validate();
        if (!$this->forceStore) {
            $grants = $this->getGrantData();

            if (!empty($grants)) {
                $grantView = (string)View::make('grant::admin.inc.grantDetails', compact('grants'));
                $this->dispatchBrowserEvent('grantDetail', [
                    'grants' => $grantView,
                ]);
                return;
            }
        }
        $this->storeAndUpdateData();
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
            $this->form['grant_amount'] = $this->grant->grant_amount;
        }

        $this->fetchGranteesData();

        if ($this->form['grant_for'] == 'farmer') {
            $this->forceStore = false;
        }

        if ($this->form['is_old'] == 0) {
            $this->form['prev_fiscal_year_id'] = null;
            $this->form['investment_amount'] = 0;
        }

        return view('grant::livewire.grant-detail-livewire');
    }

    public function messages(): array
    {
        return [
            'form.grant_id.required' => 'अनुदान कार्यक्रम/क्रियाकलाप आवश्यक छ ।',
            'form.grant_for.required' => 'अनुदानग्राहीको प्रकार आवश्यक छ।',
            'form.model_id.required' => 'अनुदानग्राही नाम आवश्यक छ।',
            'form.personal_investment.required' => 'अनुदानग्राहीको लगानी आवश्यक छ।',
            'form.personal_investment.numeric' => 'अनुदानग्राहीको लगानी नम्बरमा हुनुपर्छ ।',
            'form.prev_fiscal_year_id.required' => 'आर्थिक बर्ष आवश्यक छ।',
            'form.investment_amount.required' => 'लगानी आवश्यक छ।',
            'form.investment_amount.numeric' => 'लगानी नम्बरमा हुनुपर्छ ।',
            'form.ward_no.required' => 'वडा नं. आवश्यक छ।',
        ];
    }

    public function storeAndUpdateData(): void
    {
        if (!empty($this->grantDetail)) {
            $this->grantDetail->update($this->form);

            $this->dispatchBrowserEvent('toast_message', [
                'type' => 'success',
                'title' => 'अनुदान सफलतापूर्वक सम्पादन गरियो'
            ]);

            redirect(route('admin.grant.grantDetail.index'));
        } else {
            GrantDetail::create($this->form + [
                    'local_body_id' => OfficeSetting::first()->local_body_id
                ]);

            $this->reset('form');

            $this->dispatchBrowserEvent('toast_message', [
                'type' => 'success',
                'title' => 'अनुदान सफलतापूर्वक थपियो'
            ]);
        }
    }
}
