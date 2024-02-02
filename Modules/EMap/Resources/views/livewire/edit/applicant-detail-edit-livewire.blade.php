<form wire:submit.prevent="saveFormData" class="mb-2">
    <fieldset>
        <legend>७. निवेदकको विवरण</legend>
        <button class="btn btn-xs float-end btn-outline-primary waves-effect waves-light"
                wire:click.prevent="setEditForm"><i
                class="fa fa-pen"></i>
        </button>
        <div class="mb-3">
            <label class="form-label fw-bold">७.१ निवेदकको प्रकार : </label>
            <div class="col">
                @foreach(\Modules\EMap\Enums\ApplicantTypeEnum::cases() as $applicantType)
                    <div class="form-check form-check-inline">
                        <input type="radio"
                               id="{{$applicantType->name}}"
                               wire:model="applicantDetail.applicant_type"
                               {{$editForm ? '' : 'disabled'}}
                               value="{{$applicantType->value}}" class="form-check-input">
                        <label class="form-check-label"
                               for="{{$applicantType->name}}">{{$applicantType->label()}}</label>
                    </div>
                @endforeach
                @error('applicantDetail.applicant_type')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">७.२ घरधनी सँगको सम्बन्ध</label>
            <div class="col">
                @foreach(\Modules\EMap\Enums\RelationEnum::cases() as $relation)
                    <div class="form-check form-check-inline">
                        <input type="radio"
                               id="{{$relation->name}}"
                               wire:model="applicantDetail.relation_with_owner"
                               {{$editForm ? '' : 'disabled'}}
                               value="{{$relation->value}}" class="form-check-input">
                        <label class="form-check-label" for="{{$relation->name}}">{{$relation->label()}}</label>
                    </div>
                @endforeach
                @error('applicantDetail.relation_with_owner')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="row">
            <label class="form-label fw-bold">जग्गाधनी वा घरधनी भन्दा फरक भएमा</label>
            <div class="col-md-4 mb-2">
                <label for="applicantDetail.name">१.१ नाम</label>
                <input type="text"
                       id="applicantDetail.name"
                       wire:model="applicantDetail.name"
                    {{$editForm ? '' : 'disabled'}}
                 class="form-control form-control-sm">
                @error('applicantDetail.name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label" for="applicantDetail.phone">१.२ फोन नं.</label>
                <input type="text"
                       id="applicantDetail.phone"
                       wire:model="applicantDetail.phone"
                    {{$editForm ? '' : 'disabled'}}
                class="form-control form-control-sm">
                @error('applicantDetail.phone')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label" for="applicantDetail.father_name">१.३ बुवाको नाम</label>
                <input type="text"
                       id="applicantDetail.father_name"
                       wire:model="applicantDetail.father_name"
                    {{$editForm ? '' : 'disabled'}}
                class="form-control form-control-sm">
                @error('applicantDetail.father_name')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label" for="applicantDetail.citizenship_issue_district_id">१.४ नागरिकता लिएको जिल्ला</label>
                <select wire:model="applicantDetail.citizenship_issue_district_id"
                    {{$editForm ? '' : 'disabled'}} class="form-select form-select-sm">
                    <option value=""></option>
                    @foreach($allDistricts as $district)
                        <option value="{{$district->id}}">
                            {{$district->district}}
                        </option>
                    @endforeach
                </select>
                @error('applicantDetail.citizenship_issue_district_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label" for="applicantDetail.citizenship_no">१.५ नागरिकत नम्बर</label>
                <input type="text"
                       id="applicantDetail.citizenship_no"
                       wire:model="applicantDetail.citizenship_no"
                    {{$editForm ? '' : 'disabled'}}
                class="form-control form-control-sm">
                @error('applicantDetail.citizenship_no')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label" for="applicantDetail.citizenship_issue_date">१.६ नागरिकता लिएको मिति</label>
                <input type="text"
                       id="applicantDetail.citizenship_issue_date"
                       wire:model="applicantDetail.citizenship_issue_date"
                    {{$editForm ? '' : 'disabled'}}
                class="form-control form-control-sm">
                @error('applicantDetail.citizenship_issue_date')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <div class="col-3">
                <label class="form-label fw-bold" for="application_date">निबेदनको मिति <span class="text-danger">*</span></label>
                <input type="text" id="application_date" wire:model="applicantDetail.application_date"
                       class="form-control form-control-sm" placeholder="yyyy/mm/dd">
                @error('applicantDetail.application_date')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="col-4 d-flex align-items-center gap-2">
                @if($signatureUrl || $signature)
                    <div>
                        <img src="{{ $signature?->temporaryUrl() ??$signatureUrl ?? ''}}" alt="" width="60">
                    </div>
                @endif
                <div>
                    <label class="form-label fw-bold" for="applicant_signature">निवेदकको सहि <span class="text-danger">*</span></label>
                    <input type="file" id="applicant_signature" wire:model="applicantDetail.signature"
                           class="form-control form-control-sm">
                    @error('applicantDetail.signature')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
        </div>
        @if($editForm)
            <div class="my-4 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        @endif
    </fieldset>
</form>
