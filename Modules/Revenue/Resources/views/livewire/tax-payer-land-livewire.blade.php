<div>
    <form wire:submit.prevent="save()">
        <div class="row">
            <div class="col-md-3 mb-2">
                <label for="taxPayerLand.plot_no" class="form-label">कित्ता नं. *</label>
                <input
                    type="text"
                    name="taxPayerLand.plot_no"
                    value="{{old('taxPayerLand.plot_no')}}"
                    wire:model="taxPayerLand.plot_no"
                    class="form-control @error('taxPayerLand.plot_no') is-invalid @enderror"
                    id="taxPayerLand.plot_no"
                    placeholder="कित्ता नं."
                />
                @error('taxPayerLand.plot_no')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerLand.former_vdc" class="form-label">साबिक गाबिस</label>
                <input
                    type="text"
                    name="taxPayerLand.former_vdc"
                    value="{{old('taxPayerLand.former_vdc')}}"
                    wire:model="taxPayerLand.former_vdc"
                    class="form-control @error('taxPayerLand.former_vdc') is-invalid @enderror"
                    id="taxPayerLand.former_vdc"
                    placeholder="साबिक गाबिस"
                />
                @error('taxPayerLand.plot_no')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerLand.former_ward" class="form-label">साबिक वार्ड नं.</label>
                <input
                    type="text"
                    name="taxPayerLand.former_ward"
                    value="{{old('taxPayerLand.former_ward')}}"
                    wire:model="taxPayerLand.former_ward"
                    class="form-control @error('taxPayerLand.former_ward') is-invalid @enderror"
                    id="taxPayerLand.former_ward"
                    placeholder="साबिक वार्ड नं."
                />
                @error('taxPayerLand.former_ward')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerLand.ward_no" class="form-label">हालको वार्ड नं. *</label>
                <select
                    name="taxPayerLand.ward_no"
                    class="form-select @error('taxPayerLand.ward_no') is-invalid @enderror"
                    wire:model="taxPayerLand.ward_no"
                    id="taxPayerLand.ward_no" data-width="100%">
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach($wards as $ward)
                        <option
                            value="{{$ward}}"
                            {{old('taxPayerLand.ward_no') == $ward ? 'selected' : ''}}
                        >
                            {{$ward}}
                        </option>
                    @endforeach
                </select>
                @error('taxPayerLand.ward_no')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerLand.area" class="form-label">क्षेत्रफल (वर्ग मीटरमा) *</label>
                <input
                    type="number"
                    step="0.01"
                    name="taxPayerLand.area"
                    value="{{old('taxPayerLand.area')}}"
                    wire:model="taxPayerLand.area"
                    class="form-control @error('taxPayerLand.area') is-invalid @enderror"
                    id="taxPayerLand.area"
                    placeholder="क्षेत्रफल"
                />
                @error('taxPayerLand.area')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerLand.land_address" class="form-label">जग्गा रहेको स्थान *</label>
                <input
                    type="text"
                    name="taxPayerLand.land_address"
                    value="{{old('taxPayerLand.land_address')}}"
                    wire:model="taxPayerLand.land_address"
                    class="form-control @error('taxPayerLand.land_address') is-invalid @enderror"
                    id="taxPayerLand.land_address"
                    placeholder="जग्गा रहेको स्थान"
                />
                @error('taxPayerLand.land_address')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerLand.sector_id" class="form-label">क्षेत्र *</label>
                <select
                    name="taxPayerLand.sector_id"
                    class="form-select @error('taxPayerLand.sector_id') is-invalid @enderror"
                    wire:model="taxPayerLand.sector_id"
                    id="taxPayerLand.sector_id" data-width="100%">
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach($sectors as $sector)
                        <option
                            value="{{$sector->id}}"
                            {{old('taxPayerLand.sector_id') == $sector->id ? 'selected' : ''}}
                        >
                            {{$sector->title}}
                        </option>
                    @endforeach
                </select>
                @error('taxPayerLand.sector_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerLand.place_id" class="form-label">जग्गा जोडिएको मुख्य सडक *</label>
                <select
                    name="taxPayerLand.place_id"
                    class="form-select @error('taxPayerLand.place_id') is-invalid @enderror"
                    wire:model="taxPayerLand.place_id"
                    id="taxPayerLand.place_id" data-width="100%">
                    <option value="">--- छान्नुहोस् ---</option>
                    @foreach($places as $place)
                        <option
                            value="{{$place->id}}"
                            {{old('taxPayerLand.place_id') == $place->id ? 'selected' : ''}}
                        >
                            {{$place->title}}
                        </option>
                    @endforeach
                </select>
                @error('taxPayerLand.place_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>

            <div class="col-md-3 mb-2">
                <label for="taxPayerLand.land_use" class="form-label">जग्गाको प्रयोग*</label>
                <input
                    type="text"
                    name="taxPayerLand.land_use"
                    value="{{old('taxPayerLand.land_use')}}"
                    wire:model="taxPayerLand.land_use"
                    class="form-control @error('taxPayerLand.land_use') is-invalid @enderror"
                    id="taxPayerLand.land_use"
                    placeholder="जग्गाको प्रयोग"
                />
                @error('taxPayerLand.land_use')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-2">
                <label for="taxPayerLand.remarks" class="form-label">कैफियत*</label>
                <input
                    type="text"
                    name="taxPayerLand.remarks"
                    value="{{old('taxPayerLand.remarks')}}"
                    wire:model="taxPayerLand.remarks"
                    class="form-control @error('taxPayerLand.remarks') is-invalid @enderror"
                    id="taxPayerLand.remarks"
                    placeholder="कैफियत"
                />
                @error('taxPayerLand.remarks')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
</div>
