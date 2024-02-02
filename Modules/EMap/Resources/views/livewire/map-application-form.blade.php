<form wire:submit.prevent="saveFormData">
    <div class="row mb-3">
        <div class="col-md-3">
            {{-- <label for="organization_id" class="form-label fw-bolder">संस्था <span class="text-danger">*</span></label> --}}
            <select wire:model="applyMap.organization_id" id="organization_id" name="organization_id"
                class="form-select form-select-sm form-control-lg" required>
                <option value="">--- संस्था छान्नुहोस् ---</option>
                @foreach ($organizations as $organization)
                    <option value="{{ $organization->id }}">
                        {{ $organization->organizationDetail->org_name_ne ?? ($organization->userDetail->name_ne ?? '') }}
                    </option>
                @endforeach
            </select>
            @error('applyMap.organization_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-3">
            {{-- <label for="application_type" class="form-label fw-bolder"> नक्सा <span class="text-danger">*</span></label> --}}
            <select wire:model="applyMap.application_type" id="organization_id" name="application_type"
                class="form-select form-select-sm form-control-lg" required>
                <option value="">--- नक्सा छान्नुहोस् ---</option>
                @foreach (\Modules\EMap\Enums\ApplicationFormTypeEnum::cases() as $applicationFormTypeEnum)
                    <option value="{{ $applicationFormTypeEnum->value }}">{{ $applicationFormTypeEnum->label() }}
                    </option>
                @endforeach
            </select>
            @error('applyMap.application_type')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="card p-4 mb-4">
        <legend>
            <h5>१. प्रस्तावित भवनको विवरण</h5>
        </legend>
        <div class="mb-3">
            <label class="form-label fw-bolder">१.१ निर्माण कार्यको किसिम *</label>
            <div class="col">
                @foreach (\Modules\EMap\Enums\TypeOfConstructionWorkEnum::cases() as $constructionType)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="applyMap.construction_type"
                            id="{{ $constructionType->name }}" value="{{ $constructionType->value }}">
                        <label class="form-check-label"
                            for="{{ $constructionType->name }}">{{ $constructionType->label() }}</label>
                    </div>
                @endforeach
                @error('applyMap.construction_type')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>




        <div class="mb-1">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-bolder" for="applyMap.current_storey">१.२ हाल निर्माण गर्ने तल्ला
                        संख्या </label>
                    <input type="number" class="form-control form-control-sm" id="applyMap.current_storey"
                        wire:model="applyMap.current_storey" placeholder="तल्ला संख्या अंकमा" min="0">
                    @error('applyMap.current_storey')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label fw-bolder" for="applyMap.future_storey">१.३ भविष्यमा निर्माण गर्ने तल्ला
                        संख्या </label>
                    <input type="number" class="form-control form-control-sm" id="applyMap.future_storey"
                        wire:model="applyMap.future_storey" min="0"
                        placeholder="भविष्यमा निर्माण गर्ने तल्ला संख्या">
                    @error('applyMap.future_storey')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-bolder" for="latitude">१.४ Latitude</label>
                    <input type="number" class="form-control form-control-sm" id="latitude" wire:model="applyMap.latitude"
                        step="0.000000000000001" placeholder="Latitude" required>

                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label fw-bolder" for="longitude">१.५ Longitude</label>
                    <input type="number" class="form-control form-control-sm" id="longitude" wire:model="applyMap.longitude"
                        step="0.000000000000001" placeholder="longitude" required>
                </div>

                {{-- <div class="col-md-12">
                    <label class="form-label fw-bolder">१.११ तल्लाको क्षेत्रफल र उचाईको विवरण </label>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">तल्ला</th>
                                    <th scope="col">प्रस्तावित निर्माणको क्षेत्रफल</th>
                                    <th scope="col">साविक निर्माणको क्षेत्रफल</th>
                                    <th scope="col">जम्मा क्षेत्रफल</th>
                                    <th scope="col">उचाई</th>
                                    <th scope="col">
                                        <button type="button" class="btn btn-sm btn-primary"
                                            wire:click.prevent="addStoreyDetail">
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applyMap['storeyDetails'] as $index => $storeyDetail)
                                    <tr>
                                        <td>
                                            <select class="form-select form-select-sm"
                                                wire:model="applyMap.storeyDetails.{{ $index }}.map_fee_id">
                                                <option value="">-- छान्नुहोस् --</option>
                                                @foreach ($mapFees as $mapFee)
                                                    <option value="{{ $mapFee->id }}">{{ $mapFee->storey }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('applyMap.storeyDetails.' . $index . '.map_fee_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number"
                                                id="storeyDetails.{{ $index }}.area_of_proposed_construction"
                                                wire:model="applyMap.storeyDetails.{{ $index }}.area_of_proposed_construction"
                                                placeholder="प्रस्तावित निर्माणको क्षेत्रफल" min="0"
                                                class="form-control form-control-sm">
                                            @error('applyMap.storeyDetails.' . $index .
                                                '.area_of_proposed_construction')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number"
                                                id="storeyDetails.{{ $index }}.area_of_former_construction"
                                                wire:model="applyMap.storeyDetails.{{ $index }}.area_of_former_construction"
                                                min="0" class="form-control form-control-sm"
                                                placeholder="साविक निर्माणको क्षेत्रफल">
                                            @error('applyMap.storeyDetails.' . $index . '.area_of_former_construction')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" id="storeyDetails.{{ $index }}.total_area"
                                                wire:model="applyMap.storeyDetails.{{ $index }}.total_area"
                                                min="0" class="form-control form-control-sm"
                                                placeholder="जम्मा क्षेत्रफल">
                                            @error('applyMap.storeyDetails.' . $index . '.total_area')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" id="storeyDetails.{{ $index }}.height"
                                                wire:model="applyMap.storeyDetails.{{ $index }}.height"
                                                min="0" class="form-control form-control-sm"
                                                placeholder="उचाई">
                                            @error('applyMap.storeyDetails.' . $index . '.height')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                wire:click.prevent="removeStoreyDetail({{ $index }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    @error('applyMap.storeyDetails')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div> --}}
            </div>
        </div>
    </div>
    <div class="card p-4 mb-4">
        <legend>
            <h5>२. जग्गाको विवरण</h5>
        </legend>
        <div class="row">

            <div class="col-md-4 mb-3">
                <label class="form-label fw-bolder" for="landDescription.ward_no">२.१ वडा नं</label>
                <input class="form-control form-control-sm" type="number" id="landDescription.ward_no"
                    wire:model="landDescription.ward_no" min="0" placeholder="वडा नं">
                @error('landDescription.ward_no')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bolder" for="landDescription.former_ward_no">२.२ साविक वडा नं</label>
                <input class="form-control form-control-sm" type="number" id="landDescription.former_ward_no"
                    wire:model="landDescription.former_ward_no" min="0" placeholder="साविक वडा नं">
                @error('landDescription.former_ward_no')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bolder" for="landDescription.tole">२.३ टोलको नाम </label>
                <input class="form-control form-control-sm" type="text" id="landDescription.tole"
                    wire:model="landDescription.tole" placeholder="टोलको नाम">
                @error('landDescription.tole')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-bolder" for="landDescription.plot_no">२.४ जग्गा कित्ता नं</label>
                <input class="form-control form-control-sm" type="text" id="landDescription.plot_no"
                    wire:model="landDescription.plot_no" placeholder="जग्गा कित्ता नं">
                @error('landDescription.plot_no')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label fw-bolder">२.५ क्षेत्रफल
                    ({{ $setting->standardLandMeasurement->title ?? '' }})</label>
                <input type="text" class="form-control form-control-sm" id="landDescription.unit_value"
                    wire:model="landDescription.unit_value"
                    placeholder="क्षेत्रफल ({{ $setting->standardLandMeasurement->title ?? '' }})">
            </div>

        </div>
    </div>
    <div class="card p-4 mb-4">
        <legend>
            <h5>३. जग्गा धनीको विवरण</h5>
        </legend>
        <div class="mb-3">
            <label class="form-label fw-bolder">३.१ जग्गा धनीको किसिम <span class="text-danger">*</span></label>
            <div class="col">
                @foreach (\Modules\EMap\Enums\LandOwnerTypeEnum::cases() as $landOwnerType)
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" id="{{ $landOwnerType->name }}"
                            wire:model="landOwner.land_owner_type" value="{{ $landOwnerType->value }}">
                        <label class="form-check-label"
                            for="{{ $landOwnerType->name }}">{{ $landOwnerType->label() }}</label>
                    </div>
                @endforeach
                @error('landOwner.land_owner_type')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label" for="name">१.१ जग्गा धनीको नाम </label>
                <input class="form-control form-control-sm" type="text" id="name"
                    wire:model="landOwner.name" placeholder=" जग्गा धनीको नाम">
                @error('landOwner.name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="phone">१.२ फोन नं.</label>
                <input class="form-control form-control-sm" type="text" id="phone"
                    wire:model="landOwner.phone" placeholder="फोन नं.">
                @error('landOwner.phone')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="father_name">१.३ बुवाको नाम</label>
                <input class="form-control form-control-sm" type="text" id="father_name"
                    wire:model="landOwner.father_name" placeholder="बुवाको नाम">
                @error('landOwner.father_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="landOwner.grandfather_name">१.४ हजुरबुबाको नाम</label>
                <input class="form-control form-control-sm" type="text" id="landOwner.grandfather_name"
                    wire:model="landOwner.grandfather_name" placeholder="हजुरबुबाको नाम">
                @error('landOwner.grandfather_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="citizenship_no">१.५ नागरिकता नम्बर</label>
                <input class="form-control form-control-sm" type="text" id="citizenship_no"
                    wire:model="landOwner.citizenship_no" placeholder="नागरिकता नम्बर">
                @error('landOwner.citizenship_no')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="citizenship_issue_date">१.६ नागरिकता लिएको मिति</label>
                <input class="form-control form-control-sm" type="text" id="citizenship_issue_date"
                    wire:model="landOwner.citizenship_issue_date" placeholder="yyyy/mm/dd">
                @error('landOwner.citizenship_issue_date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="landOwner.citizenship_issue_district_id">१.७ नागरिकता लिएको
                    जिल्ला</label>
                <select class="form-select form-select-sm" wire:model="landOwner.citizenship_issue_district_id"
                    id="landOwner.citizenship_issue_district_id">
                    <option value="">--- जिल्ला छान्नुहोस् ---</option>
                    @foreach ($allDistricts as $district)
                        <option value="{{ $district->id }}">
                            {{ $district->district }}
                        </option>
                    @endforeach
                </select>
                @error('landOwner.citizenship_issue_district_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="landOwner.address">१.८ ठेगाना</label>
                <input class="form-control form-control-sm" type="text" id="landOwner.address"
                    wire:model="landOwner.address" placeholder="ठेगाना">
                @error('landOwner.address')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="landOwner.local_body">१.९ पालिका</label>
                <input class="form-control form-control-sm" type="text" id="landOwner.local_body"
                    wire:model="landOwner.local_body" placeholder="पालिका">
                @error('landOwner.local_body')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="landOwner.ward_no">१.१० वडा नं.</label>
                <input class="form-control form-control-sm" type="number" id="landOwner.ward_no"
                    wire:model="landOwner.ward_no" min="0" placeholder="वडा नं.">
                @error('landOwner.ward_no')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="card p-4 mb-4">
        <legend>
            <h5>४. घर धनीको विवरण (जग्गाधनी भन्दा फरक भएमा)</h5>
        </legend>
        <div class="d-flex align-items-center gap-2 mb-3">
            <label for="detail_check">के घर धनीको विवरण र जग्गाधनीको विवरण एउटै हो ?</label>
            <button wire:click.prevent="checkSameAsLandOwner" type="button" class="btn btn-link btn-sm border-none"
                id="detail_check">
                <i class="fa fa-toggle-{{ $same_as_land_owner ? 'on' : 'off' }} fa-2x"></i>
            </button>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.name">१.१ जग्गा धनीको नाम </label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.name"
                    wire:model="houseOwner.name" placeholder=" जग्गा धनीको नाम">
                @error('houseOwner.name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.phone">१.२ फोन नं.</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.phone"
                    wire:model="houseOwner.phone" placeholder="फोन नं.">
                @error('houseOwner.phone')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.father_name">१.३ बुवाको नाम</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.father_name"
                    wire:model="houseOwner.father_name" placeholder="बुवाको नाम">
                @error('houseOwner.father_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.grandfather_name">१.४ हजुरबुबाको नाम</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.grandfather_name"
                    wire:model="houseOwner.grandfather_name" placeholder="हजुरबुबाको नाम">
                @error('houseOwner.grandfather_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.citizenship_no">१.५ नागरिकता नम्बर</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.citizenship_no"
                    wire:model="houseOwner.citizenship_no" placeholder="नागरिकता नम्बर">
                @error('houseOwner.citizenship_no')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.citizenship_issue_date">१.६ नागरिकता लिएको मिति</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.citizenship_issue_date"
                    wire:model="houseOwner.citizenship_issue_date" placeholder="yyyy/mm/dd">
                @error('houseOwner.citizenship_issue_date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.citizenship_issue_district_id">१.७ नागरिकता लिएको
                    जिल्ला</label>
                <select class="form-select form-select-sm" wire:model="houseOwner.citizenship_issue_district_id"
                    id="houseOwner.citizenship_issue_district_id">
                    <option value="">--- जिल्ला छान्नुहोस् ---</option>
                    @foreach ($allDistricts as $district)
                        <option value="{{ $district->id }}">
                            {{ $district->district }}
                        </option>
                    @endforeach
                </select>
                @error('houseOwner.citizenship_issue_district_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.address">१.८ ठेगाना</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.address"
                    wire:model="houseOwner.address" placeholder="ठेगाना">
                @error('houseOwner.address')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.local_body">१.९ पालिका</label>
                <input class="form-control form-control-sm" type="text" id="houseOwner.local_body"
                    wire:model="houseOwner.local_body" placeholder="पालिका">
                @error('houseOwner.local_body')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="houseOwner.ward_no">१.१० वडा नं.</label>
                <input class="form-control form-control-sm" type="number" id="houseOwner.ward_no"
                    wire:model="houseOwner.ward_no" min="0" placeholder="वडा नं.">
                @error('houseOwner.ward_no')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="card p-4 mb-4">
        <legend>
            <h5>५. निवेदकको विवरण</h5>
        </legend>
        <div class="mb-3">
            <label class="form-label fw-bolder">५.१ निवेदकको प्रकार </label>
            <div class="col">
                @foreach (\Modules\EMap\Enums\ApplicantTypeEnum::cases() as $applicantType)
                    <div class="form-check form-check-inline">
                        <input type="radio" id="{{ $applicantType->name }}"
                            wire:model="applicantDetail.applicant_type" value="{{ $applicantType->value }}"
                            class="form-check-input">
                        <label class="form-check-label"
                            for="{{ $applicantType->name }}">{{ $applicantType->label() }}</label>
                    </div>
                @endforeach
                @error('applicantDetail.applicant_type')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bolder">५.२ घरधनी सँगको सम्बन्ध</label>
            <div class="col">
                @foreach (\Modules\EMap\Enums\RelationEnum::cases() as $relation)
                    <div class="form-check form-check-inline">
                        <input type="radio" id="{{ $relation->name }}"
                            wire:model="applicantDetail.relation_with_owner" value="{{ $relation->value }}"
                            class="form-check-input">
                        <label class="form-check-label" for="{{ $relation->name }}">{{ $relation->label() }}</label>
                    </div>
                @endforeach
                @error('applicantDetail.relation_with_owner')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row">
            <label class="form-label fw-bolder">जग्गाधनी वा घरधनी भन्दा फरक भएमा</label>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="applicantDetail.name">१.१ नाम</label>
                <input class="form-control form-control-sm" type="text" id="applicantDetail.name"
                    wire:model="applicantDetail.name" placeholder="नाम">
                @error('applicantDetail.name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="applicantDetail.phone">१.२ फोन नं.</label>
                <input class="form-control form-control-sm" type="text" id="applicantDetail.phone"
                    wire:model="applicantDetail.phone" placeholder="फोन नं.">
                @error('applicantDetail.phone')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="applicantDetail.father_name">१.३ बुवाको नाम</label>
                <input class="form-control form-control-sm" type="text" id="applicantDetail.father_name"
                    wire:model="applicantDetail.father_name" placeholder="बुवाको नाम">
                @error('applicantDetail.father_name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">

                <label class="form-label" for="applicantDetail.citizenship_no">१.४ नागरिकत नम्बर</label

                <input class="form-control form-control-sm" type="text" id="applicantDetail.citizenship_no"
                    wire:model="applicantDetail.citizenship_no" placeholder="नागरिकत नम्बर">
                @error('applicantDetail.citizenship_no')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-4">
                <label class="form-label" for="applicantDetail.citizenship_issue_date">१.५ नागरिकता लिएको मिति</label>
                <input class="form-control form-control-sm" type="text"
                    id="applicantDetail.citizenship_issue_date" wire:model="applicantDetail.citizenship_issue_date"
                    placeholder="yyyy/mm/dd">
                @error('applicantDetail.citizenship_issue_date')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label class="form-label" for="applicantDetail.citizenship_issue_district_id">१.६ नागरिकता लिएको
                    जिल्ला</label>
                <select class="form-select form-select-sm" wire:model="applicantDetail.citizenship_issue_district_id">
                    <option value="">--- जिल्ला छान्नुहोस् ---</option>
                    @foreach ($allDistricts as $district)
                        <option value="{{ $district->id }}">
                            {{ $district->district }}
                        </option>
                    @endforeach
                </select>
                @error('applicantDetail.citizenship_issue_district_id')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>

    </div>
    <div class="d-flex justify-content-between mt-3">
        <div class="col-3">
            <label class="form-label fw-bolder" for="application_date">निबेदनको मिति <span
                    class="text-danger">*</span></label>
            <input type="text" id="application_date" wire:model="applicantDetail.application_date"
                class="form-control form-control-sm" placeholder="yyyy/mm/dd">
            @error('applicantDetail.application_date')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col-3">
            <label class="form-label fw-bolder" for="applicant_signature">निवेदकको सहि</label>
            <input type="file" id="applicant_signature" wire:model="applicantDetail.signature"
                class="form-control form-control-sm">
            @error('applicantDetail.signature')
                <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
    </div>



</form>
