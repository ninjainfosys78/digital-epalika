<form wire:submit.prevent="save" method="post">

    <fieldset>
        <legend>
            <h4 class="text-info">सिफारिस फाराम</h4>
        </legend>
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label for="sipharis_category_id" class="form-label">सिफारिस श्रेणी</label>
                        <div class="d-flex justify-content-between gap-1">
                            <select id="sipharis_category_id" wire:model="form.sipharis_category_id"
                                    name="sipharis_category_id"
                                    class="form-select personalDetail">
                                <option value="">-- छान्नुहोस् --</option>
                                @foreach ($sipharishCategories as $sipharishCategory)
                                    <option value="{{ $sipharishCategory->id }}">{{ $sipharishCategory->title }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        @error('form.sipharis_category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="personal_detail_id" class="form-label">सिफारिस उप-श्रेणी <span
                                    class="text-danger">*</span></label>
                        <div class="d-flex justify-content-between gap-1">
                            <select id="sipharis_sub_category_id" wire:model="form.sipharis_sub_category_id"
                                    name="sipharis_sub_category_id"
                                    class="form-select @error('sipharis_sub_category_id') is-invalid @enderror">
                                <option value="">-- छान्नुहोस् --</option>
                                @foreach ($sipharishSubCategories as $sipharishSubCategory)
                                    <option value="{{ $sipharishSubCategory->id }}">{{ $sipharishSubCategory->title }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        @error('form.sipharis_sub_category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <label for="title" class="form-label">शिर्षक <span
                            class="text-danger">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="form-control @error('title') is-invalid @enderror" wire:model="form.title" id="title"
                       placeholder="शिर्षक"/>
                @error('form.title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <div class="row">
            <div class="col-md-4 mb-2">
                <label for="status1" class="form-label">स्थिति <span class="text-danger">*</span></label>
                <div class="d-flex justify-content-between gap-1">
                    <select id="status1" name="status"
                            class="form-select" wire:model="form.status">
                        <option value="">-- छान्नुहोस् --</option>
                        <option value="1" {{old('status') == 1?'selected':''}}>Active</option>
                        <option value="0" {{old('status') == 0?'selected':''}}>Inactive</option>
                    </select>

                </div>
                @error('form.status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-2">
                <label for="need_approval" class="form-label">सुइकृती चहिन्छ <span
                            class="text-danger">*</span></label>
                <div class="d-flex justify-content-between gap-1">
                    <select id="need_approval" name="need_approval"
                            class="form-select" wire:model="form.need_approval">
                        <option value="">-- छान्नुहोस् --</option>
                        <option value="1" {{old('need_approval') == 1?'selected':''}}>Yes</option>
                        <option value="0" {{old('need_approval') == 0?'selected':''}}>No</option>
                    </select>

                </div>
                @error('form.need_approval')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
    </fieldset>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                    <th>शिर्षक</th>
                    <th>Slug</th>
                    <th>प्रकार</th>
                    <th>
                        <button type="button" wire:click.prevent="addRow" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plus"></i>
                        </button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($form['formDataType'] ?? [] as $index=>$formType)
                    <tr>
                        <td>
                            <input type="text" wire:model="form.formDataType.{{$index}}.field_name" class="form-control"
                                   placeholder="शिर्षक">
                            @error('form.formDataType.'.$index.'.field_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" wire:model="form.formDataType.{{$index}}.slug" class="form-control"
                                   placeholder="Slug">
                            @error('form.formDataType.'.$index.'.slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <select wire:model="form.formDataType.{{$index}}.type" class="form-control">
                                <option value="">-- छान्नुहोस् --</option>
                                @foreach(\App\Enums\FormFieldEnum::cases() as $formField)
                                    <option value="{{$formField->value}}">{{$formField->label()}}</option>
                                @endforeach
                            </select>
                            @error('form.formDataType.'.$index.'.type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <button type="button" wire:click.prevent="removeRow({{$index}})"
                                    class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-minus"></i>
                            </button>

                    </tr>
                    @if(!empty($form['formDataType'][$index]['type']) && $form['formDataType'][$index]['type'] == 'table')
                        <tr>
                            <td colspan="4">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th>शिर्षक</th>
                                        <th>Slug</th>
                                        <th>प्रकार</th>
                                        <th>
                                            <button type="button" wire:click.prevent="addRowInTable({{$index}})"
                                                    class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($form['formDataType'][$index]['table'] ?? [] as $childIndex=>$formDataTypeTable)
                                        <tr>
                                            <td>
                                                <input type="text"
                                                       wire:model="form.formDataType.{{$index}}.table.{{$childIndex}}.field_name"
                                                       class="form-control"
                                                       placeholder="शिर्षक">
                                                @error('form.formDataType.'.$index.'.table.'.$childIndex.'.field_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text"
                                                       wire:model="form.formDataType.{{$index}}.table.{{$childIndex}}.slug"
                                                       class="form-control"
                                                       placeholder="Slug">
                                                @error('form.formDataType.'.$index.'.table.'.$childIndex.'.slug')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <select
                                                        wire:model="form.formDataType.{{$index}}.table.{{$childIndex}}.type"
                                                        class="form-control">
                                                    <option value="">-- छान्नुहोस् --</option>
                                                    @foreach(collect(\App\Enums\FormFieldEnum::cases())->filter(fn($enum)=>$enum->value != 'table') as $formField)
                                                        <option
                                                                value="{{$formField->value}}">{{$formField->label()}}</option>
                                                    @endforeach
                                                </select>
                                                @error('form.formDataType.'.$index.'.table.'.$childIndex.'.type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <button type="button"
                                                        wire:click.prevent="removeRowInTable({{$index}},{{$childIndex}})"
                                                        class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
            @error('form.formDataType')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-2">
            पेश गर्नुहोस्
        </button>
</form>
