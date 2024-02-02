<div class="overflow-hidden p-2">
    <div class="row">
        <div class="col">
            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                <li class="nav-item">
                    <a class="nav-link rounded-0 pt-2 pb-2 {{ $currentStep === 1 ? 'active' : '' }}">
                        <i class="fa fa-building me-1"></i>
                        <span class="d-none d-sm-inline fs-5 fw-bold">व्यवसाय दर्ता</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 pt-2 pb-2 {{ $currentStep === 2 ? 'active' : '' }}">
                        <i class="fa fa-user me-1"></i>
                        <span class="d-none d-sm-inline  fs-5 fw-bold">पार्टनर</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link rounded-0 pt-2 pb-2 {{ $currentStep === 3 ? 'active' : '' }}">
                        <i class="fa fa-file me-1"></i>
                        <span class="d-none d-sm-inline  fs-5 fw-bold">अन्य</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @if ($progressPercentage > 0)
        <div id="bar" class="progress mb-3" style="height: 7px;">
            <div class="bar progress-bar progress-bar-striped progress-bar-animated bg-success"
                style="width: {{ $progressPercentage }}%"></div>
        </div>
    @endif
    <form wire:submit.prevent="submitForm">
        @switch($currentStep)
            @case(3)
                <fieldset>
                    <legend class="title text-primary fs-4 fw-bolder"> विवरण</legend>
                    <div class="row">
                        <div class="col-md-4 mb-1">
                            <label for="length" class="form-label"> लम्बाई (फिट)<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control @error('form.length') is-invalid @enderror" type="number"
                                    step="any" id="length" wire:model="form.length" placeholder="लम्बाई">
                                @error('form.length')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="width" class="form-label"> चौडाई (फिट)</label>
                            <div class="input-group">
                                <input class="form-control @error('form.width') is-invalid @enderror" type="number"
                                    step="any" id="width" wire:model="form.width" placeholder="चौडाई">
                                @error('form.width')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="application_date" class="form-label"> आवेदन मिति बि. सं. <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control @error('form.application_date') is-invalid @enderror" type="text"
                                    id="application_date" wire:model="form.application_date" placeholder="आवेदन मिति बि. सं.">
                                @error('form.application_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="application_date_en" class="form-label"> आवेदन मिति ई. सं. <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control @error('form.application_date_en') is-invalid @enderror"
                                    type="text" id="application_date_en" wire:model="form.application_date_en"
                                    placeholder="आवेदन मिति ई. सं.">
                                @error('form.application_date_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="title text-primary fs-4 fw-bolder"> आवश्यक कागजातहरु</legend>
                    <div class="row">

                        <div class="col-md-4 mb-1">
                            <label for="land_ownership_certificate" class="form-label"> आफ्नै घर जग्गा भए जग्गा धनि
                                प्रमाणपत्र </label>
                            <div class="input-group">
                                <input class="form-control @error('form.land_ownership_certificate') is-invalid @enderror"
                                    type="file" id="land_ownership_certificate" wire:model="form.land_ownership_certificate">
                                @error('form.land_ownership_certificate')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="ward_recommendation" class="form-label"> वार्ड सिफारिस <span
                                    class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control @error('form.ward_recommendation') is-invalid @enderror"
                                    type="file" id="ward_recommendation" wire:model="form.ward_recommendation">
                                @error('form.ward_recommendation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="embassy_document" class="form-label"> राजदूतावासको कागजात </label>
                            <div class="input-group">
                                <input class="form-control @error('form.embassy_document') is-invalid @enderror" type="file"
                                    id="embassy_document" wire:model="form.embassy_document">
                                @error('form.embassy_document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="registration_document" class="form-label"> दर्ता प्रमाणपत्र </label>
                            <div class="input-group">
                                <input class="form-control @error('form.registration_document') is-invalid @enderror"
                                    type="file" id="registration_document" wire:model="form.registration_document">
                                @error('form.registration_document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="license" class="form-label"> इजाजत पत्र </label>
                            <div class="input-group">
                                <input class="form-control @error('form.license') is-invalid @enderror" type="file"
                                    id="license" wire:model="form.license">
                                @error('form.license')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="tax_document" class="form-label"> कर तिरेको प्रमाणपत्र </label>
                            <div class="input-group">
                                <input class="form-control @error('form.tax_document') is-invalid @enderror" type="file"
                                    id="tax_document" wire:model="form.tax_document">
                                @error('form.tax_document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend class="title text-primary fs-4 fw-bolder"> अन्य कागजातहरु</legend>
                    <div class="row">

                        <div class="col-md-4 mb-1">
                            <label for="other_document" class="form-label">
                                अन्य
                            </label>
                            <div class="input-group">
                                <input class="form-control @error('form.other_document') is-invalid @enderror" type="file"
                                    id="other" wire:model="form.other_document" multiple>
                                @error('form.other_document')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="mt-3">
                    <div class="next d-flex justify-content-around">
                        <button type="button" wire:click.prevent="backStep(2)" class="btn btn-info">
                            <i class="fa fa-arrow-circle-left"></i> पछाडि
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> पेश गर्नुहोस्
                        </button>
                    </div>
                </div>
            @break

            @case(2)
                @foreach ($form['partners'] as $key => $partner)
                    <fieldset>
                        <legend class="title text-primary fs-4 fw-bolder"> व्यक्तिगत विवरण</legend>
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.name" class="form-label"> नाम <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input class="form-control @error('form.partners.' . $key . '.name') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.name"
                                        wire:model="form.partners.{{ $key }}.name" placeholder="नाम">
                                    @error("form.partners.$key.name")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.name_en" class="form-label"> नाम
                                    (English)
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.name_en') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.name_en"
                                        wire:model="form.partners.{{ $key }}.name_en" placeholder="नाम (English)">
                                    @error("form.partners.$key.name_en")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.citizenship_no" class="form-label">
                                    नागरिकता
                                    नम्बर
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.citizenship_no') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.citizenship_no"
                                        wire:model="form.partners.{{ $key }}.citizenship_no"
                                        placeholder="नागरिकता नम्बर">
                                    @error("form.partners.$key.citizenship_no")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="form.partners.{{ $key }}.issue_date" class="form-label"> जारि
                                    मिति <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.issue_date') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.issue_date"
                                        wire:model="form.partners.{{ $key }}.issue_date" placeholder="जारि मिति">
                                    @error("form.partners.$key.issue_date")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="form.partners.{{ $key }}.issue_district_id" class="form-label">
                                    जारी
                                    जिल्ला
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <select
                                        class="form-select @error('form.partners.' . $key . '.issue_district_id') is-invalid @enderror"
                                        id="form.partners.{{ $key }}.issue_district_id"
                                        wire:model="form.partners.{{ $key }}.issue_district_id">
                                        <option>---जिल्ला छान्नुहोस् ----</option>
                                        @foreach (get_districts() as $district)
                                            <option value="{{ $district->id }}">{{ $district->district }}</option>
                                        @endforeach
                                    </select>
                                    @error("form.partners.$key.issue_district_id")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="form.partners.{{ $key }}.phone" class="form-label"> फोन <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.phone') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.phone"
                                        wire:model="form.partners.{{ $key }}.phone" placeholder="फोन">
                                    @error("form.partners.$key.phone")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="form.partners.{{ $key }}.email" class="form-label"> इमेल
                                </label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.email') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.email"
                                        wire:model="form.partners.{{ $key }}.email" placeholder="इमेल">
                                    @error("form.partners.$key.email")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.house_no" class="form-label"> घर नम्बर
                                </label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.house_no') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.house_no"
                                        wire:model="form.partners.{{ $key }}.house_no" placeholder="घर नम्बर">
                                    @error("form.partners.$key.house_no")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.account_no" class="form-label">
                                    व्यक्तिगत स्थाई
                                    लेखा
                                    नम्बर </label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.account_no') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.account_no"
                                        wire:model="form.partners.{{ $key }}.account_no"
                                        placeholder="व्यक्तिगत स्थाई लेखा नम्बर">
                                    @error("form.partners.$key.account_no")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.national_card_no" class="form-label">
                                    राष्ट्रियता
                                    परिचयपत्र नम्बर </label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.national_card_no') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.national_card_no"
                                        wire:model="form.partners.{{ $key }}.national_card_no"
                                        placeholder="राष्ट्रियता परिचयपत्र नम्बर">
                                    @error("form.partners.$key.national_card_no")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.gender" class="form-label">लिङ्ग
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('form.partners.' . $key . '.gender') is-invalid @enderror"
                                    id="form.partners.{{ $key }}.gender"
                                    wire:model="form.partners.{{ $key }}.gender">
                                    <option value="">---छान्नुहोस् ----</option>
                                    @foreach (\App\Enums\Gender::cases() as $case)
                                        <option value="{{ $case->value ?? '' }}">{{ $case->label() ?? '' }}</option>
                                    @endforeach
                                </select>
                                @error("form.partners.$key.gender")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.education_qualification"
                                    class="form-label">शैक्षिक
                                    योग्यता
                                    <span class="text-danger">*</span>
                                </label>
                                <select
                                    class="form-select @error('form.partners.' . $key . '.education_qualification') is-invalid @enderror"
                                    id="form.partners.{{ $key }}.education_qualification"
                                    wire:model="form.partners.{{ $key }}.education_qualification">
                                    <option value="">---छान्नुहोस् ----</option>
                                    @foreach (\Modules\BusinessRegistration\Enums\Qualification::cases() as $qualification)
                                        <option value="{{ $qualification->value ?? '' }}">
                                            {{ $qualification->label() ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("form.partners.$key.education_qualification")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.occupation" class="form-label"> मुख्य
                                    पेशा
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.occupation') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.occupation"
                                        wire:model="form.partners.{{ $key }}.occupation" placeholder="मुख्य पेशा">
                                    @error("form.partners.$key.occupation")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.father_name" class="form-label"> बुबाको
                                    नाम
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.father_name') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.father_name"
                                        wire:model="form.partners.{{ $key }}.father_name" placeholder="बुबाको नाम">
                                    @error("form.partners.$key.father_name")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.grandfather_name" class="form-label">
                                    हजुरबुबाको नाम
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.grandfather_name') is-invalid @enderror"
                                        type="text" id="form.partners.{{ $key }}.grandfather_name"
                                        wire:model="form.partners.{{ $key }}.grandfather_name"
                                        placeholder="हजुरबुबाको नाम">
                                    @error("form.partners.$key.grandfather_name")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.photo" class="form-label"> पासपोर्ट
                                    साइजको फोटो
                                </label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.photo') is-invalid @enderror"
                                        type="file" id="form.partners.{{ $key }}.photo"
                                        wire:model="form.partners.{{ $key }}.photo">
                                    @error("form.partners.$key.photo")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="form.partners.{{ $key }}.signature" class="form-label">
                                    हस्ताक्षर
                                </label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.signature') is-invalid @enderror"
                                        type="file" id="form.partners.{{ $key }}.signature"
                                        wire:model="form.partners.{{ $key }}.signature">
                                    @error("form.partners.$key.signature")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="form.partners.{{ $key }}.citizenship_front" class="form-label">
                                    नागरिकता
                                    अपलोड
                                    गर्नुहोस् (आगाडी) </label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.citizenship_front') is-invalid @enderror"
                                        type="file" id="form.partners.{{ $key }}.citizenship_front"
                                        wire:model="form.partners.{{ $key }}.citizenship_front">
                                    @error("form.partners.$key.citizenship_front")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="form.partners.{{ $key }}.citizenship_back" class="form-label">
                                    नागरिकता
                                    अपलोड
                                    गर्नुहोस् (पछाडी) </label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.citizenship_back') is-invalid @enderror"
                                        type="file" id="form.partners.{{ $key }}.citizenship_back"
                                        wire:model="form.partners.{{ $key }}.citizenship_back">
                                    @error("form.partners.$key.citizenship_back")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 mb-1">
                                <label for="form.partners.{{ $key }}.position" class="form-label">
                                    मर्यादाक्रम <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input
                                        class="form-control @error('form.partners.' . $key . '.position') is-invalid @enderror"
                                        type="number" placeholder="मर्यादाक्रम "
                                        id="form.partners.{{ $key }}.position"
                                        wire:model="form.partners.{{ $key }}.position">
                                    @error("form.partners.$key.position")
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            @error('form.partners')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend class="title text-primary fs-4 fw-bolder">ठेगाना</legend>
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.province_id" class="form-label">प्रदेश</label>
                                <select
                                    class="form-select @error('form.partners.' . $key . '.province_id') is-invalid @enderror"
                                    id="form.partners.{{ $key }}.province_id"
                                    wire:model="form.partners.{{ $key }}.province_id">
                                    <option value="">---प्रदेश छान्नुहोस् ----</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id ?? '' }}">{{ $province->province ?? '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("form.partners.$key.province_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.district_id" class="form-label">जिल्ला</label>
                                <select
                                    class="form-select @error('form.partners.' . $key . '.district_id') is-invalid @enderror"
                                    id="form.partners.{{ $key }}.district_id"
                                    wire:model="form.partners.{{ $key }}.district_id">
                                    <option value="">---जिल्ला छान्नुहोस् ----</option>
                                    @foreach (!empty($form['partners'][$key]['province_id']) ? get_districts(province_ids: $form['partners'][$key]['province_id']) : [] as $district)
                                        <option value="{{ $district->id }}">{{ $district->district }}</option>
                                    @endforeach
                                </select>
                                @error("form.partners.$key.district_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.local_body_id"
                                    class="form-label">पालिका</label>
                                <select
                                    class="form-select @error('form.partners.' . $key . '.local_body_id') is-invalid @enderror"
                                    id="form.partners.{{ $key }}.local_body_id"
                                    wire:model="form.partners.{{ $key }}.local_body_id">
                                    <option value="">---पालिका छान्नुहोस् ----</option>
                                    @foreach (!empty($form['partners'][$key]['district_id']) ? get_local_bodies(district_ids: $form['partners'][$key]['district_id']) : [] as $localBody)
                                        <option value="{{ $localBody->id }}">{{ $localBody->local_body }}</option>
                                    @endforeach
                                </select>
                                @error("form.partners.$key.local_body_id")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.ward_no" class="form-label">वार्ड
                                    न:</label>
                                <select class="form-select @error('form.partners.' . $key . '.ward_no') is-invalid @enderror"
                                    id="form.partners.{{ $key }}.ward_no"
                                    wire:model="form.partners.{{ $key }}.ward_no">
                                    <option value="">---वडा छान्नुहोस् ----</option>
                                    @foreach (!empty($form['partners'][$key]['local_body_id']) ? get_local_bodies(localBodyId: $form['partners'][$key]['local_body_id'])->ward_no : [] as $ward)
                                        <option value="{{ $ward }}">{{ $ward }}</option>
                                    @endforeach
                                </select>
                                @error("form.partners.$key.ward_no")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.way" class="form-label">मार्ग</label>
                                <input name="form.way"
                                    class="form-control @error('form.partners.' . $key . '.way') is-invalid @enderror"
                                    type="text" id="form.partners.{{ $key }}.way" placeholder="मार्ग"
                                    wire:model="form.partners.{{ $key }}.way" />

                                @error("form.partners.$key.way")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="form.partners.{{ $key }}.tole" class="form-label">गाउँ/टोल</label>
                                <input name="form.partners.{{ $key }}.tole"
                                    class="form-control @error('form.partners.' . $key . '.tole') is-invalid @enderror"
                                    type="text" id="form.partners.{{ $key }}.tole" placeholder="गाउँ/टोल"
                                    wire:model="form.partners.{{ $key }}.tole" />
                                @error("form.partners.$key.tole")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    @if (!$loop->first)
                        <button class="btn btn-danger" wire:click.prevent="partnerArrayDecrement({{ $key }})">
                            <i class="fa fa-minus"></i>
                        </button>
                    @endif
                    @if ($loop->last)
                        <button type="button" wire:click.prevent="partnerArrayIncrement" class="btn btn-info">
                            <i class="fa fa-plus"></i>
                        </button>
                    @endif
                    @if (!$loop->last)
                        <hr>
                    @endif
                @endforeach
                <div class="mt-3">
                    <span class="next d-flex justify-content-around">
                        <button type="button" wire:click.prevent="backStep(1)" class="btn btn-info">
                            <i class="fa fa-arrow-circle-left"></i> पछाडि
                        </button>
                        <button type="button" wire:click.prevent="nextStep(3)" class="btn btn-info">
                            अर्को <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </span>
                </div>
            @break

            @default
                <fieldset>
                    <legend class="title text-primary fs-4 fw-bolder">व्यवसाय दर्ता विवरण</legend>
                    <div class="row">
                        <div class="col-md-12 mb-2 pr-0">
                            <label for="name" class="form-label">व्यवसायको नाम <span class="text-danger">*</span></label>
                            <div class="row input-group">
                                <div class="col-md-6 pr-0">
                                    <input class="form-control @error('form.name') is-invalid @enderror" type="text"
                                        id="name" wire:model="form.name" placeholder="नेपालीमा">
                                    @error('form.name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 pr-0">
                                    <input class="form-control @error('form.name_en') is-invalid @enderror" type="text"
                                        id="name_en" wire:model="form.name_en" placeholder="In English">
                                    @error('form.name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="address" class="form-label">ठेगाना <span class="text-danger">*</span></label>
                            <div class="row input-group">
                                <div class="col-md-6 mb-2 pr-0">
                                    <input class="form-control @error('form.address') is-invalid @enderror" type="text"
                                        id="address" wire:model="form.address" placeholder="ठेगाना">
                                    @error('form.address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2 pr-0">
                                    <input class="form-control @error('form.address_en') is-invalid @enderror" type="text"
                                        id="address_en" wire:model="form.address_en" placeholder="In English"
                                        @error('form.address_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                        </div>
                                </div>

                                <div class="col-md-6 mb-2">
                                    <label for="form.business_nature_id" class="form-label">व्यवसायको प्रकृति<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('form.business_nature_id') is-invalid @enderror"
                                        id="form.business_nature_id" wire:model="form.business_nature_id">
                                        <option value="">---छान्नुहोस् ----</option>
                                        @foreach ($businessNatures as $businessNature)
                                            <option value="{{ $businessNature->id ?? '' }}">
                                                {{ $businessNature->title ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('form.business_nature_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="form.object_transaction_id" class="form-label">व्यवसायको कारोबार गर्ने
                                        मुख्य
                                        सेवा वा
                                        बस्तु</label>
                                    <select class="form-select @error('form.object_transaction_id') is-invalid @enderror"
                                        id="form.object_transaction_id" wire:model="form.object_transaction_id">
                                        <option value="">---छान्नुहोस् ----</option>
                                        @foreach ($objectTransactions as $objectTransaction)
                                            <option value="{{ $objectTransaction->id ?? '' }}"
                                                @if ($objectTransaction->objectTransactions->count() > 0) disabled @endif>
                                                {{ $objectTransaction->title ?? '' }}</option>
                                            @foreach ($objectTransaction->objectTransactions as $objectTransactionData)
                                                <option value="{{ $objectTransactionData->id ?? '' }}">
                                                    --{{ $objectTransactionData->title ?? '' }}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('form.object_transaction_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="working_capital" class="form-label">चालु पूँजी </label>
                                    <div class="input-group">
                                        <input class="form-control @error('form.working_capital') is-invalid @enderror"
                                            type="number" step="any" id="working_capital"
                                            wire:model="form.working_capital" placeholder="चालु पूँजी">
                                        @error('form.working_capital')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="fixed_capital" class="form-label">स्थिर पूँजी </label>
                                    <div class="input-group">
                                        <input class="form-control @error('form.fixed_capital') is-invalid @enderror"
                                            type="number" step="any" id="fixed_capital" wire:model="form.fixed_capital"
                                            placeholder="स्थिर पूँजी">
                                        @error('form.fixed_capital')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="investment" class="form-label">पूँजीगत लगानी <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input class="form-control @error('form.investment') is-invalid @enderror"
                                            type="number" step="any" id="investment" wire:model="form.investment"
                                            placeholder="पूँजीगत लगानी">
                                        @error('form.investment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label for="purpose" class="form-label">उद्देश्य
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <textarea id="purpose" wire:model="form.purpose" placeholder="उद्देश्य"
                                            class="form-control @error('form.purpose') is-invalid @enderror"></textarea>
                                    </div>
                                    @error('form.purpose')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                </fieldset>
                <fieldset>
                    <legend class="title text-primary fs-4 fw-bolder">ठेगाना</legend>
                    <div class="row">
                        <div class="col-md-4 mb-1">
                            <label for="form.province_id" class="form-label">प्रदेश</label>
                            <select class="form-select @error('form.province_id') is-invalid @enderror" id="form.province_id"
                                wire:model="form.province_id" disabled>
                                <option value="">---प्रदेश छान्नुहोस् ----</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province->id ?? '' }}">{{ $province->province ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('form.province_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="form.district_id" class="form-label">जिल्ला</label>
                            <select class="form-select @error('form.district_id') is-invalid @enderror" id="form.district_id"
                                wire:model="form.district_id" disabled>
                                <option value="">---जिल्ला छान्नुहोस् ----</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->district }}</option>
                                @endforeach
                            </select>
                            @error('form.district_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="form.local_body_id" class="form-label">पालिका</label>
                            <select class="form-select @error('form.local_body_id') is-invalid @enderror"
                                id="form.local_body_id" wire:model="form.local_body_id" disabled>
                                <option value="">---पालिका छान्नुहोस् ----</option>
                                @foreach ($localBodies as $localBody)
                                    <option value="{{ $localBody->id }}">{{ $localBody->local_body }}</option>
                                @endforeach
                            </select>
                            @error('form.local_body_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="ward_no" class="form-label">वार्ड न:</label>
                            <select class="form-select @error('form.ward_no') is-invalid @enderror" id="ward_no"
                                wire:model="form.ward_no">
                                <option value="">---वडा छान्नुहोस् ----</option>
                                @foreach ($wards as $ward)
                                    <option value="{{ $ward }}">{{ $ward }}</option>
                                @endforeach
                            </select>
                            @error('form.ward_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="form.way" class="form-label">मार्ग</label>
                            <input name="form.way" class="form-control @error('form.way') is-invalid @enderror"
                                type="text" id="form.way" placeholder="मार्ग" wire:model="form.way" />

                            @error('form.way')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="form.tole" class="form-label">गाउँ/टोल</label>
                            <input name="form.tole" class="form-control @error('form.tole') is-invalid @enderror"
                                type="text" id="form.tole" placeholder="गाउँ/टोल" wire:model="form.tole" />
                            @error('form.tole')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </fieldset>
                <div class="row mt-2 container">
                    <div class="col-md-6 mb-2">
                        <h5>
                            <label for="complaint_severity" class="form-label">
                                व्यवसाय तथा घर बहालमा ?
                            </label>
                        </h5>
                        <div class="d-flex">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" value="1" wire:model="form.is_rent"
                                    id="yes">
                                <label class="form-check-label" for="yes">छ &nbsp;</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" wire:model="form.is_rent" value="0"
                                    id="no">
                                <label class="form-check-label" for="no">छैन &nbsp;</label>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($form['is_rent'] == '1')
                    <fieldset>
                        <legend class="title text-primary fs-4 fw-bolder">घर मालिक विवरण</legend>
                        <div class="row">
                            <div class="col-md-4 mb-1">
                                <label for="house_owner_name" class="form-label"> नाम <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input class="form-control @error('form.house_owner_name') is-invalid @enderror"
                                        type="text" id="house_owner_name" wire:model="form.house_owner_name"
                                        placeholder="नाम">
                                    @error('form.house_owner_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="house_owner_phone" class="form-label"> फोन </label>
                                <div class="input-group">
                                    <input class="form-control @error('form.house_owner_phone') is-invalid @enderror"
                                        type="text" id="house_owner_phone" wire:model="form.house_owner_phone"
                                        placeholder="फोन">
                                    @error('form.house_owner_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="house_owner_address" class="form-label"> ठेगाना </label>
                                <div class="input-group">
                                    <input class="form-control @error('form.house_owner_address') is-invalid @enderror"
                                        type="text" id="house_owner_address" wire:model="form.house_owner_address"
                                        placeholder=" ठेगाना">
                                    @error('form.house_owner_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="house_owner_monthly_rent" class="form-label"> मासिक भाडा <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input class="form-control @error('form.house_owner_monthly_rent') is-invalid @enderror"
                                        type="text" id="house_owner_monthly_rent"
                                        wire:model="form.house_owner_monthly_rent" placeholder="मासिक भाडा">
                                    @error('form.house_owner_monthly_rent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 mb-1">
                                <label for="rent_agreement" class="form-label"> भाडा सम्झौता </label>
                                <div class="input-group">
                                    <input class="form-control @error('form.rent_agreement') is-invalid @enderror"
                                        type="file" id="rent_agreement" wire:model="form.rent_agreement">
                                    @error('form.rent_agreement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </fieldset>
                @endif
                <div class="row mt-2 container">
                    <div class="col-md-12 mb-2">
                        <h5>
                            <label for="complaint_severity" class="form-label">
                                यो भन्दा अगाडी कुनै व्यवसाय दर्ता ?
                            </label>
                        </h5>
                        <div class="d-flex">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" value="1" wire:model="form.is_register"
                                    id="is_register_yes">
                                <label class="form-check-label" for="is_register_yes">छ &nbsp;</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" wire:model="form.is_register" value="0"
                                    id="is_register_no">
                                <label class="form-check-label" for="is_register_no">छैन &nbsp;</label>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($form['is_register'] == '1')
                    <div class="container-fluid">
                        <div class="row">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>व्यवसाय नाम</th>
                                        <th>दर्ता नम्बर</th>
                                        <th>दर्ता मिति</th>
                                        <th>सक्रिय</th>
                                        <th>
                                            <button type="button" class="btn btn-outline-secondary btn-sm"
                                                wire:click="registeredBusinessArrayIncrement">
                                                <i class="fa fa-plus-circle"></i>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($form['registeredBusinesses'] as $key => $registeredBusiness)
                                        <tr>
                                            <td>
                                                <input
                                                    class="form-control @error('form.registeredBusinesses.' . $key . '.business_name') is-invalid @enderror"
                                                    type="text" placeholder="व्यवसाय नाम"
                                                    id="form.registeredBusinesses.{{ $key }}.business_name"
                                                    wire:model="form.registeredBusinesses.{{ $key }}.business_name">
                                                @error("form.registeredBusinesses.$key.business_name")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input
                                                    class="form-control @error('form.registeredBusinesses.' . $key . '.registration_no') is-invalid @enderror"
                                                    type="text" placeholder="दर्ता नम्बर"
                                                    id="form.registeredBusinesses.{{ $key }}.registration_no"
                                                    wire:model="form.registeredBusinesses.{{ $key }}.registration_no">
                                                @error("form.registeredBusinesses.$key.registration_no")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <input
                                                    class="form-control @error('form.registeredBusinesses.' . $key . '.registration_date') is-invalid @enderror"
                                                    type="text" placeholder="दर्ता मिति"
                                                    id="form.registeredBusinesses.{{ $key }}.registration_date"
                                                    wire:model="form.registeredBusinesses.{{ $key }}.registration_date">
                                                @error("form.registeredBusinesses.$key.registration_date")
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input" value="1"
                                                            wire:model="form.registeredBusinesses.{{ $key }}.is_active"
                                                            id="{{ $key }}.is_active">
                                                        <label class="form-check-label"
                                                            for="{{ $key }}.is_active">छ
                                                            &nbsp;</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input"
                                                            wire:model="form.registeredBusinesses.{{ $key }}.is_active"
                                                            value="0" id="{{ $key }}.in_active">
                                                        <label class="form-check-label"
                                                            for="{{ $key }}.in_active">छैन
                                                            &nbsp;</label>
                                                    </div>
                                                    @error("form.registeredBusinesses.$key.is_active")
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    wire:click="registeredBusinessArrayDecrement({{ $key }})">
                                                    <i class="fa fa-minus-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @error('form.registeredBusinesses')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                <ul class="list-inline wizard mt-3">
                    <li class="next d-flex justify-content-end">
                        <button type="button" wire:click.prevent="nextStep(2)" class="btn btn-primary fs-5">
                            अर्को <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </li>
                </ul>
        @endswitch
    </form>
</div>
<style>
    .nav-link {
        background-color: #f5f5f5 !important;
    }

    fieldset {
        border-color: #ccc !important;
        border-width: 1px;
        padding: 25px;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 3px !important;
        font-size: 15px;
        color: #333;
    }
</style>
