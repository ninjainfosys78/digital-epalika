<div>
    <fieldset>
        <legend>
            <h4 class="text-info">सिफारिस फाराम</h4>
        </legend>
        <div class="row">
            <div class="col-md-4 mb-2">
                <label for="personal_detail_id" class="form-label">व्यक्तिगत विवरण</label>
                <div class="d-flex justify-content-between gap-1">
                    <select id="personal_detail_id" name="personal_detail_id" class="form-select personalDetail"
                            wire:model="personal_detail_id">
                        <option value="">-- छान्नुहोस् --</option>
                        @foreach ($personalDetails as $personalDetail)
                            <option value="{{ $personalDetail->id }}">{{ $personalDetail->name }}
                                ({{ $personalDetail->reg_no }})
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-outline-primary" type="button" id="button-personalDetail"
                            title="व्यक्तिगत विवरण थप" data-bs-toggle="modal" data-bs-target="#personalDetail-modal">
                        <i class="fa fa-plus"></i></button>
                </div>
                @error('personal_detail_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="sipharis_category_id" class="form-label">सिफारिस श्रेणी</label>
                <div class="d-flex justify-content-between gap-1">
                    <select id="sipharis_category_id" wire:model="sipharis_category_id" name="sipharis_category_id"
                            class="form-select personalDetail" required>
                        <option value="">-- छान्नुहोस् --</option>
                        @foreach ($sipharishCategories as $sipharishCategory)
                            <option
                                value="{{ $sipharishCategory->id }}" {{old('sipharis_category_id') == $sipharishCategory->id ? 'selected':'' }}>
                                {{ $sipharishCategory->title }}
                            </option>
                        @endforeach
                    </select>

                </div>
                @error('sipharis_category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="sipharis_sub_category_id" class="form-label">सिफारिस उप-श्रेणी <span
                        class="text-danger">*</span></label>
                <div class="d-flex justify-content-between gap-1">
                    <select id="sipharis_sub_category_id" wire:model="sipharis_sub_category_id"
                            name="sipharis_sub_category_id"
                            class="form-select @error('sipharis_sub_category_id') is-invalid @enderror personalDetail"
                            required>
                        <option value="">-- छान्नुहोस् --</option>
                        @foreach ($sipharishSubCategories as $sipharishSubCategory)
                            <option value="{{ $sipharishSubCategory->id }}">
                                {{ $sipharishSubCategory->title }}
                            </option>
                        @endforeach
                    </select>

                </div>
                @error('sipharis_sub_category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-2">
                <label for="sipharis_form_type_id" class="form-label">सिफारिस * <span
                        class="text-danger">*</span></label>
                <div class="d-flex justify-content-between gap-1">
                    <select id="sipharis_form_type_id" wire:model="sipharis_form_type_id"
                            name="sipharis_form_type_id"
                            class="form-select @error('sipharis_form_type_id') is-invalid @enderror personalDetail"
                            required>
                        <option value="">-- छान्नुहोस् --</option>
                        @foreach ($formTypes as $formType)
                            <option value="{{ $formType->id }}">
                                {{ $formType->title }}
                            </option>
                        @endforeach
                    </select>

                </div>
                @error('sipharis_form_type_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label for="personal_detail_id" class="form-label">स्थिति <span class="text-danger">*</span></label>
                <div class="d-flex justify-content-between gap-1">
                    <select id="personal_detail_id" name="status" class="form-select personalDetail"
                            wire:model="status" required>
                        <option value="">-- छान्नुहोस् --</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>

                </div>
                @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

        </div>
    </fieldset>

    <div class="row">
        <div class="col-md-12 mb-2">
            <fieldset class="bg-soft-secondary">
                <div id="files">
                    @foreach($fields ?? [] as $key=>$field)
                        <div class="main">

                            <div class="row border-bottom mb-2">
                                <input type="hidden" name="fields[{{$key}}][sipharish_form_field_id]"
                                       class="form-control" value="{{$field->id}}" id="sipharish_form_field_id"/>
                                <input type="hidden" name="fields[{{$key}}][type]"
                                       class="form-control" value="{{$field->type->value}}" id="type"/>

                                <div class="col-md-12 mb-2">
                                    <label for="title" class="form-label">{{$field->field_name}}</label>
                                    @if($field->type != \App\Enums\FormFieldEnum::TABLE)
                                        <input type="{{$field->type?->resolveType() ?? 'text'}}"
                                               name="fields[{{$key}}][value]" class="form-control"
                                               id="title"
                                               placeholder="शिर्षक" required/>
                                        <input type="hidden"
                                               name="fields[{{$key}}][type]" class="form-control"
                                               value="{{$field->type?->value}}"
                                               id="type"
                                               placeholder="शिर्षक" required/>
                                    @else
                                        <input type="hidden"
                                               name="fields[{{$key}}][value]" class="form-control"
                                               value="{{json_encode($data[$field->slug] ?? [])}}"
                                               id="title"
                                               placeholder="शिर्षक" required/>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                @foreach($field->SipharishFormFields as $sipharishFormField)
                                                    <th>{{$sipharishFormField->field_name}}</th>
                                                @endforeach
                                                <th>
                                                    <button type="button"
                                                            wire:click.prevent="addRowInTable('{{$field->slug}}')"
                                                            class="btn btn-sm btn-outline-primary">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data[$field->slug] ?? [] as $index=>$tableData)
                                                <tr>
                                                    @foreach($field->SipharishFormFields as $sipharishFormField)
                                                        <td>
                                                            <input
                                                                type="{{$sipharishFormField->type?->resolveType() ?? 'text'}}"
                                                                class="form-control"
                                                                wire:model="data.{{$field->slug}}.{{$index}}.{{$sipharishFormField->slug}}.data"
                                                                id="title"
                                                                placeholder="{{$sipharishFormField->field_name}}"
                                                                required
                                                                wire:change="setType('{{$field->slug}}',{{$index}},'{{$sipharishFormField->slug}}','{{$sipharishFormField->type?->value}}')"/>
                                                            @if(empty($data[$field->slug][$index][$sipharishFormField->slug]['value']))
                                                                <span class="text-danger">Data Not Stored</span>
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                    <th>
                                                        <button type="button"
                                                                wire:click.prevent="removeRowInTable('{{$field->slug}}',{{$index}})"
                                                                class="btn btn-sm btn-outline-danger">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                    </th>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </fieldset>
        </div>
    </div>
</div>
