<?php

namespace Modules\Revenue\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Revenue\Entities\TaxPayer;
use Modules\Revenue\Entities\TaxPayerType;

class TaxPayerLivewire extends Component
{
    public $taxPayerTypes = [];

    public $openAddTypeForm = false;
    public $newTaxPayerType = [
        'title',
        'code'
    ];

    public TaxPayer $taxPayer;

    public $taxPayerDetail = [
        'tax_payer_type_id' => '',
        'name' => '',
        'name_en' => '',
        'phone' => '',
        'email' => '',
        'address' => '',
        'gender' => '',
        'father_name' => '',
        'grandfather_name' => '',
        'citizenship_no' => '',
        'issued_district' => '',
        'issued_date' => '',
        'ward' => '',
        'tole' => '',
        'remarks' => '',
        'occupation' => '',
        'province_id' => '',
        'district_id' => '',
        'local_body_id' => '',
        'village' => '',
        'house_no' => '',
    ];

    public $taxPayerFamilies = [];

    public $provinces = [];

    public $districts = [];

    public $localBodies = [];

    public $wards = [];

    public function mount($taxPayer = null)
    {
        $this->provinces = get_provinces();
        $this->taxPayerTypes = TaxPayerType::latest()->get();

        if ($taxPayer) {
            $this->taxPayer = $taxPayer;
            foreach ($taxPayer->taxPayerFamilies as $family) {
                $this->taxPayerFamilies[] = [
                    'name' => $family->name,
                    'relation' => $family->relation,
                ];
            }
            $this->taxPayerDetail = $taxPayer->toArray();
        } else {
            $this->taxPayerDetail['province_id'] = officeSetting()->province_id;
            $this->taxPayerDetail['district_id'] = officeSetting()->district_id;
            $this->taxPayerDetail['local_body_id'] = officeSetting()->local_body_id;
        }
    }

    public function openAddMoreTypeForm()
    {
        $this->openAddTypeForm = !$this->openAddTypeForm;
    }

    public function addFamily()
    {
        $this->taxPayerFamilies[] = [
            'name' => '',
            'relation' => '',
        ];
    }

    public function removeFamily($index)
    {
        unset($this->taxPayerFamilies[$index]);

        $this->taxPayerFamilies = array_values($this->taxPayerFamilies);
    }

    public function saveTaxPayerType()
    {
        $this->validate([
            'newTaxPayerType.title' => 'required|string',
            'newTaxPayerType.code' => 'required|string',
        ]);

        TaxPayerType::create($this->newTaxPayerType);

        $this->openAddTypeForm = false;
        $this->taxPayerTypes = TaxPayerType::latest()->get();
    }

    protected function getListeners(): array
    {
        return ['setTaxPayerIssuedDate'];
    }

    public function setTaxPayerIssuedDate($nepaliDate)
    {
        $this->taxPayerDetail['issued_date'] = $nepaliDate;
    }


    protected function rules()
    {
        $defaultRule = [
            'taxPayerDetail.tax_payer_type_id' => ['required', 'exists:tax_payer_types,id,deleted_at,NULL'],
            'taxPayerDetail.name' => ['required', 'string', 'max:255'],
            'taxPayerDetail.name_en' => ['required', 'string', 'max:255'],
            'taxPayerDetail.phone' => ['required', 'string', 'max:255'],
            'taxPayerDetail.address' => ['required', 'string', 'max:255'],
            'taxPayerDetail.email' => ['nullable', 'email'],
            'taxPayerDetail.gender' => ['nullable', 'string', 'max:255', 'in:male,female,other'],
            'taxPayerDetail.father_name' => ['nullable', 'string', 'max:255'],
            'taxPayerDetail.grandfather_name' => ['nullable', 'string', 'max:255'],
            'taxPayerDetail.issued_district' => ['nullable', 'string', 'max:255'],
            'taxPayerDetail.issued_date' => ['required'],
            'taxPayerDetail.ward' => ['required', 'string', 'max:255'],
            'taxPayerDetail.tole' => ['required', 'string', 'max:255'],
            'taxPayerDetail.remarks' => ['nullable', 'string'],
            'taxPayerDetail.occupation' => ['nullable', 'string'],
            'taxPayerDetail.province_id' => ['required', 'exists:provinces,id,deleted_at,NULL'],
            'taxPayerDetail.district_id' => ['required', 'exists:districts,id,deleted_at,NULL'],
            'taxPayerDetail.local_body_id' => ['required', 'exists:local_bodies,id,deleted_at,NULL'],
            'taxPayerDetail.village' => ['nullable', 'string', 'max:255'],
            'taxPayerDetail.house_no' => ['nullable', 'string', 'max:255'],
            'taxPayerFamilies' => ['nullable', 'array'],
            'taxPayerFamilies.*.name' => ['required', 'string', 'max:255'],
            'taxPayerFamilies.*.relation' => ['required', 'string', 'max:255'],
        ];

        if (isset($this->taxPayerDetail['id'])) {
            $defaultRule['taxPayerDetail.citizenship_no'] = ['required', 'string', 'max:255', 'unique:tax_payers,citizenship_no,' . $this->taxPayerDetail['id'] . ',id,deleted_at,NULL'];
        } else {
            $defaultRule['taxPayerDetail.citizenship_no'] = ['required', 'string', 'max:255', 'unique:tax_payers,citizenship_no,NULL,id,deleted_at,NULL'];
        }

        return $defaultRule;
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function saveData()
    {
        $this->validate();
        $message = DB::transaction(function () {
            if (!empty($this->taxPayer)) {
                $this->taxPayer->update($this->taxPayerDetail);
                $message = 'करदाता सफलतापूर्वक अपडेट भयो';
            } else {
                $this->taxPayer = TaxPayer::create($this->taxPayerDetail);
                $message = 'करदाता सफलतापूर्वक थपियो';
            }
            $ids = collect();

            foreach ($this->taxPayerFamilies as $family) {
                if (isset($family['id'])) {
                    $taxPayerFamily = $this->taxPayer->taxPayerFamilies()->find($family['id'])?->update($family);
                } else {
                    $taxPayerFamily = $this->taxPayer->taxPayerFamilies()->create($family);
                }
                $ids->push($taxPayerFamily->id);
            }

            $this->taxPayer->taxPayerFamilies()->whereNotIn('id', $ids)->delete();

            return $message;
        });


        toast($message, 'success');
        return redirect()->route('admin.revenue.taxPayer.index');
    }

    public function render()
    {
        if (!empty($this->taxPayerDetail['province_id'])) {
            $this->districts = get_districts($this->taxPayerDetail['province_id']);
        }
        if (!empty($this->taxPayerDetail['district_id'])) {
            $this->localBodies = get_local_bodies($this->taxPayerDetail['district_id']);
        }
        if (!empty($this->taxPayerDetail['local_body_id'])) {
            $this->wards = get_local_bodies(localBodyId: $this->taxPayerDetail['local_body_id'])->ward_no;
        }

        return view('revenue::livewire.tax-payer-livewire');
    }
}
