<form wire:submit.prevent="save">
    <fieldset class="mb-2">
        <legend> उपकरण </legend>
        <div class="row">
            <div class="col-md-3 mb-2">
                <label for="equipment_id" class="form-label">उपकरण  *</label>
                <select
                    name="equipment_id"
                    wire:model="form.equipment_id"
                    class="form-control @error('equipment_id') is-invalid @enderror"
                    id="equipment_id" disabled data-width="100%" required>
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach($equipments as $equipment)
                        <option
                            {{old('equipment_id')==$equipment->id ? 'selected' : ''}}
                            value="{{$equipment->id}}">
                            {{$equipment->title}}
                        </option>
                    @endforeach
                </select>
                @error('form.equipment_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>


        </div>
    </fieldset>
    <fieldset class="mb-2">
        <legend> उपकरण अतिरिक्त लागत </legend>
        <div class="row">
            @foreach($form['equipmentAdditionalCost'] ?? [] as $index=>$equipmentAdditionalCost)
            <div class="col-md-4 mb-2">
                <label for="rate" class="form-label">दर</label>
                <input
                wire:model="form.equipmentAdditionalCost.{{$index}}.rate"
                    type="number"
                    name="rate"
                    value="{{old('rate')}}"
                    class="form-control @error('rate') is-invalid @enderror"
                    id="rate"
                    placeholder="दर"
                />
                @error('form.equipmentAdditionalCost.'.$index.'.rate')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="unit_id" class="form-label">एकाई *</label>
                <select
                wire:model="form.equipmentAdditionalCost.{{$index}}.unit_id"
                    name="unit_id"
                    class="form-control @error('unit_id') is-invalid @enderror"
                    id="unit_id" data-width="100%" required>
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach($units as $unit)
                        <option
                            {{old('unit_id')==$unit->id ? 'selected' : ''}}
                            value="{{$unit->id}}">
                            {{$unit->title}}
                        </option>
                    @endforeach
                </select>
                @error('form.equipmentAdditionalCost.'.$index.'.unit_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="fiscal_year_id" class="form-label">आर्थिक वर्ष *</label>
                <select
                    name="fiscal_year_id"
                    wire:model="form.equipmentAdditionalCost.{{$index}}.fiscal_year_id"
                    class="form-control @error('fiscal_year_id') is-invalid @enderror"
                    id="fiscal_year_id" data-width="100%" required>
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach($fiscalYears as $fiscalYear)
                        <option
                            {{old('fiscal_year_id')==$fiscalYear->id ? 'selected' : ''}}
                            value="{{$fiscalYear->id}}">
                            {{$fiscalYear->title}}
                        </option>
                    @endforeach
                </select>
                @error('form.equipmentAdditionalCost.'.$index.'.fiscal_year_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-sm btn-danger" wire:click.prevent="removeEquipmentAdditionalCost({{$index}})">
                <i class="fa fa-minus"></i>
            </button>
            @endforeach
            @error('form.equipmentAdditionalCost')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="col-md-2 mb-2">
                <button class="btn btn-sm btn-primary" wire:click.prevent="addEquipmentAdditionalCost">
                    <i class="fa fa-plus"></i>
                </button>

            </div>



        </div>
    </fieldset>
    <fieldset class="mb-2">
        <legend> इन्धनको माग </legend>
        <div class="row">
            @foreach($form['fuelDemand'] ?? [] as $index=>$fuelDemand)
            <div class="col-md-5 mb-2">
                <label for="quantity" class="form-label">मात्रा</label>
                <input
                wire:model="form.fuelDemand.{{$index}}.quantity"
                    type="text"
                    name="quantity"
                    value="{{old('quantity')}}"
                    class="form-control @error('quantity') is-invalid @enderror"
                    id="quantity"
                    placeholder="मात्रा"
                />
                @error('form.equipmentAdditionalCost.'.$index.'.quantity')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-5 mb-2">
                <label for="fuel_id" class="form-label">इन्धन  *</label>
                <select
                    name="fuel_id"
                    wire:model="form.fuelDemand.{{$index}}.fuel_id"
                    class="form-control @error('fuel_id') is-invalid @enderror"
                    id="fuel_id"  data-width="100%" required>
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach($fuels as $fuel)
                        <option
                            {{old('fuel_id')==$fuel->id ? 'selected' : ''}}
                            value="{{$fuel->id}}">
                            {{$fuel->title}}
                        </option>
                    @endforeach
                </select>
                @error('form.equipmentAdditionalCost.'.$index.'.fuel_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-sm btn-danger" wire:click.prevent="removeFuelDemand({{$index}})">
                <i class="fa fa-minus"></i>
            </button>
            @endforeach
            @error('form.fuelDemand')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="col-md-2 mb-2">
                <button class="btn btn-sm btn-primary" wire:click.prevent="addFuelDemand">
                    <i class="fa fa-plus"></i>
                </button>

            </div>

        </div>
    </fieldset>
    <fieldset class="mb-2">
        <legend> चालक दलको दर </legend>
        <div class="row">
            @foreach($form['crewCreate'] ?? [] as $index=>$crewCreate)
            <div class="col-md-5 mb-2">
                <label for="quantity" class="form-label">मात्रा</label>
                <input
                    type="text"
                    wire:model="form.crewCreate.{{$index}}.quantity"
                    name="quantity"
                    value="{{old('quantity')}}"
                    class="form-control @error('quantity') is-invalid @enderror"
                    id="quantity"
                    placeholder="मात्रा"
                />
                @error('form.equipmentAdditionalCost.'.$index.'.quantity')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-5 mb-2">
                <label for="labour_id" class="form-label">श्रम  *</label>
                <select
                    name="labour_id"
                    wire:model="form.crewCreate.{{$index}}.labour_id"
                    class="form-control @error('labour_id') is-invalid @enderror"
                    id="labour_id"  data-width="100%" required>
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach($labours as $labour)
                        <option
                            {{old('labour_id')==$labour->id ? 'selected' : ''}}
                            value="{{$labour->id}}">
                            {{$labour->title}}
                        </option>
                    @endforeach
                </select>
                @error('form.equipmentAdditionalCost.'.$index.'.labour_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button class="btn btn-sm btn-danger" wire:click.prevent="removeCrewCreate({{$index}})">
                <i class="fa fa-minus"></i>
            </button>
            @endforeach
            @error('form.crewCreate')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="col-md-2 mb-2">
                <button class="btn btn-sm btn-primary" wire:click.prevent="addCrewCreate">
                    <i class="fa fa-plus"></i>
                </button>

            </div>

        </div>
    </fieldset>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
