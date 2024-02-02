<?php

namespace App\Http\Livewire;

use App\Models\Settings\Units\MeasurementUnit;
use App\Models\Settings\Units\Unit;
use App\Models\Settings\Units\UnitConversion;
use Livewire\Component;
use Modules\EMap\Entities\MapSetting;

class Converter extends Component
{
    public $conversion_units = [];

    public $conversion = [];

    public MapSetting $setting;

    public $conversion_id;

    public $units = [];

    public $si_unit_value = 0;

    public $convertedData = 0;

    public function mount()
    {
        $this->setting = MapSetting::with('landMeasurement')->first();

        if (empty($this->setting->land_measurement_id)) {
            $this->redirect(route('emap.admin.setting.index'));
        }

        $this->conversion_units = MeasurementUnit::where('type_id', $this->setting->land_measurement_id)->get();
    }

    public function convert()
    {
        if ($this->si_unit_value > 0 && !empty($this->conversion_id)) {
            $rate = $this->conversionToSmallest();

            $this->convertedData = $rate * $this->si_unit_value;
            $data = [];
            foreach ($this->units as $index => $unit) {
                $data['data'.$index] = $this->conversionLogic($unit);
            }
            $this->conversion = $data;
        }
    }

    public function conversionToSmallest(): float|int
    {
        $rate = 1;

        if ($this->setting->standardLandMeasurement->is_smallest != 1) {
            $getSmallerUnits = Unit::where('measurement_unit_id', $this->setting->standardLandMeasurement->measurement_unit_id)
                ->where('position', '>=', $this->setting->standardLandMeasurement->position)
                ->orderBy('position')
                ->get();

            foreach ($getSmallerUnits as $smallerUnit) {
                $rate = $rate * $this->getRate($smallerUnit);
            }
            $id = $getSmallerUnits->last()->id;
        } else {
            $id = $this->setting->land_measurement_standard_id;
        }
        $minUnit = $this->units->where('is_smallest', 1)->first();

        $conversionData = UnitConversion::where('conversion_to', $minUnit->id)
            ->where('conversion_from', $id)
            ->first();

        return  $rate / $conversionData->rate;
    }

    public function getRate(Unit $biggerUnit): float|int
    {
        $smallerUnit = Unit::where('position', $biggerUnit->position + 1)
            ->whereMeasurementUnitId($biggerUnit->measurement_unit_id)
            ->first();

        if (!empty($smallerUnit)) {
            $conversionRate = UnitConversion::where('conversion_to', $smallerUnit->id)
                ->where('conversion_from', $biggerUnit->id)
                ->first();

            return $conversionRate->rate ?? 1;
        } else {
            return 1;
        }
    }

    public function conversionLogic(Unit $unit): float|int
    {
        if ($unit->position - 1 > 0) {
            $biggerUnit = Unit::where('position', $unit->position - 1)->first();
            if (!empty($biggerUnit)) {
                $conversionRate = UnitConversion::where('conversion_to', $biggerUnit->id)
                    ->where('conversion_from', $unit->id)
                    ->first();
                if (!empty($conversionRate->rate)) {
                    $totalData = $this->convertedData * $conversionRate->rate;
                    $wholePart = floor($totalData);
                    $fraction = $totalData - $wholePart;
                    $this->convertedData = $wholePart;

                    return $fraction / $conversionRate->rate;
                }

                return 0;
            }

            return $this->convertedData;
        }

        return $this->convertedData;
    }

    public function render()
    {
        $this->convert();
        if (!empty($this->conversion_id)) {
            $this->units = Unit::where('measurement_unit_id', $this->conversion_id)->orderByDesc('position')->get();
        }

        return view('livewire.converter');
    }
}
