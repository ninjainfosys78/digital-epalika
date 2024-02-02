<form wire:submit.prevent="saveFormData" class="mb-2">
    <fieldset>
        <legend>४. घर धनीको विवरण (जग्गाधनी भन्दा फरक भएमा)</legend>
        <button class="btn float-end btn-xs btn-outline-primary waves-effect waves-light" wire:click.prevent="setEditForm"><i
                class="fa fa-pen"></i>
        </button>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.name">१.१ जग्गा धनीको नाम </label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.name"
                       wire:model="houseOwner.name"
                       placeholder=" जग्गा धनीको नाम" {{$editForm ? '' : 'disabled'}}>
                @error('houseOwner.name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.phone">१.२ फोन नं.</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.phone"
                       wire:model="houseOwner.phone"
                       placeholder="फोन नं." {{$editForm ? '' : 'disabled'}}>
                @error('houseOwner.phone')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.father_name">१.३ बुवाको नाम</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.father_name"
                       wire:model="houseOwner.father_name"
                       placeholder="बुवाको नाम" {{$editForm ? '' : 'disabled'}}>
                @error('houseOwner.father_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.grandfather_name">१.४ हजुरबुबाको नाम</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.grandfather_name"
                       wire:model="houseOwner.grandfather_name"
                       placeholder="हजुरबुबाको नाम" {{$editForm ? '' : 'disabled'}}>
                @error('houseOwner.grandfather_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.citizenship_no">१.५ नागरिकता नम्बर</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.citizenship_no"
                       wire:model="houseOwner.citizenship_no"
                       placeholder="नागरिकता नम्बर" {{$editForm ? '' : 'disabled'}}>
                @error('houseOwner.citizenship_no')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.citizenship_issue_date">१.६ नागरिकता लिएको मिति</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.citizenship_issue_date"
                       wire:model="houseOwner.citizenship_issue_date"
                       placeholder="yyyy/mm/dd" {{$editForm ? '' : 'disabled'}}>
                @error('houseOwner.citizenship_issue_date')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.citizenship_issue_district_id">१.७ नागरिकता लिएको
                    जिल्ला</label>
                <select class="form-select form-select-sm" wire:model="houseOwner.citizenship_issue_district_id"
                        id="houseOwner.citizenship_issue_district_id" {{$editForm ? '' : 'disabled'}}>
                    <option value="">--- जिल्ला छान्नुहोस् ---</option>
                    @foreach($allDistricts as $district)
                        <option value="{{$district->id}}">
                            {{$district->district}}
                        </option>
                    @endforeach
                </select>
                @error('houseOwner.citizenship_issue_district_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.address">१.८ ठेगाना</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.address"
                       wire:model="houseOwner.address"
                       placeholder="ठेगाना" {{$editForm ? '' : 'disabled'}}>
                @error('houseOwner.address')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.local_body">१.९ पालिका</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.local_body"
                       wire:model="houseOwner.local_body"
                       placeholder="पालिका" {{$editForm ? '' : 'disabled'}}>
                @error('houseOwner.local_body')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.ward_no">१.१० वडा नं.</label>
                <input class="form-control form-control-sm" type="number" id="houseOwner.ward_no"
                       wire:model="houseOwner.ward_no"
                       min="0" placeholder="वडा नं." {{$editForm ? '' : 'disabled'}}>
                @error('houseOwner.ward_no')
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
