<form wire:submit.prevent="save">
    <div class="row">
        <div class="col-md-3 mb-2">
            <label for="title" class="form-label">शीर्षक</label>
            <div class="d-flex justify-content-between gap-1">
                <input type="text" id="title" class="form-control" value="{{old('title')}}" wire:model="form.title" name="title" />
            </div>
            @error('form.title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3 mb-2">
            <label for="order" class="form-label">क्रम स्थान </label>
            <div class="d-flex justify-content-between gap-1">
                <input type="number" id="order" class="form-control" value="{{old('order')}}" wire:model="form.order" name="order" />
            </div>
            @error('form.order')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3 mb-2">
            <label for="map_pass_group_id" class="form-label">स्वीकृति दिने समूह</label>
            <select id="map_pass_group_id" name="map_pass_group_id" wire:model="form.map_pass_group_id" class="form-select" required>
                <option value="">-- छान्नुहोस् --</option>
                @foreach($mapPassGroups as $mapPassGroup)
                <option value="{{$mapPassGroup->id}}" {{old('map_pass_group_id') == $mapPassGroup->id ? 'selected' : ''}}>{{$mapPassGroup->title}}</option>
                @endforeach
            </select>
            @error('form.map_pass_group_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-3 mb-2">
            <label for="map_group_id" class="form-label">फारम स्वीकृति दिने समूह</label>
            <select id="map_group_id" name="map_group_id" wire:model="form.map_group_id" class="form-select" required>
                <option value="">-- छान्नुहोस् --</option>
                @foreach($mapPassGroups as $mapPassGroup)
                    <option value="{{$mapPassGroup->id}}" {{old('map_pass_group_id') == $mapPassGroup->id ? 'selected' : ''}}>{{$mapPassGroup->title}}</option>
                @endforeach
            </select>
            @error('form.map_group_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-3 mb-2">
            <label for="need_from" class="form-label">फारम भर्ने</label>
            <select id="need_from" name="need_from" wire:model="form.need_from" class="form-select" required>
                <option value="">-- छान्नुहोस् --</option>
                @foreach(\Modules\EMap\Enums\EMapFormFillerTypeEnum::cases() as $needFrom)
                <option value="{{$needFrom->value}}" {{old('need_from') == $needFrom->value ? 'selected' : ''}}>{{$needFrom->label()}}</option>
                @endforeach

            </select>
            @error('form.need_from')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @if($form['need_from'] == \Modules\EMap\Enums\EMapFormFillerTypeEnum::OFFICE->value)
        <div class="col-md-3 mb-2">
            <label for="show_to_consultancy" class="form-label">Show Consultancy</label>
            <select id="show_to_consultancy" name="show_to_consultancy" wire:model="form.show_to_consultancy" class="form-select" >
                <option value="">-- छान्नुहोस् --</option>
                    <option value="1">Yes</option>
                <option value="0">No</option>

            </select>
            @error('form.show_to_consultancy')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @endif
    </div>
    <div class="row">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>नक्शा पास फारम को किसिम</th>
                    <th>फारम/फाइल</th>
                    <th>
                        <button class="btn btn-sm btn-primary" wire:click.prevent="addData">
                            <i class="fa fa-plus"></i>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($form['formDataType'] ?? [] as $index=>$formDataType)
                <tr>
                    <td>
                        <select id="type" name="type" wire:model="form.formDataType.{{$index}}.type" wire:key="form.formDataType.{{$index}}.type" wire:change="changeData({{$index}})" class="form-select" required>
                            <option value="">-- छान्नुहोस् --</option>
                            @foreach(\Modules\EMap\Enums\FormTypeEnum::cases() as $formType)
                            <option value="{{$formType->value}}">{{$formType->label()}}</option>
                            @endforeach
                        </select>
                        @error('form.formDataType.'.$index.'.type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <select id="type" name="type" wire:model="form.formDataType.{{$index}}.model_id" class="form-select">
                            <option value="">-- छान्नुहोस् --</option>
                            @foreach($form['formDataType'][$index]['data'] ?? [] as $key=>$data)
                            <option value="{{$key ?? ''}}" {{old('type') == $key ?? '' ? 'selected' : ''}}>{{$data ?? ''}}</option>
                            @endforeach
                        </select>
                        @error('form.formDataType.'.$index.'.model_id')
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
        @error('form.formDataType')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
