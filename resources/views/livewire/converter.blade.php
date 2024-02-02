<div>
    {{print_r($conversion)}}<br>

    <label for="{{$setting->land_measurement_standard_id ?? ''}}">{{$setting->standardLandMeasurement->title ?? ''}}</label>
    <input type="text" id="{{$setting->land_measurement_standard_id ?? ''}}" wire:model="si_unit_value">


    <label for="convert_to">Convert To</label>
    <select name="convert_to" id="convert_to" wire:model="conversion_id" wire:change="conversionLogic">
        <option value="">Select conversion Unit</option>
        @foreach($conversion_units as $conversion_unit)
            <option value="{{$conversion_unit->id}}">{{$conversion_unit->title}}</option>
        @endforeach
    </select>

    @foreach($units as $index=>$unit)
        <label for="{{$unit->id}}">{{$unit->title}}</label>
        <input type="text" id="{{$unit->id}}" wire:model="conversion.data{{$index}}" readonly>
    @endforeach

</div>
