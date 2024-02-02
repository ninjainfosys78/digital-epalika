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
                        <li class="breadcrumb-item active">योजना/कार्यक्रम विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">योजना/कार्यक्रम विवरण</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title mb-0">योजना/कार्यक्रम विवरण</h4>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.plan.project.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> योजना/कार्यक्रमहरू
                            </a>
                            <a href="javascript:void(0)"
                                route_action_url="{{ route('admin.plan.project.print', [$project, \Modules\Plan\Enums\PlanTemplateTypeEnum::PROJECT_AGREEMENT_FORM]) }}"
                                class="btn btn-sm btn-outline-primary printProjectAgreementForm">
                                <i class="fa fa-print"></i> प्रिन्ट गर्नुहोस
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="header-title fw-bold">
                        {{ $project->operated_through === \Modules\Plan\Enums\ProjectOperatedThroughEnum::BID ? '१) आयोजनाको विवरण' : '१) सम्झौता गर्ने पक्ष र आयोजना' }}
                    </h4>
                    @if ($project->operated_through === \Modules\Plan\Enums\ProjectOperatedThroughEnum::CONSUMER_COMMITTEE)
                        <h4>क) उपभोक्त्ता समितिको विवरण</h4>
                        <div class="mx-3">
                            <h5>नाम : {{ $project->consumerCommittee->name ?? '' }}</h5>
                            <h5>ठेगाना : {{ $project->consumerCommittee->address ?? '' }}</h5>
                            <h5>
                                अध्यक्षको नाम
                                :
                                {{ $project->consumerCommittee?->consumerCommitteeOfficials->where('post', \Modules\Plan\Enums\ConsumerCommitteePostEnum::CHAIRMAN)->first()->name ?? '' }}
                            </h5>
                        </div>
                        <h4>ख) आयोजनाको विवरण</h4>
                    @endif
                    <div class="inline-gap p-2">
                        <h4 class="mb-1">योजना विवरण</h4>
                        <div class="table-responsive p-2">
                            <table class="table table-sm  table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th>योजना/कार्यक्रमको नाम </th>
                                        <td>{{ $project->project_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>उद्देश्य</th>
                                        <td>
                                            {{ $project->purpose }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>उद्देश्य</th>
                                        <td>
                                            {{ $project->purpose }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>योजनाको क्षेत्र</th>
                                        <td>
                                            {{ $project->planArea->area_name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>योजना स्तर</th>
                                        <td>
                                            {{ $project->planLevel->level_name ?? '' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>आयोजना स्थल</th>
                                        <td>
                                            {{ $project->project_venue }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>संचालन हुने वडा नं</th>
                                        <td>
                                            {{ implode(',', $project->ward_no) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>आयोजना अवस्था</th>
                                        <td>
                                            {{ $project->project_status?->label() }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="p-2">
                        <h4 class="mb-1">बजेट</h4>
                        <div class="table-responsive p-2">
                            <table class="table table-sm table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th>बजेट शीर्षक </th>
                                        <td>
                                            @foreach ($project->projectAllocatedAmounts as $projectAllocatedAmount)
                                                {{ $projectAllocatedAmount->budgetHead->title ?? '' }}
                                                {{ !$loop->last ? ',' : '' }}
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>विनियोजित रकम रु.</th>
                                        <td>
                                            {{ $project->projectAllocatedAmounts->sum('amount') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="inline-gap p-2">
                        <h4 class="mb-1">चौमासिक अनुसार लक्ष्य</h4>
                        <div class="table-responsive p-2">
                            <table class="table table-sm table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th>मूल्याङ्कन रकम रु.</th>
                                        <td>
                                            {{ $project->evaluation_amount }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>आयोजना सुरु हुने मिति</th>
                                        <td>
                                            {{ $project->project_start_date }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>आयोजना सम्पन्‍न हुने मिति</th>
                                        <td>
                                            {{ $project->project_completion_date }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="d-flex justify-content-between mt-3">
                            <h4 class="header-title fw-bold mb-0">२. आयोजनाको लागत सम्वन्धि विवरण</h4>
                        </div>
                        <div class="p-2">
                            <div class="inline-gap p-2">
                                <h5 class="fw-bold">क)भौतिक तथा वित्तीय प्रगतिको विवरण</h5>
                                <h5>वित्तीय प्रगति खर्च रकम रु. : {{ $project->progress_spent_amount }}
                                </h5>
                                <h5>भौतिक प्रगति लक्ष्य : {{ $project->physical_progress_target }}</h5>
                                <h5>भौतिक प्रगति सम्पन्न : {{ $project->physical_progress_completed }}
                                </h5>
                                <h5>भौतिक प्रगति एकाइ : {{ $project->physical_progress_unit }}</h5>
                            </div>
                            <h5 class="p-2"><b>ख) आयोजनाको अनुमान लागत रु:</b>
                                {{ $project->total_cost_estimate_amount }}
                            </h5>
                            <h5 class="fw-bold p-2 mb-0">ग) लागत व्यहोर्ने स्रोतहरु:</h5>
                            <div class="table-responsive p-4">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>विवरण</th>
                                            <th>रकम</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>कार्यालयबाट स्वीकृत रकम</td>
                                            <td>रू. {{ $project->projectAllocatedAmounts->sum('amount') }}</td>
                                        </tr>
                                        <tr>
                                            <td>अन्य निकायबाट प्राप्त रकम</td>
                                            <td>रू. {{ $project->agencies_grants }}</td>
                                        </tr>
                                        <tr>
                                            <td>अन्य साझेदारी रकम</td>
                                            <td>रू. {{ $project->share_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td>समितिबाट नगद साझेदारी रकम</td>
                                            <td>रू. {{ $project->committee_share_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td>कन्टिजेन्सी सहितको कुल रकम</td>
                                            <td>रू. {{ $project->total_amount_for_contingency }}</td>
                                        </tr>
                                        <tr>
                                            <td>कन्टिजेन्सी कट्टी रकम</td>
                                            <td>रू. {{ $project->contingency_amount }}
                                                ({{ $project->contingency_percent }} %)
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>अन्य करकट्टी रकम</td>
                                            <td>रू. {{ $project->other_taxes }}</td>
                                        </tr>
                                        <tr>
                                            <td>योजना सम्झौता रकम</td>
                                            <td>रू. {{ $project->project_contract_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td>समितिबाट जनश्रमदान रकम</td>
                                            <td>रू. {{ $project->labor_amount }}</td>
                                        </tr>
                                        <tr>
                                            <th>कुल लागत अनुमान रकम</th>
                                            <th>रू. {{ $project->total_cost_estimate_amount }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h5 class="p-2">घ) बस्तुगत अनुदानको विवरण: </h5>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <td>उपलब्ध गराउने स्रोत/निकाय</td>
                                        <td>सामाग्रीको नाम</td>
                                        <td>परिमाण</td>
                                        <td>एकाइ</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($project->projectGrantDetails as $projectGrantDetail)
                                        <tr>
                                            <td>{{ $projectGrantDetail->grant_source?->label() }}</td>
                                            <td>{{ $projectGrantDetail->asset_name }}</td>
                                            <td>{{ $projectGrantDetail->quantity }}</td>
                                            <td>{{ $projectGrantDetail->asset_unit }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <h5 class="p-2">ङ) आयोजनाबाट लाभान्वित हुने: </h5>
                            <ul>
                                <li>संगठित संस्था: {{ $project->benefited_organization ?? '' }}</li>
                                <li>अन्य: {{ $project->others_benefited ?? '' }}</li>
                            </ul>
                            <table class="table table-sm table-bordered">
                                <thead class="align-middle">
                                    <tr>
                                        <td rowspan="2">वडा नं.</td>
                                        <td rowspan="2">गाँउ बस्ति</td>
                                        <td colspan="3" class="align-middle text-center">घरधुरी संख्या</td>
                                        <td colspan="4" class="align-middle text-center">जनसंख्या</td>

                                    </tr>
                                    <tr>
                                        <td>दलित तथा पिछडिएका वर्ग</td>
                                        <td>अन्य</td>
                                        <td>जम्मा</td>
                                        <td>महिला</td>
                                        <td>पुरुष</td>
                                        <td>अन्य</td>
                                        <td>जम्मा</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($project->benefitedMemberDetails as $benefitedMemberDetail)
                                        <tr>
                                            <td>{{ $benefitedMemberDetail->ward_no }}</td>
                                            <td>{{ $benefitedMemberDetail->village }}</td>
                                            <td>{{ $benefitedMemberDetail->dalit_backward_no }}</td>
                                            <td>{{ $benefitedMemberDetail->other_households_no }}</td>
                                            <td>{{ $benefitedMemberDetail->total_household }}</td>
                                            <td>{{ $benefitedMemberDetail->no_of_male }}</td>
                                            <td>{{ $benefitedMemberDetail->no_of_female }}</td>
                                            <td>{{ $benefitedMemberDetail->no_of_others }}</td>
                                            <td>{{ $benefitedMemberDetail->total_population }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if ($project->operated_through === \Modules\Plan\Enums\ProjectOperatedThroughEnum::CONSUMER_COMMITTEE)
                            <div class="d-flex justify-content-between">
                                <h4 class="header-title fw-bold">
                                    ३. उपभोक्ता समिति/समुदायमा आधारित संस्था/गैरसरकारी संस्थाको
                                    विवरण
                                </h4>
                            </div>
                            <div class="p-2">
                                <h5>क) गठन भएको मिति:- {{ $project->consumerCommittee->formation_date ?? '' }}</h5>
                                <h5>ख) पदाधिकारीको नाम र ठेगाना (नागरिकता प्रमाणपत्र नम्बर र जिल्ला)</h5>
                            </div>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <td>क्र.सं.</td>
                                        <td>पद</td>
                                        <td>नामथर</td>
                                        <td>बुवा/पतिको नाम</td>
                                        <td>बाजेको नाम</td>
                                        <td>ना.प्र.नं.</td>
                                        <td>ठेगाना</td>
                                        <td>सम्पर्क नं.</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($project->consumerCommittee?->consumerCommitteeOfficials ?? collect() as $consumerCommitteeOfficial)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $consumerCommitteeOfficial->post?->label() ?? '' }}</td>
                                            <td>{{ $consumerCommitteeOfficial->name }}</td>
                                            <td>{{ $consumerCommitteeOfficial->father_name }}</td>
                                            <td>{{ $consumerCommitteeOfficial->grandfather_name }}</td>
                                            <td>{{ $consumerCommitteeOfficial->citizenship_no }}</td>
                                            <td>{{ $consumerCommitteeOfficial->address }}</td>
                                            <td>{{ $consumerCommitteeOfficial->phone }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h5> ग) गठन गर्दा उपस्थित लाभान्वितको
                                संख्या: {{ $project->consumerCommittee->beneficiary_no ?? '' }}-
                            </h5>
                        @else
                            <div class="d-flex justify-content-between">
                                <h4 class="header-title fw-bold">
                                    ३. बोलपत्र सम्वन्धि विवरण
                                </h4>
                            </div>
                            <div class="p-2">
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <h5><b>क) कार्यालयको स्वीकृत विभागिय लागत अनुमान</b>
                                            : {{ $project->projectBidDetail->cost_estimation ?? '' }}</h5>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <h5><b>ख) बोलपत्र सम्वन्धि विवरण </b>
                                            <ul>
                                                <li>१.बोलपत्र नं. :</li>
                                                <li>२.बोलपत्रको सुचना प्रकाशित मिति
                                                    : {{ $project->projectBidDetail->notice_published_date ?? '' }}</li>
                                                <li>३.पत्रिकाको नाम
                                                    : {{ $project->projectBidDetail->contract_newspaper_name ?? '' }}</li>
                                            </ul>
                                        </h5>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <h5><b>ग) ठेक्का विवरण</b>
                                            <ul>
                                                <li>ठेक्का मुल्यांकनको निर्णय मिति
                                                    :
                                                    {{ $project->projectBidDetail->contract_evaluation_decision_date ?? '' }}
                                                </li>
                                                <li>आशयको सुचना प्रकाशित मिति
                                                    : {{ $project->projectBidDetail->intent_notice_publish_date ?? '' }}
                                                </li>
                                                <li>पत्रिकाको नाम
                                                    : {{ $project->projectBidDetail->contract_newspaper_name ?? '' }}</li>
                                                <li>ठेक्का स्वीकृतीको निर्णय मिति
                                                    :
                                                    {{ $project->projectBidDetail->contract_acceptance_decision_date ?? '' }}
                                                </li>
                                                <li>ठेक्का विलो प्रतिशत
                                                    : {{ $project->projectBidDetail->contract_percentage ?? '' }}</li>
                                            </ul>
                                        </h5>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h5><b>घ) कम्पनीको विवरण</b>
                                            <ul>
                                                <li>
                                                    १.कम्पनीको नाम
                                                    : {{ $project->projectBidDetail->contractor_name ?? '' }}
                                                </li>
                                                <li>
                                                    २.कम्पनीको ठेगाना
                                                    : {{ $project->projectBidDetail->contractor_address ?? '' }}
                                                </li>
                                            </ul>
                                        </h5>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <h5><b>ङ) सम्पर्क नम्बर
                                                : </b>{{ $project->projectBidDetail->contractor_phone ?? '' }}</h5>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <h5><b>च) कबोल अंक : </b>{{ $project->projectBidDetail->confession_number ?? '' }}
                                        </h5>

                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <h5><b>छ) विडवण्ड विवरण
                                                :</b> {{ $project->projectBidDetail->contract_percentage ?? '' }}
                                            <ul>
                                                <li>१.विडवण्ड नं. : {{ $project->projectBidDetail->bid_bond_no ?? '' }}
                                                </li>
                                                <li>२.विडवण्ड रकम
                                                    : {{ $project->projectBidDetail->bid_bond_amount ?? '' }}</li>
                                                <li>३.बैंकको नाम
                                                    : {{ $project->projectBidDetail->bid_bond_bank_name ?? '' }}</li>
                                                <li>४.जारी मिति
                                                    : {{ $project->projectBidDetail->bid_bond_issue_date ?? '' }}</li>
                                                <li>५.म्याद सकिने मिति
                                                    : {{ $project->projectBidDetail->bid_bond_expiry_date ?? '' }}</li>
                                            </ul>
                                        </h5>
                                    </div>


                                    <div class="col-md-6 mt-2">
                                        <h5>
                                            <b> ज) परफरमेन्स वण्ड विवरण</b>
                                            <ul>
                                                <li>१.परफरमेन्स वण्ड नं.
                                                    : {{ $project->projectBidDetail->performance_bond_no ?? '' }}</li>

                                                <li>२.परफरमेन्स वण्ड रकम
                                                    : {{ $project->projectBidDetail->performance_bond_amount ?? '' }}</li>

                                                <li>३.बैंकको नाम
                                                    : {{ $project->projectBidDetail->performance_bond_bank ?? '' }}</li>
                                                <li>४.जारी मिति
                                                    : {{ $project->projectBidDetail->performance_bond_issue_date ?? '' }}
                                                </li>
                                                <li>५.म्याद सकिने मिति
                                                    : {{ $project->projectBidDetail->performance_bond_expiry_date ?? '' }}
                                                </li>

                                                <li>५.म्याद थपको मिति
                                                    :
                                                    {{ $project->projectBidDetail->performance_bond_extended_date ?? '' }}
                                                </li>
                                            </ul>
                                        </h5>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h5><b>झ)</b>
                                            <ul>
                                                <li>१.ठेक्का सम्झौता मिति
                                                    : {{ $project->projectBidDetail->contract_agreement_date ?? '' }}</li>
                                                <li>२.कार्यादेशको मिति
                                                    : {{ $project->projectBidDetail->contract_assigned_date ?? '' }}</li>
                                            </ul>
                                        </h5>
                                    </div>

                                    <div class="col-md-6 mt-2">
                                        <h5><b>ञ) इन्स्योरेन्स विवरण</b>
                                            <ul>
                                                <li>१. जारी मिति
                                                    : {{ $project->projectBidDetail->insurance_issue_date ?? '' }}

                                                </li>
                                                <li>२. सकिने मिति
                                                    : {{ $project->projectBidDetail->insurance_expiry_date ?? '' }}

                                                </li>
                                                <li>३. म्याद थप हुने मिति
                                                    : {{ $project->projectBidDetail->insurance_extended_date ?? '' }}</li>
                                            </ul>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endif


                        @if ($project->operated_through === \Modules\Plan\Enums\ProjectOperatedThroughEnum::BID)
                            <div class="d-flex justify-content-between">
                                <h4 class="header-title fw-bold">
                                    ४) मोविलाईजेशन पेश्की/रनिङ विल विवरण
                                </h4>
                            </div>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <td>क्र.सं.</td>
                                        <td>बिल/पेश्कीको प्रकार</td>
                                        <td>बिल/पेश्कीको क्रम</td>
                                        <td>मिति</td>
                                        <td>रकम</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($project->projectBidSubmissions as $projectBidSubmission)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $projectBidSubmission->submission_type?->label() ?? '' }}</td>
                                            <td>{{ $projectBidSubmission->submission_no }}</td>
                                            <td>{{ $projectBidSubmission->date }}</td>
                                            <td>रू. {{ $projectBidSubmission->amount }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @else
                            <div class="d-flex justify-content-between">
                                <h4 class="header-title fw-bold">
                                    ४) किस्ता/पेश्की विवरण
                                </h4>
                            </div>
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <td>क्र.सं.</td>
                                        <td>प्रकार</td>
                                        <td>मिति</td>
                                        <td>रकम</td>
                                        <td>कैफियत</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($project->consumerCommitteeTransactions as $consumerCommitteeOfficial)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $consumerCommitteeOfficial->type?->label() ?? '' }}</td>
                                            <td>{{ $consumerCommitteeOfficial->date }}</td>
                                            <td>{{ $consumerCommitteeOfficial->amount }}</td>
                                            <td>{{ $consumerCommitteeOfficial->remarks }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        @endif

                        @if ($project->operated_through === \Modules\Plan\Enums\ProjectOperatedThroughEnum::CONSUMER_COMMITTEE)
                            <h4 class="header-title fw-bold">
                                ५). आयोजना मर्मत संम्भार सम्बन्धी व्यवस्था
                            </h4>
                            <div class="p-2">
                                <h5>क) आयोजना मर्मत संम्भारको जिम्मा लिने समिति संस्थाको
                                    नाम: {{ $project->projectMaintenanceArrangement->office_name ?? '' }}</h5>
                                <h5>ख) मर्मत संम्भारको सम्भावित स्रोत (छ छैन खुलाउने):
                                    <ul>
                                        <li>
                                            जनश्रमदान: {{ $project->projectMaintenanceArrangement->public_service ?? '' }}
                                        </li>
                                        <li>सेवा
                                            शुल्क: {{ $project->projectMaintenanceArrangement->service_fee ?? '' }}</li>
                                        <li>दस्तुर,
                                            चन्दाबाट:
                                            {{ $project->projectMaintenanceArrangement->from_fee_donation ?? '' }}
                                        </li>
                                        <li> अन्य केही
                                            भए: {{ $project->projectMaintenanceArrangement->others ?? '' }}</li>
                                    </ul>
                                </h5>
                            </div>
                        @endif


                        <h4 class="header-title fw-bold">६). सम्झौताको शर्तहरु</h4>
                        <div class="p-2">
                            {!! $project->projectAgreementTerm->data ?? '' !!}
                        </div>

                        <h4 class="header-title fw-bold">
                            ७). सम्बन्धित कागजातहरू
                        </h4>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र. सं.</th>
                                    <th>कागजात नाम</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($project->projectDocuments as $projectDocument)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $projectDocument->document_name }}</td>
                                        <td>

                                            <a href="javascript:void(0)"
                                                route_action="{{ route('admin.plan.project.projectDocument.show', [$project, $projectDocument]) }}"
                                                class="btn btn-sm btn-outline-primary printProjectDocument">
                                                <i class="fa fa-print"></i> प्रिन्ट गर्नुहोस

                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <h4 class="header-title fw-bold">
                            ८). योजना संग सम्बन्धित फोटो/फाईलहरू
                        </h4>
                        <div class="row">
                            @foreach ($project->files as $file)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between">
                                            <h5 class="card-title">
                                                {{ $file->file_name }}
                                            </h5>
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('admin.file.download', $file) }}"
                                                    class="btn btn-xs btn-outline-primary mx-1">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                <form action="{{ route('admin.file.destroy', $file) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="show_confirm btn btn-sm btn-danger ml-2">
                                                        <i class="fa fa-window-close"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if ($file->extension === 'pdf')
                                                <iframe src="{{ $file->file_url }}" frameborder="0"
                                                    width="100%"></iframe>
                                            @elseif($file->extension === 'png' or $file->extension === 'jpg' or $file->extension === 'jpeg')
                                                <img src="{{ $file->file_url }}" class="card-image" alt="Image"
                                                    height=150px;" width="100%">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                $(".printProjectDocument").on("click", function(e) {
                    $.ajax({
                        method: "GET",
                        url: $(this).attr("route_action"),
                        success: function(resp) {
                            let print_area = window.open();
                            print_area.document.write(resp.data);
                            print_area.document.close();
                            print_area.focus();
                            print_area.print();
                            print_area.close();
                        },
                        error: function() {
                            alert("Something Went Wrong");
                        }
                    });
                });
                $(".printProjectAgreementForm").on("click", function(e) {
                    $.ajax({
                        method: "GET",
                        url: $(this).attr("route_action_url"),
                        success: function(resp) {
                            let print_area = window.open();
                            print_area.document.write(resp.data);
                            print_area.document.close();
                            print_area.focus();
                            print_area.print();
                            print_area.close();
                        },
                        error: function() {
                            alert("Something Went Wrong");
                        }
                    });
                });
            </script>
        @endpush
    @endsection
