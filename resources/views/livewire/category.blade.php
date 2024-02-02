<div class="row">
    <div class="col-md-6 mb-2">
        <label for="sipharis_category_id" class="form-label">सिफारिस श्रेणी</label>
        <div class="d-flex justify-content-between gap-1">
            <select id="sipharis_category_id" wire:model="sipharis_category_id" name="sipharis_category_id"
                    class="form-select personalDetail">
                <option value="">-- छान्नुहोस् --</option>
                @foreach ($sipharishCategories as $sipharishCategory)
                    <option value="{{ $sipharishCategory->id }}">{{ $sipharishCategory->title }}
                    </option>
                @endforeach
            </select>

        </div>
        @error('sipharis_category_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-2">
        <label for="personal_detail_id" class="form-label">सिफारिस उप-श्रेणी <span class="text-danger">*</span></label>
        <div class="d-flex justify-content-between gap-1">
            <select id="sipharis_sub_category_id" wire:model="sipharis_sub_category_id" name="sipharis_sub_category_id"
                    class="form-select @error('sipharis_sub_category_id') is-invalid @enderror">
                <option value="">-- छान्नुहोस् --</option>
                @foreach ($sipharishSubCategories as $sipharishSubCategory)
                    <option value="{{ $sipharishSubCategory->id }}">{{ $sipharishSubCategory->title }}
                    </option>
                @endforeach
            </select>

        </div>
        @error('sipharis_sub_category_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
