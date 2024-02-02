<div>
    <form wire:submit.prevent="save">
        <fieldset class="mb-2">
            <legend> विवरण</legend>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label for="fiscal_year_id" class="form-label">आर्थिक वर्ष </label>
                    <select
                        name="fiscal_year_id"
                        wire:model="form.fiscal_year_id"
                        class="form-control @error('fiscal_year_id') is-invalid @enderror"
                        id="fiscal_year_id"  data-width="100%" required>
                        <option value="">--- छान्नुहोस् ---</option>
                        @foreach($fiscalYears as $fiscalYear)
                            <option
                                {{old('fiscal_year_id')==$fiscalYear->id? 'selected' : ''}}
                                value="{{$fiscalYear->id}}">
                                {{$fiscalYear->title}}
                            </option>
                        @endforeach
                    </select>
                    @error('form.fiscal_year_id')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="material_rate_id" class="form-label">सामग्री दर </label>
                    <select
                        name="material_rate_id"
                        wire:model="form.material_rate_id"
                        class="form-control @error('material_rate_id') is-invalid @enderror"
                        id="material_rate_id"  data-width="100%" required>
                        <option value="">--- छान्नुहोस् ---</option>
                        @foreach($materialRates as $materialRate)
                            <option
                                {{old('material_rate_id')==$materialRate->id? 'selected' : ''}}
                                value="{{$materialRate->id}}">
                                {{$materialRate->referance_no}}
                            </option>
                        @endforeach
                    </select>
                    @error('form.material_rate_id')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <label for="unit_id" class="form-label">एकाई </label>
                    <select
                        name="unit_id"
                        wire:model="form.unit_id"
                        class="form-control @error('unit_id') is-invalid @enderror"
                        id="unit_id"  data-width="100%" required>
                        <option value="">--- छान्नुहोस् ---</option>
                        @foreach($units as $unit)
                            <option
                                {{old('unit_id')==$unit->id? 'selected' : ''}}
                                value="{{$unit->id}}">
                                {{$unit->title}}
                            </option>
                        @endforeach
                    </select>
                    @error('form.unit_id')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="activity_no" class="form-label">गतिविधि नं</label>
                    <input
                        type="text"
                        name="activity_no"
                        wire:model="form.activity_no"
                        value="{{old('activity_no')}}"
                        class="form-control @error('activity_no') is-invalid @enderror"
                        id="activity_no"
                        placeholder="गतिविधि नं"
                    />
                    @error('form.activity_no')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="col-md-12 mb-2">
                    <label for="remarks" class="form-label">टिप्पणी</label>
                    <textarea
                        type="text"
                        name="remarks"
                        wire:model="form.remarks"
                        class="form-control @error('remarks') is-invalid @enderror"
                        id="remarks"
                        placeholder="टिप्पणी"
                    >{{old('remarks')}}</textarea>
                    @error('form.remarks')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div>
        </fieldset>
        <fieldset class="mb-2">
            <legend> विवरण</legend>
        <div class="row">
            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>Collectable</th>
                        <th>Type </th>
                        <th>Quantity</th>
                        <th>Rate Type  </th>
                        <th>Rate </th>
                        <th>
                            <button class="btn btn-sm btn-primary" wire:click.prevent="addData">
                                <i class="fa fa-plus"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($form['collectionResources'] ?? [] as $index=>$collectionResource)
                    <tr>
                        <td>

                            <input
                            type="text"
                            wire:model="form.collectionResources.{{$index}}.collectable"
                            class="form-control"
                            placeholder="Collectable"
                        />
                            @error('form.collectionResources.'.$index.'.collectable')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </td>
                        <td>
                            <select id="type" name="type" wire:model="form.collectionResources.{{$index}}.type" class="form-select" required>
                                <option value="">-- छान्नुहोस् --</option>
                                <option value="equipment">Equipment</option>
                                <option value="labour">Labour</option>
                            </select>
                            @error('form.collectionResources.'.$index.'.type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <input
                            type="number"
                            wire:model="form.collectionResources.{{$index}}.quantity"
                            class="form-control"
                            placeholder="Quantity"
                        />
                            @error('form.collectionResources.'.$index.'.quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <select id="type" name="type" wire:model="form.collectionResources.{{$index}}.rate_type" class="form-select" required>
                                <option value="">-- छान्नुहोस् --</option>
                                @foreach(\Modules\Plan\Enums\RateTypeEnum::cases() as $formType)
                                <option value="{{$formType->value}}">{{$formType->label()}}</option>
                                @endforeach
                            </select>
                            @error('form.collectionResources.'.$index.'.rate_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>

                        <td>
                            <input
                            type="number"
                            wire:model="form.collectionResources.{{$index}}.rate"
                            class="form-control"
                            placeholder="rate"
                        />
                            @error('form.collectionResources.'.$index.'.rate')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger" wire:click.prevent="removeData({{$index}})">
                                <i class="fa fa-minus"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @error('form.collectionResources')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </fieldset>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
</div>
