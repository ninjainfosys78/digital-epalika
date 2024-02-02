<?php

namespace Modules\Revenue\Http\Livewire;

use App\Models\Settings\Units\Unit;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Revenue\Entities\Place;
use Modules\Revenue\Entities\Sector;
use Modules\Revenue\Entities\TaxPayer;

class TaxPayerLandLivewire extends Component
{
    public TaxPayer $taxPayer;
    public $wards;
    public $sectors = [];
    public $areaUnits = [];
    public $places = [];

    public $taxPayerLand = [
        'plot_no' => '',
        'former_ward' => '',
        'former_vdc' => '',
        'ward_no' => '',
        'area' => '',
        'sector_id' => '',
        'place_id' => '',
        'land_address' => '',
        'land_use' => '',
        'remarks' => '',
    ];

    protected $rules = [
        'taxPayerLand.plot_no' => ['required'],
        'taxPayerLand.former_ward' => ['nullable'],
        'taxPayerLand.former_vdc' => ['nullable'],
        'taxPayerLand.ward_no' => ['required', 'numeric'],
        'taxPayerLand.area' => ['required', 'numeric'],
        'taxPayerLand.sector_id' => ['required', 'numeric', 'exists:sectors,id,deleted_at,NULL'],
        'taxPayerLand.place_id' => ['required', 'numeric', 'exists:places,id,deleted_at,NULL'],
        'taxPayerLand.land_address' => ['required'],
        'taxPayerLand.land_use' => ['required'],
        'taxPayerLand.remarks' => ['nullable'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
        $this->taxPayer->taxPayerLands()->create(array_merge($this->taxPayerLand, ['user_id' => auth()->id()]));

        $this->reset('taxPayerLand');

        toast('Land details saved successfully', 'success');
        return redirect()->route('admin.revenue.taxPayer.taxPayerLand.index', $this->taxPayer->id);
    }

    public function mount(TaxPayer $taxPayer)
    {
        $this->taxPayer = $taxPayer;
        $this->sectors = Sector::latest()->get();
        $this->areaUnits = Unit::get();
        $this->wards = get_local_bodies(localBodyId: officeSetting()->local_body_id)->ward_no;
    }

    public function render(): Factory|View|Application
    {
        if (!empty($this->taxPayerLand['sector_id'])) {
            $this->places = Place::where('sector_id', $this->taxPayerLand['sector_id'])->get();
        }

        return view('revenue::livewire.tax-payer-land-livewire');
    }
}
