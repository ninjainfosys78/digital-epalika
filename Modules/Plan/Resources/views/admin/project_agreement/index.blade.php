@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.project.index') }}">
                                योजनाहरु
                            </a>
                        </li>
                        <li class="breadcrumb-item active"> योजना सम्झौता</li>
                    </ol>
                </div>
                <h4 class="page-title"> योजना सम्झौता</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">
                        योजना सम्झौता
                    </h4>
                    <a href="{{ route('admin.plan.project.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> योजना/कार्यक्रमहरू
                    </a>
                </div>
                <div class="card-body px-0">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="col-md-4 mb-2">
                        <label for="operated_through_change" class="form-label">खरिद बिधि *</label>
                        <select name="operated_through_change" class="form-select" id="operated_through_change" required
                            {{ $project->operated_through ? 'disabled' : '' }}>
                            <option value="">--- खरिद बिधि छान्नुहोस् ---</option>
                            @foreach (\Modules\Plan\Enums\ProjectOperatedThroughEnum::cases() as $operatedThrough)
                                <option
                                    {{ old('operated_through_change', $project->operated_through) == $operatedThrough ? 'selected' : '' }}
                                    value="{{ $operatedThrough->value }}">
                                    {{ $operatedThrough->label() }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <form id="bid-form" class="d-none"
                        action="{{ route('admin.plan.project.projectAgreement.bid-detail', $project) }}" method="post">
                        @csrf
                        <input type="hidden" name="operated_through" id="operated_through_bid">
                        <fieldset class="mb-2">
                            <legend>योजना सम्झौता मिति</legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="contract_date" labelNe="सम्झौता मिति *"
                                        :getTodayDate="false" :editDateNe="$project->contract_date ?? ''" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="project_start_date" labelNe="आयोजना सुरु हुने मिति *"
                                        :getTodayDate="false" :editDateNe="$project->project_start_date ?? ''" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="project_completion_date"
                                        labelNe="आयोजना सम्पन्न हुने मिति *" :getTodayDate="false" :editDateNe="$project->project_completion_date ?? ''" />
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mb-2">
                            <legend>बोलपत्र(टेन्डर)</legend>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="bid_no" class="form-label">बोलपत्र नं.</label>
                                    <input type="text" name="bid_no"
                                        value="{{ old('bid_no', $project->projectBidDetail->bid_no ?? '') }}"
                                        class="form-control @error('bid_no') is-invalid @enderror" id="bid_no"
                                        placeholder="बोलपत्र नं." />
                                    @error('bid_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="cost_estimation" class="form-label">कार्यालयको स्वीकृत विभागिय लागत
                                        अनुमान</label>
                                    <input type="number" name="cost_estimation"
                                        value="{{ old('cost_estimation', $project->projectBidDetail->cost_estimation ?? '') }}"
                                        class="form-control @error('cost_estimation') is-invalid @enderror"
                                        id="cost_estimation" placeholder="कार्यालयको स्वीकृत विभागिय लागत अनुमान"
                                        required />
                                    @error('cost_estimation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <x-date-input-component nameNe="notice_published_date"
                                        labelNe="बोलपत्रको सुचना प्रकाशित मिति *" :getTodayDate="false" :editDateNe="$project->projectBidDetail->notice_published_date ?? ''" />
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="newspaper_name" class="form-label">पत्रिकाको नाम</label>
                                    <input type="text" name="newspaper_name"
                                        value="{{ old('newspaper_name', $project->projectBidDetail->newspaper_name ?? '') }}"
                                        class="form-control @error('newspaper_name') is-invalid @enderror"
                                        id="newspaper_name" placeholder="पत्रिकाको नाम" required />
                                    @error('newspaper_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mb-2">
                            <legend>ठेक्का विवरण</legend>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <x-date-input-component nameNe="contract_evaluation_decision_date"
                                        labelNe="ठेक्का मुल्यांकनको निर्णय मिति" :getTodayDate="false" :editDateNe="$project->projectBidDetail->contract_evaluation_decision_date ?? ''" />
                                </div>
                                <div class="col-md-3 mb-2">
                                    <x-date-input-component nameNe="intent_notice_publish_date"
                                        labelNe="आशयको सुचना प्रकाशित मिति" :getTodayDate="false" :editDateNe="$project->projectBidDetail->intent_notice_publish_date ?? ''" />
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="contract_newspaper_name" class="form-label">पत्रिकाको नाम</label>
                                    <input type="text" name="contract_newspaper_name"
                                        value="{{ old('contract_newspaper_name', $project->projectBidDetail->contract_newspaper_name ?? '') }}"
                                        class="form-control @error('contract_newspaper_name') is-invalid @enderror"
                                        id="contract_newspaper_name" placeholder="पत्रिकाको नाम" />
                                    @error('contract_newspaper_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <x-date-input-component nameNe="contract_acceptance_decision_date"
                                        labelNe="ठेक्का स्वीकृतीको निर्णय मिति" :getTodayDate="false" :editDateNe="$project->projectBidDetail->contract_acceptance_decision_date ?? ''" />
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="contract_percentage" class="form-label">ठेक्का विलो प्रतिशत</label>
                                    <input type="number" name="contract_percentage"
                                        value="{{ old('contract_percentage', $project->projectBidDetail->contract_percentage ?? '') }}"
                                        class="form-control @error('contract_percentage') is-invalid @enderror"
                                        id="contract_percentage" placeholder="ठेक्का विलो प्रतिशत" required />
                                    @error('contract_percentage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="contractor_name" class="form-label">कम्पनीको नाम</label>
                                    <input type="text" name="contractor_name"
                                        value="{{ old('contractor_name', $project->projectBidDetail->contractor_name ?? '') }}"
                                        class="form-control @error('contractor_name') is-invalid @enderror"
                                        id="contractor_name" placeholder="कम्पनीको नाम" />
                                    @error('contractor_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="contractor_address" class="form-label">कम्पनीको ठेगाना</label>
                                    <input type="text" name="contractor_address"
                                        value="{{ old('contractor_name', $project->projectBidDetail->contractor_name ?? '') }}"
                                        class="form-control @error('contractor_address') is-invalid @enderror"
                                        id="contractor_address" placeholder="कम्पनीको ठेगाना" />
                                    @error('contractor_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="contractor_phone" class="form-label">सम्पर्क नम्बर</label>
                                    <input type="text" name="contractor_phone"
                                        value="{{ old('contractor_phone', $project->projectBidDetail->contractor_phone ?? '') }}"
                                        class="form-control @error('contractor_phone') is-invalid @enderror"
                                        id="contractor_phone" placeholder="सम्पर्क नम्बर" />
                                    @error('contractor_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="confession_number" class="form-label">कबोल अंक</label>
                                    <input type="text" name="confession_number"
                                        value="{{ old('confession_number', $project->projectBidDetail->confession_number ?? '') }}"
                                        class="form-control @error('confession_number') is-invalid @enderror"
                                        id="confession_number" placeholder="कबोल अंक" />
                                    @error('confession_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-2">
                                    <x-date-input-component nameNe="contract_agreement_date" labelNe="ठेक्का सम्झौता मिति"
                                        :getTodayDate="false" :editDateNe="$project->projectBidDetail->contract_agreement_date ?? ''" />
                                </div>
                                <div class="col-md-3 mb-2">
                                    <x-date-input-component nameNe="contract_assigned_date" labelNe="कार्यादेशको मिति"
                                        :getTodayDate="false" :editDateNe="$project->projectBidDetail->contract_assigned_date ?? ''" />
                                </div>
                            </div>
                        </fieldset>
                        @if ($project->operated_through == \Modules\Plan\Enums\ProjectOperatedThroughEnum::BID)
                            <fieldset class="mb-2">
                                <legend>विडवण्ड/परफरमेन्स विवरण</legend>
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <label for="bid_bond_amount" class="form-label">विडवण्ड रकम</label>
                                        <input type="number" name="bid_bond_amount"
                                            value="{{ old('bid_bond_amount', $project->projectBidDetail->bid_bond_amount ?? 0) }}"
                                            class="form-control @error('bid_bond_amount') is-invalid @enderror"
                                            id="bid_bond_amount" placeholder="विडवण्ड रकम" />
                                        @error('bid_bond_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="bid_bond_no" class="form-label">विडवण्ड नं.</label>
                                        <input type="number" name="bid_bond_no"
                                            value="{{ old('bid_bond_no', $project->projectBidDetail->bid_bond_no ?? 0) }}"
                                            class="form-control @error('bid_bond_no') is-invalid @enderror"
                                            id="bid_bond_no" placeholder="विडवण्ड नं." />
                                        @error('bid_bond_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="bid_bond_bank_name" class="form-label">विडवण्ड बैंकको
                                            नाम</label>
                                        <input type="text" name="bid_bond_bank_name"
                                            value="{{ old('bid_bond_bank_name', $project->projectBidDetail->bid_bond_bank_name ?? '') }}"
                                            class="form-control @error('bid_bond_bank_name') is-invalid @enderror"
                                            id="bid_bond_bank_name" placeholder="विडवण्ड बैंकको नाम" />
                                        @error('bid_bond_bank_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <x-date-input-component nameNe="bid_bond_issue_date" labelNe="विडवण्ड जारी मिति"
                                            :getTodayDate="false" :editDateNe="$project->projectBidDetail->bid_bond_issue_date ?? ''" />
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <x-date-input-component nameNe="bid_bond_expiry_date"
                                            labelNe="विडवण्ड म्याद सकिने मिति" :getTodayDate="false" :editDateNe="$project->projectBidDetail->bid_bond_expiry_date ?? ''" />
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="performance_bond_no" class="form-label">परफरमेन्स वण्ड
                                            नं.</label>
                                        <input type="number" name="performance_bond_no"
                                            value="{{ old('performance_bond_no', $project->projectBidDetail->performance_bond_no ?? 0) }}"
                                            class="form-control @error('performance_bond_no') is-invalid @enderror"
                                            id="performance_bond_no" placeholder="परफरमेन्स वण्ड नं." />
                                        @error('performance_bond_no')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="performance_bond_amount" class="form-label">परफरमेन्स वण्ड
                                            रकम</label>
                                        <input type="number" name="performance_bond_amount"
                                            value="{{ old('performance_bond_amount', $project->projectBidDetail->performance_bond_amount ?? 0) }}"
                                            class="form-control @error('performance_bond_amount') is-invalid @enderror"
                                            id="performance_bond_amount" placeholder="परफरमेन्स वण्ड रकम" />
                                        @error('performance_bond_amount')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <label for="performance_bond_bank" class="form-label">परफरमेन्स वण्ड बैंकको
                                            नाम</label>
                                        <input type="text" name="performance_bond_bank"
                                            value="{{ old('performance_bond_bank', $project->projectBidDetail->performance_bond_bank ?? '') }}"
                                            class="form-control @error('performance_bond_bank') is-invalid @enderror"
                                            id="performance_bond_bank" placeholder="परफरमेन्स वण्ड बैंकको नाम" />
                                        @error('performance_bond_bank')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <x-date-input-component nameNe="performance_bond_issue_date"
                                            labelNe="परफरमेन्स वण्ड जारी मिति" :getTodayDate="false" :editDateNe="$project->projectBidDetail->performance_bond_issue_date ?? ''" />
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <x-date-input-component nameNe="performance_bond_expiry_date"
                                            labelNe="परफरमेन्स वण्ड म्याद सकिने मिति" :getTodayDate="false"
                                            :editDateNe="$project->projectBidDetail->performance_bond_expiry_date ?? ''" />
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <x-date-input-component nameNe="performance_bond_extended_date"
                                            labelNe="परफरमेन्स वण्ड म्याद थपको मिति" :getTodayDate="false"
                                            :editDateNe="$project->projectBidDetail->performance_bond_extended_date ?? ''" />
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mb-2">
                                <legend> इन्स्योरेन्स विवरण</legend>
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <x-date-input-component nameNe="insurance_issue_date"
                                            labelNe="इन्स्योरेन्स जारी मिति" :getTodayDate="false" :editDateNe="$project->projectBidDetail->insurance_issue_date ?? ''" />
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <x-date-input-component nameNe="insurance_expiry_date"
                                            labelNe="इन्स्योरेन्स सकिने मिति" :getTodayDate="false" :editDateNe="$project->projectBidDetail->insurance_expiry_date ?? ''" />
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <x-date-input-component nameNe="insurance_extended_date"
                                            labelNe="इन्स्योरेन्स म्याद थप हुने मिति" :getTodayDate="false"
                                            :editDateNe="$project->projectBidDetail->insurance_extended_date ?? ''" />
                                    </div>
                                </div>
                            </fieldset>
                        @endif
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                    <form id="consumer-committee-form" class="d-none"
                        action="{{ route('admin.plan.project.projectAgreement.consumer-committee', $project) }}"
                        method="post">
                        @csrf
                        <input type="hidden" name="operated_through" id="operated_through_consumer_committee">
                        <fieldset class="mb-2">
                            <legend>योजना सम्झौता मिति</legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="contract_date" labelNe="सम्झौता मिति *"
                                        :getTodayDate="false" id-ne="contract_date_consumer" :editDateNe="$project->contract_date ?? ''" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="project_start_date" labelNe="आयोजना सुरु हुने मिति *"
                                        :getTodayDate="false" id-ne="project_start_date_consumer" :editDateNe="$project->project_start_date ?? ''" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="project_completion_date"
                                        labelNe="आयोजना सम्पन्न हुने मिति *" :getTodayDate="false"
                                        id-ne="project_completion_date_consumer" :editDateNe="$project->project_completion_date ?? ''" />
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mb-2">
                            <legend>उपभोक्त्ता समितिको विवरण</legend>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="name" class="form-label">उपभोक्त्ता समितिको नाम *</label>
                                    <input type="text" name="name"
                                        value="{{ old('name', $project->consumerCommittee->name ?? '') }}"
                                        class="form-control @error('name') is-invalid @enderror" id="name" required
                                        placeholder="उपभोक्त्ता समितिको नाम" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="address" class="form-label">ठेगाना *</label>
                                    <input type="text" name="address"
                                        value="{{ old('address', $project->consumerCommittee->address ?? '') }}"
                                        class="form-control @error('address') is-invalid @enderror" id="address"
                                        placeholder="ठेगाना" />
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="phone" class="form-label">सम्पर्क नं. *</label>
                                    <input type="text" name="phone"
                                        value="{{ old('phone', $project->consumerCommittee->phone ?? '') }}"
                                        class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        placeholder="सम्पर्क नं." />
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="formation_date" labelNe="गठन भएको मिति *"
                                        :getTodayDate="false" :editDateNe="$project->formation_date ?? ''" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="committee_registration_date"
                                        labelNe="समिती दर्ता मिति" :getTodayDate="false" :editDateNe="$project->committee_registration_date ?? ''" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <x-date-input-component nameNe="meeting_date" labelNe="बैठक बसेको मिति"
                                        :getTodayDate="false" :editDateNe="$project->meeting_date ?? ''" />
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="registration_no" class="form-label">समिती दर्ता नं. *</label>
                                    <input type="text" name="registration_no"
                                        value="{{ old('registration_no', $project->consumerCommittee->registration_no ?? '') }}"
                                        class="form-control @error('registration_no') is-invalid @enderror" required
                                        id="registration_no" placeholder="समिती दर्ता नं." />
                                    @error('registration_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="beneficiary_no" class="form-label">गठन गर्दा उपस्थित लाभान्वितको
                                        संख्या</label>
                                    <input type="number" name="beneficiary_no"
                                        value="{{ old('beneficiary_no', $project->consumerCommittee->beneficiary_no ?? '') }}"
                                        class="form-control @error('beneficiary_no') is-invalid @enderror" required
                                        id="beneficiary_no" placeholder="गठन गर्दा उपस्थित लाभान्वितको संख्या" />
                                    @error('beneficiary_no')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="experience_in_project" class="form-label">आयोजना संचालन सम्बन्धी
                                        अनुभव</label>
                                    <input type="text" name="experience_in_project"
                                        value="{{ old('experience_in_project', $project->consumerCommittee->experience_in_project ?? '') }}"
                                        class="form-control @error('experience_in_project') is-invalid @enderror"
                                        id="experience_in_project" placeholder="आयोजना संचालन सम्बन्धी अनुभव" />
                                    @error('experience_in_project')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="mb-2">
                            <legend>उपभोक्ता समिति</legend>
                            <div class="d-flex align-items-center justify-content-between mb-1">
                                <label for="budget" class="form-label fw-bold">सदस्य विवरण <span
                                        class="text-danger">*</span></label>
                                <button type="button" class="btn btn-xs btn-outline-info" data-target-element="budget"
                                    data-toggle="add-more">
                                    <i class="fas fa-plus-circle"></i> नयाँ थप्नुहोस्
                                </button>
                            </div>
                            <div id="budget">
                                @forelse($project->consumerCommittee?->consumerCommitteeOfficials ?? collect() as $key=>$consumerCommitteeOfficial)
                                    <div class="main">
                                        <div class="text-end">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-toggle="remove-parent" data-parent=".main"
                                                data-target-element="budget">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="row border-bottom mb-2">
                                            <input type="hidden"
                                                name="consumerCommitteeOfficials[{{ $key }}][id]"
                                                value="{{ $consumerCommitteeOfficial->id }}">
                                            <div class="col-md-4 mb-2">
                                                <label for="post" class="form-label">पद *</label>
                                                <select name="consumerCommitteeOfficials[{{ $key }}][post]"
                                                    class="form-select">
                                                    <option value="">छान्नुहोस्</option>
                                                    @foreach (\Modules\Plan\Enums\ConsumerCommitteePostEnum::cases() as $post)
                                                        <option
                                                            {{ $post == $consumerCommitteeOfficial->post ? 'selected' : '' }}
                                                            value="{{ $post->value }}">
                                                            {{ $post->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="name" class="form-label">नाम थर *</label>
                                                <input type="text"
                                                    name="consumerCommitteeOfficials[{{ $key }}][name]"
                                                    value="{{ $consumerCommitteeOfficial->name }}" class="form-control"
                                                    placeholder="नाम थर" />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="phone" class="form-label">सम्पर्क नं.</label>
                                                <input type="text"
                                                    name="consumerCommitteeOfficials[{{ $key }}][phone]"
                                                    value="{{ $consumerCommitteeOfficial->phone }}" class="form-control"
                                                    placeholder="सम्पर्क नं." />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="citizenship_no" class="form-label">नागरिकता नं.</label>
                                                <input type="text"
                                                    name="consumerCommitteeOfficials[{{ $key }}][citizenship_no]"
                                                    value="{{ $consumerCommitteeOfficial->citizenship_no }}"
                                                    class="form-control" placeholder="नागरिकता नं." />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="gender" class="form-label">लिङ्ग</label>
                                                <select name="consumerCommitteeOfficials[{{ $key }}][gender]"
                                                    class="form-select">
                                                    <option value="">छान्नुहोस्</option>
                                                    @foreach (\App\Enums\Gender::cases() as $gender)
                                                        <option
                                                            {{ $gender == $consumerCommitteeOfficial->gender ? 'selected' : '' }}
                                                            value="{{ $gender->value }}">
                                                            {{ $gender->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="address" class="form-label">ठेगाना</label>
                                                <input type="text"
                                                    name="consumerCommitteeOfficials[{{ $key }}][address]"
                                                    value="{{ $consumerCommitteeOfficial->address }}"
                                                    class="form-control" placeholder="ठेगाना" />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="father_name" class="form-label">बुवा/पतिको नाम</label>
                                                <input type="text"
                                                    name="consumerCommitteeOfficials[{{ $key }}][father_name]"
                                                    value="{{ $consumerCommitteeOfficial->father_name }}"
                                                    class="form-control" placeholder="बुवा/पतिको नाम" />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="grandfather_name" class="form-label">बाजेको नाम</label>
                                                <input type="text"
                                                    name="consumerCommitteeOfficials[{{ $key }}][grandfather_name]"
                                                    value="{{ $consumerCommitteeOfficial->grandfather_name }}"
                                                    class="form-control" placeholder="बाजेको नाम" />
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="main">
                                        <div class="text-end">
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                data-toggle="remove-parent" data-parent=".main"
                                                data-target-element="budget">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="row border-bottom mb-2">
                                            <div class="col-md-4 mb-2">
                                                <label for="post" class="form-label">पद *</label>
                                                <select name="consumerCommitteeOfficials[0][post]" class="form-select">
                                                    <option value="">छान्नुहोस्</option>
                                                    @foreach (\Modules\Plan\Enums\ConsumerCommitteePostEnum::cases() as $post)
                                                        <option value="{{ $post->value }}">
                                                            {{ $post->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="name" class="form-label">नाम थर *</label>
                                                <input type="text" name="consumerCommitteeOfficials[0][name]"
                                                    class="form-control" placeholder="नाम थर" />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="phone" class="form-label">सम्पर्क नं.</label>
                                                <input type="text" name="consumerCommitteeOfficials[0][phone]"
                                                    class="form-control" placeholder="सम्पर्क नं." />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="citizenship_no" class="form-label">नागरिकता नं.</label>
                                                <input type="text" name="consumerCommitteeOfficials[0][citizenship_no]"
                                                    class="form-control" placeholder="नागरिकता नं." />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="gender" class="form-label">लिङ्ग</label>
                                                <select name="consumerCommitteeOfficials[0][gender]" class="form-select">
                                                    <option value="">छान्नुहोस्</option>
                                                    @foreach (\App\Enums\Gender::cases() as $gender)
                                                        <option value="{{ $gender->value }}">
                                                            {{ $gender->label() }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="address" class="form-label">ठेगाना</label>
                                                <input type="text" name="consumerCommitteeOfficials[0][address]"
                                                    class="form-control" placeholder="ठेगाना" />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="father_name" class="form-label">बुवा/पतिको नाम</label>
                                                <input type="text" name="consumerCommitteeOfficials[0][father_name]"
                                                    class="form-control" placeholder="बुवा/पतिको नाम" />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label for="grandfather_name" class="form-label">बाजेको नाम</label>
                                                <input type="text"
                                                    name="consumerCommitteeOfficials[0][grandfather_name]"
                                                    class="form-control" placeholder="बाजेको नाम" />
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            setForm($('#operated_through_change').val())
            $(document).ready(function() {
                setForm($('#operated_through_change').val())

                $(document).on('change', '#operated_through_change', function() {
                    let operated_through_change = $('#operated_through_change').val();
                    setForm(operated_through_change);
                });
            })

            function setForm(operated_through) {
                if (operated_through) {
                    if (['bid', 'silwandi', 'quotation'].includes(operated_through)) {
                        $('#bid-form').removeClass('d-none');
                        $('#consumer-committee-form').addClass('d-none');
                        $('#operated_through_bid').val(operated_through);
                    } else {
                        $('#bid-form').addClass('d-none');
                        $('#consumer-committee-form').removeClass('d-none');
                        $('#operated_through_consumer_committee').val(operated_through);
                    }
                }
            }
        </script>
    @endpush
@endsection
