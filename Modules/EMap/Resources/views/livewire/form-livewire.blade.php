<div class="card-body">
    <form method="post"
          enctype="multipart/form-data">
        @csrf
        <fieldset>
            <legend>
                <h4 class="text-info">नक्शा पास  फाराम</h4>
            </legend>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label for="title" class="form-label">शीर्षक</label>
                    <div class="d-flex justify-content-between gap-1">
                        <input type="text" id="title" class="form-control personalDetail" wire:model="form.title" name="title"/>
                    </div>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-2">
                    <label for="order" class="form-label">क्रम शन्ख्य </label>
                    <div class="d-flex justify-content-between gap-1">
                        <input type="number" id="order" class="form-control personalDetail" wire:model="form.order" name="order"/>
                    </div>
                    @error('order')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-2">
                    <label for="form_type" class="form-label">नक्शा पास फारम को किसिम </label>
                    <select id="form_type" name="form_type" wire:model="form.form_type" class="form-select" required>
                        <option value="">-- छान्नुहोस् --</option>
                        @foreach(\Modules\EMap\Enums\FormTypeEnum::cases() as $formType)
                            <option value="{{$formType->value}}">{{$formType->label()}}</option>
                        @endforeach

                    </select>
                    @error('form_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-2">
                    <label for="map_pass_group_id" class="form-label">स्वीकृति दिने समूह</label>
                    <select id="map_pass_group_id" name="map_pass_group_id" wire:model="form.map_pass_group_id" class="form-select" required>
                        <option value="">-- छान्नुहोस् --</option>
                        @foreach($mapPassGroups as $mapPassGroup)
                            <option value="{{$mapPassGroup->id}}">{{$mapPassGroup->title}}</option>
                        @endforeach
                    </select>
                    @error('map_pass_group_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-2">
                    <label for="need_from" class="form-label">फारम भर्ने</label>
                    <select id="need_from" name="need_from" wire:model="form.need_from" class="form-select" required>
                        <option value="">-- छान्नुहोस् --</option>
                        @foreach(\Modules\EMap\Enums\EMapFormFillerTypeEnum::cases() as $formType)
                            <option value="{{$formType->value}}">{{$formType->label()}}</option>
                        @endforeach

                    </select>
                    @error('need_from')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @if($form_type == 'form')
                    <div class="col-md-4 mb-2">
                        <label for="route_name" class="form-label">Route name</label>
                        <div class="d-flex justify-content-between gap-1">
                            <input type="text" class="form-control personalDetail" wire:model="form.route_name" name="route_name"/>
                        </div>
                        @error('route_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                @if($form_type == 'file')
                    <div class="col-md-12 mb-2">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <label for="files" class="form-label fw-bold">आवश्यक कागजातहरु <span
                                    class="text-danger">*</span></label>
                            <button type="button" class="btn btn-xs btn-outline-info"
                                    data-target-element="files" data-toggle="add-more">
                                <i class="fas fa-plus-circle"></i> नयाँ थप्नुहोस्
                            </button>
                        </div>
                        <fieldset class="bg-soft-secondary">
                            <div id="files">
                                <div class="main">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-toggle="remove-parent" data-parent=".main"
                                                data-target-element="files">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </div>
                                    <div class="row border-bottom mb-2">
                                        <div class="col-md-6 mb-2">
                                            <label for="documents" class="form-label">डकुमेन्ट </label>
                                            <input type="file" name="fields[0][title]" class="form-control"
                                                   id="documents" multiple />
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="fields.status" class="form-label">डकुमेन्ट </label>
                                            <select id="fields.status" name="fields[0][status]"
                                                    class="form-select personalDetail">
                                                <option value="">-- छान्नुहोस् --</option>
                                                <option value="1" {{old('status') == 1 ?'selected':''}}>
                                                    Active
                                                </option>
                                                <option value="0" {{old('status') == 0 ?'selected':''}}>
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label for="fields.description" class="form-label">डाटा *</label>
                                            <textarea name="fields[0][description]" id="fields[0][description]" required cols="10" rows="1"
                                                      class="form-control ckEditor @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                @endif
            </div>
        </fieldset>
        <button type="submit" class="btn btn-primary mt-2">
            पेश गर्नुहोस्
        </button>
    </form>
</div>
