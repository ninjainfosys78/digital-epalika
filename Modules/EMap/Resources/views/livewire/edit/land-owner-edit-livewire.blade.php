<form wire:submit.prevent="saveFormData" class="mb-2">
    <fieldset>
        <legend>३. जग्गा धनीको विवरण</legend>
        <button class="btn btn-xs float-end btn-outline-primary waves-effect waves-light"
                wire:click.prevent="setEditForm"><i
                class="fa fa-pen"></i>
        </button>
        <div class="mb-3">
            <label class="form-label fw-bold">३.१ जग्गा धनीको किसिम <span class="text-danger">*</span></label>
            <div class="col">
                @foreach(\Modules\EMap\Enums\LandOwnerTypeEnum::cases() as $landOwnerType)
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="{{$landOwnerType->name}}"
                               wire:model="landOwner.land_owner_type"
                               value="{{$landOwnerType->value}}" {{$editForm ? '' : 'disabled'}}>
                        <label class="form-check-label"
                               for="{{$landOwnerType->name}}">{{$landOwnerType->label()}}</label>
                    </div>
                @endforeach
                @error('landOwner.land_owner_type')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label" for="name">१.१ जग्गा धनीको नाम </label>
                <input class="form-control form-control-sm" type="text" id="name" wire:model="landOwner.name"
                       placeholder=" जग्गा धनीको नाम" {{$editForm ? '' : 'disabled'}}>
                @error('landOwner.name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="phone">१.२ फोन नं.</label>
                <input class="form-control form-control-sm" type="text" id="phone" wire:model="landOwner.phone"
                       placeholder="फोन नं." {{$editForm ? '' : 'disabled'}}>
                @error('landOwner.phone')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="father_name">१.३ बुवाको नाम</label>
                <input class="form-control form-control-sm" type="text" id="father_name"
                       wire:model="landOwner.father_name"
                       placeholder="बुवाको नाम" {{$editForm ? '' : 'disabled'}}>
                @error('landOwner.father_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="landOwner.grandfather_name">१.४ हजुरबुबाको नाम</label>
                <input class="form-control form-control-sm" type="text" id="landOwner.grandfather_name"
                       wire:model="landOwner.grandfather_name"
                       placeholder="हजुरबुबाको नाम" {{$editForm ? '' : 'disabled'}}>
                @error('landOwner.grandfather_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="citizenship_no">१.५ नागरिकता नम्बर</label>
                <input class="form-control form-control-sm" type="text" id="citizenship_no"
                       wire:model="landOwner.citizenship_no"
                       placeholder="नागरिकता नम्बर" {{$editForm ? '' : 'disabled'}}>
                @error('landOwner.citizenship_no')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="citizenship_issue_date">१.६ नागरिकता लिएको मिति</label>
                <input class="form-control form-control-sm" type="text" id="citizenship_issue_date"
                       wire:model="landOwner.citizenship_issue_date"
                       placeholder="yyyy/mm/dd" {{$editForm ? '' : 'disabled'}}>
                @error('landOwner.citizenship_issue_date')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="landOwner.citizenship_issue_district_id">१.७ नागरिकता लिएको
                    जिल्ला</label>
                <select class="form-select form-select-sm" wire:model="landOwner.citizenship_issue_district_id"
                        id="landOwner.citizenship_issue_district_id" {{$editForm ? '' : 'disabled'}}>
                    <option value="">--- जिल्ला छान्नुहोस् ---</option>
                    @foreach($allDistricts as $district)
                        <option value="{{$district->id}}">
                            {{$district->district}}
                        </option>
                    @endforeach
                </select>
                @error('landOwner.citizenship_issue_district_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="landOwner.address">१.८ ठेगाना</label>
                <input class="form-control form-control-sm" type="text" id="landOwner.address"
                       wire:model="landOwner.address"
                       placeholder="ठेगाना" {{$editForm ? '' : 'disabled'}}>
                @error('landOwner.address')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="landOwner.local_body">१.९ पालिका</label>
                <input class="form-control form-control-sm" type="text" id="landOwner.local_body"
                       wire:model="landOwner.local_body"
                       placeholder="पालिका" {{$editForm ? '' : 'disabled'}}>
                @error('landOwner.local_body')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="landOwner.ward_no">१.१० वडा नं.</label>
                <input class="form-control form-control-sm" type="number" id="landOwner.ward_no"
                       wire:model="landOwner.ward_no"
                       min="0" placeholder="वडा नं." {{$editForm ? '' : 'disabled'}}>
                @error('landOwner.ward_no')
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
