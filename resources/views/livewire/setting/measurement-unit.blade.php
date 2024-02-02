<div class="row">
    <div class="col-md-6 mb-2">
        <label for="type_id" class="form-label">मापन एकाई प्रकार *</label>
        <select
            name="type_id"
            wire:model="type_id"
            class="form-select @error('type_id') is-invalid @enderror"
            id="type_id">
            <option value="">मापन एकाई प्रकार छान्नुहोस्</option>
            @foreach($types as $type)
                <option value="{{$type->id}}">
                    {{$type->title}}
                </option>
            @endforeach
        </select>
        @error('type_id')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-2">
        <label for="measurement_unit_id" class="form-label">मापन एकाई विविधता *</label>
        <select
            name="measurement_unit_id"
            wire:model="measurement_unit_id"
            class="form-select @error('measurement_unit_id') is-invalid @enderror"
            id="measurement_unit_id">
            <option value="">मापन एकाई विविधता छान्नुहोस्</option>
            @foreach($measurementUnits as $measurementUnit)
                <option value="{{$measurementUnit->id}}">
                    {{$measurementUnit->title}}
                </option>
            @endforeach
        </select>
        @error('measurement_unit_id')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>

</div>
