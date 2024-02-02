<div class="row">
    <div class="col-md-6 mb-2">
        <label for="temporary_province_id" class="form-label">प्रदेश </label>
        <select
            name="temporary_province_id"
            wire:model="temporary_province_id"
            class="form-select @error('temporary_province_id') is-invalid @enderror"
            id="temporary_province_id">
            <option value="">प्रदेश छान्नुहोस्</option>
            @foreach($provinces as $province)
                <option value="{{$province->id}}">
                    {{$province->province}}
                </option>
            @endforeach
        </select>
        @error('temporary_province_id')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-2">
        <label for="temporary_district_id" class="form-label">जिल्ला </label>
        <select
            name="temporary_district_id"
            wire:model="temporary_district_id"
            class="form-select @error('temporary_district_id') is-invalid @enderror"
            id="temporary_district_id">
            <option value="">जिल्ला छान्नुहोस्</option>
            @foreach($districts as $district)
                <option value="{{$district->id}}">
                    {{$district->district}}
                </option>
            @endforeach
        </select>
        @error('temporary_district_id')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-2">
        <label for="temporary_local_body_id" class="form-label">पालिका </label>
        <select
            name="temporary_local_body_id"
            wire:model="temporary_local_body_id"
            class="form-select @error('temporary_local_body_id') is-invalid @enderror"
            id="local_body_id">
            <option value="">पालिका छान्नुहोस्</option>
            @foreach($localBodies as $localBody)
                <option value="{{$localBody->id}}">
                    {{$localBody->local_body}}
                </option>
            @endforeach
        </select>
        @error('local_body_id')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-2">
        <label for="temporary_ward" class="form-label">वडा नं.</label>
        <select
            name="temporary_ward"
            wire:model="temporary_ward"
            class="form-select @error('temporary_ward') is-invalid @enderror"
            id="temporary_ward">
            <option value="">वडा नं. छान्नुहोस्</option>

            @for($i=1;$i<=$wards;$i++)
                <option value="{{$i}}">
                    {{$i}}
                </option>
            @endfor
        </select>

        @error('temporary_ward')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
