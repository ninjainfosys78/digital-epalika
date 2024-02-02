<form wire:submit.prevent="saveFormData" class="mb-2">
    <fieldset>
        <legend>२. जग्गाको विवरण</legend>
        <button class="btn float-end btn-xs btn-outline-primary waves-effect waves-light" wire:click.prevent="setEditForm"><i
                class="fa fa-pen"></i>
        </button>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="landDescription.land_use_area_id">२.१ भू-उपयोग्य क्षेत्र</label>
                <select class="form-select form-select-sm"
                        id="landDescription.land_use_area_id"
                        wire:model="landDescription.land_use_area_id">
                    <option value="">-- छान्नुहोस् --</option>
                    @foreach($landUseAreas as $landUseArea)
                        <option value="{{$landUseArea->id}}">{{$landUseArea->title}}</option>
                    @endforeach
                </select>
                @error('landDescription.land_use_area_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="landDescription.ward_no">२.२ वडा नं</label>
                <input class="form-control form-control-sm" type="number" id="landDescription.ward_no"
                       wire:model="landDescription.ward_no"
                       min="0" placeholder="वडा नं" {{$editForm ? '' : 'disabled'}}>
                @error('landDescription.ward_no')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="landDescription.former_ward_no">२.३ साविक वडा नं</label>
                <input class="form-control form-control-sm" type="number" id="landDescription.former_ward_no"
                       wire:model="landDescription.former_ward_no"
                       min="0" placeholder="साविक वडा नं" {{$editForm ? '' : 'disabled'}}>
                @error('landDescription.former_ward_no')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="landDescription.tole">२.४ टोलको नाम </label>
                <input class="form-control form-control-sm" type="text" id="landDescription.tole"
                       wire:model="landDescription.tole"
                       placeholder="टोलको नाम" {{$editForm ? '' : 'disabled'}}>
                @error('landDescription.tole')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="landDescription.street_code_no">२.५ सडक कोड नं</label>
                <input class="form-control form-control-sm" type="text" id="landDescription.street_code_no"
                       wire:model="landDescription.street_code_no"
                       placeholder="सडक कोड नं" {{$editForm ? '' : 'disabled'}}>
                @error('landDescription.street_code_no')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="landDescription.plot_no">२.६ जग्गा कित्ता नं</label>
                <input class="form-control form-control-sm" type="text" id="landDescription.plot_no"
                       wire:model="landDescription.plot_no"
                       placeholder="जग्गा कित्ता नं" {{$editForm ? '' : 'disabled'}}>
                @error('landDescription.plot_no')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">२.७ क्षेत्रफल ({{$setting->standardLandMeasurement->title ?? ''}})</label>
                <input type="text" class="form-control form-control-sm" id="landDescription.unit_value"
                       wire:model="landDescription.unit_value"
                       placeholder="क्षेत्रफल ({{$setting->standardLandMeasurement->title ?? ''}})" {{$editForm ? '' : 'disabled'}}>
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bold" for="landDescription.percentage_of_area_covered_by_building">२.८ भवनले
                    ढाक्ने क्षेत्रफलको प्रतिशत (GCR)</label>
                <input class="form-control form-control-sm" type="number"
                       id="landDescription.percentage_of_area_covered_by_building"
                       wire:model="landDescription.percentage_of_area_covered_by_building"
                       placeholder="भवनले ढाक्ने क्षेत्रफलको प्रतिशत (GCR)" {{$editForm ? '' : 'disabled'}}>
                @error('landDescription.percentage_of_area_covered_by_building')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        @if($editForm)
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
            </div>
        @endif
    </fieldset>
</form>
