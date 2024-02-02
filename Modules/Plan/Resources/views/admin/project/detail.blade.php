<div class="modal-header bg-primary">
    <h4 class="modal-title text-white fw-bold" id="fullWidthModalLabel">
        {{ $project->project_name }}को विवरण
    </h4>
    <button type="button" class="btn-close border" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="#project-detail" data-bs-toggle="tab" aria-expanded="true" class="nav-link active"
                aria-selected="true" role="tab">
                योजनाको विवरण
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#project-cost-detail" data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                aria-selected="false" tabindex="-1" role="tab">
                योजनाको कुल लागतको अनुमान
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#consumer_committee_bid" data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                aria-selected="false" tabindex="-1" role="tab">
                योजना संचालन गर्ने संस्था/समिति
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#financial-transactions" data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                aria-selected="false" tabindex="-1" role="tab">
                आर्थिक कारोबारको विवरण
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#technical-cost-estimate" data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                aria-selected="false" tabindex="-1" role="tab">
                प्राविधिक अनुमान तथा मूल्याङ्कन
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane show active" id="project-detail" role="tabpanel">
            <div class="p-2 border border-info">
                <table class="table table-sm table-bordered">
                    <tbody>
                        <tr>
                            {{-- <td>
                                <b class="text-primary">बजेट उप-शीर्षक : </b> {{ $project->budgetHead->title ?? '' }}
                            </td> --}}
                            <td>
                                <b class="text-primary">आर्थिक वर्ष : </b> {{ $project->fiscalYear->title ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="text-primary">फाइल नं./योजना दर्ता नं. : </b> {{ $project->registration_no }}
                            </td>
                            <td>
                                <b class="text-primary">खर्चको किसिमष : </b> {{ $project->expenseHead->title ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="text-primary">योजना/कार्यक्रमको नाम : </b> {{ $project->project_name }}
                            </td>
                            <td>
                                <b class="text-primary">योजना उपस्तर : </b> {{ $project->planLevel->level_name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="text-primary">योजनाको उपक्षेत्र : </b> {{ $project->planArea->area_name ?? '' }}
                            </td>
                            <td>
                                <b class="text-primary">योजना स्वीकृत रकम : </b> रू.
                                {{ $project->projectAllocatedAmounts->sum('amount') }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="text-primary">संचालन हुने वडा नं : </b> {{ implode(',', $project->ward_no) }}
                            </td>
                            <td>
                                <b class="text-primary">पहिलो चौमासिक रकम : </b> रू.
                                {{ $project->first_quarterly_amount }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="text-primary">पहिलो चौमासिक लक्ष्य : </b> रू.
                                {{ $project->first_quarterly_goal }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="text-primary">आयोजना स्थल : </b> {{ $project->project_venue }}
                            </td>
                            <td>
                                <b class="text-primary">दोश्रो चौमासिक रकम : </b> रू.
                                {{ $project->second_quarterly_amount }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="text-primary">उद्देश्य : </b> {{ $project->purpose }}
                            </td>
                            <td>
                                <b class="text-primary">दोश्रो चौमासिक लक्ष्य : </b> रू.
                                {{ $project->second_quarterly_goal }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="text-primary">आयोजना अवस्था : </b> {{ $project->project_status?->label() }}
                            </td>
                            <td>
                                <b class="text-primary">तेश्रो चौमासिक रकम : </b> रू.
                                {{ $project->third_quarterly_amount }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="text-primary">आयोजना सुरु हुने मिति : </b> {{ $project->project_start_date }}
                            </td>
                            <td>
                                <b class="text-primary">तेश्रो चौमासिक लक्ष्य : </b> रू.
                                {{ $project->third_quarterly_goal }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="text-primary">आयोजना सम्पन्‍न हुने मिति
                                    : </b> {{ $project->project_completion_date }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row bg-soft-secondary g-2 p-2 m-1">
                    <div class="col-md-3">
                        <a href="javascript:void(0)"
                            route_action_url="{{ route('admin.plan.project.print', [$project, \Modules\Plan\Enums\PlanTemplateTypeEnum::PROJECT_AGREEMENT_FORM]) }}"
                            class="printBtn">
                            <i class="fa fa-print"> योजना सम्झौता आदेश</i>
                        </a>
                    </div>
                    @foreach ($project->projectDocuments as $projectDocument)
                        <div class="col-md-3">
                            <a href="javascript:void(0)"
                                route_action_url="{{ route('admin.plan.project.projectDocument.show', [$project, $projectDocument]) }}"
                                class="printBtn">
                                <i class="fa fa-print"> {{ $projectDocument->document_name }}</i>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="tab-pane" id="project-cost-detail" role="tabpanel">
            <div class="p-2 border border-info">
                <h5>क) आयोजनाको अनुमान लागत रु: {{ $project->total_cost_estimate_amount }}</h5>
                <h5 class="fw-bold">ख) लागत व्यहोर्ने स्रोतहरु:</h5>
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
                            <td>रू. {{ $project->contingency_amount }} ({{ $project->contingency_percent }} %)</td>
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
                <h5>घ) बस्तुगत अनुदानको विवरण: </h5>
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
                <h5>ङ) आयोजनाबाट लाभान्वित हुने: </h5>
                <ul>
                    <li>संगठित संस्था: {{ $project->benefited_organization }}</li>
                    <li>अन्य: {{ $project->others_benefited ?? '' }}</li>
                </ul>
                <table class="table table-sm table-bordered">
                    <thead class="align-middle">
                        <tr>
                            <td rowspan="2">वडा नं.</td>
                            <td rowspan="2">गाँउ बस्ति</td>
                            <td colspan="3" class="align-middle text-center">घरधुरी संख्या</td>
                            <td colspan="3" class="align-middle text-center">जनसंख्या</td>

                        </tr>
                        <tr>
                            <td>दलित तथा पिछडिएका वर्ग</td>
                            <td>अन्य</td>
                            <td>जम्मा</td>
                            <td>महिला</td>
                            <td>पुरुष</td>
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
        </div>
        <div class="tab-pane" id="consumer_committee_bid" role="tabpanel">
            <div class="p-2 border border-info">
                <h5 class="mx-2"><b>प्रकार :- </b> {{ $project->operated_through?->label() }}</h5>
                @if ($project->operated_through === \Modules\Plan\Enums\ProjectOperatedThroughEnum::CONSUMER_COMMITTEE)
                    <div class="p-2">
                        <h5><b>क) गठन भएको मिति:-</b> {{ $project->consumerCommittee->formation_date ?? '' }}</h5>
                        <h5 class="fw-bold">ख) पदाधिकारीको नाम र ठेगाना (नागरिकता प्रमाणपत्र नम्बर र जिल्ला)</h5>
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
                        <b>संख्या :-</b> {{ $project->consumerCommittee->beneficiary_no ?? '' }}
                    </h5>
                @else
                    <div class="p-2">
                        <h5><b>क) कार्यालयको स्वीकृत विभागिय लागत अनुमान</b>
                            : {{ $project->projectBidDetail->cost_estimation ?? '' }}</h5>
                        <h5>ख)
                            <ul>
                                <li>१.बोलपत्र नं. :</li>
                                <li>२.बोलपत्रको सुचना प्रकाशित मिति
                                    : {{ $project->projectBidDetail->notice_published_date ?? '' }}</li>
                                <li>३.पत्रिकाको नाम
                                    : {{ $project->projectBidDetail->contract_newspaper_name ?? '' }}</li>
                            </ul>
                        </h5>
                        <h5><b>ग) ठेक्का विवरण</b>
                            <ul>
                                <li>ठेक्का मुल्यांकनको निर्णय मिति
                                    : {{ $project->projectBidDetail->contract_evaluation_decision_date ?? '' }}</li>
                                <li>आशयको सुचना प्रकाशित मिति
                                    : {{ $project->projectBidDetail->intent_notice_publish_date ?? '' }}</li>
                                <li>पत्रिकाको नाम : {{ $project->projectBidDetail->contract_newspaper_name ?? '' }}</li>
                                <li>ठेक्का स्वीकृतीको निर्णय मिति
                                    : {{ $project->projectBidDetail->contract_acceptance_decision_date ?? '' }}</li>
                                <li>ठेक्का विलो प्रतिशत
                                    : {{ $project->projectBidDetail->contract_percentage ?? '' }}</li>
                            </ul>
                        </h5>
                        <h5>घ)
                            <ul>
                                <li>
                                    १.ठेकेदारको नाम : {{ $project->projectBidDetail->contractor_name ?? '' }}
                                </li>
                                <li>
                                    २.ठेकेदारको ठेगाना : {{ $project->projectBidDetail->contractor_address ?? '' }}
                                </li>
                            </ul>
                        </h5>
                        <h5><b>ङ) सम्पर्क नम्बर :</b> {{ $project->projectBidDetail->contractor_phone ?? '' }}</h5>
                        <h5><b>च) कबोल अंक : </b> {{ $project->projectBidDetail->confession_number ?? '' }}</h5>
                        <h5><b>छ) विडवण्ड विवरण :</b> {{ $project->projectBidDetail->contract_percentage ?? '' }}
                            <ul>
                                <li>१.विडवण्ड नं. : {{ $project->projectBidDetail->bid_bond_no ?? '' }}</li>
                                <li>२.विडवण्ड रकम : {{ $project->projectBidDetail->bid_bond_amount ?? '' }}</li>
                                <li>३.बैंकको नाम : {{ $project->projectBidDetail->bid_bond_bank_name ?? '' }}</li>
                                <li>४.जारी मिति : {{ $project->projectBidDetail->bid_bond_issue_date ?? '' }}</li>
                                <li>५.म्याद सकिने मिति
                                    : {{ $project->projectBidDetail->bid_bond_expiry_date ?? '' }}</li>
                            </ul>
                        </h5>
                        <h5>
                            <b>ज) परफरमेन्स वण्ड विवरण</b>
                            <ul>
                                <li>१.परफरमेन्स वण्ड नं.
                                    : {{ $project->projectBidDetail->performance_bond_no ?? '' }}</li>

                                <li>२.परफरमेन्स वण्ड रकम
                                    : {{ $project->projectBidDetail->performance_bond_amount ?? '' }}</li>

                                <li>३.बैंकको नाम : {{ $project->projectBidDetail->performance_bond_bank ?? '' }}</li>
                                <li>४.जारी मिति
                                    : {{ $project->projectBidDetail->performance_bond_issue_date ?? '' }}</li>
                                <li>५.म्याद सकिने मिति
                                    : {{ $project->projectBidDetail->performance_bond_expiry_date ?? '' }}</li>

                                <li>५.म्याद थपको मिति
                                    : {{ $project->projectBidDetail->performance_bond_extended_date ?? '' }}</li>
                            </ul>
                        </h5>
                        <h5>झ)
                            <ul>
                                <li>१.ठेक्का सम्झौता मिति
                                    : {{ $project->projectBidDetail->contract_agreement_date ?? '' }}</li>
                                <li>२.कार्यादेशको मिति
                                    : {{ $project->projectBidDetail->contract_assigned_date ?? '' }}</li>
                            </ul>
                        </h5>
                        <h5><b>ञ) इन्स्योरेन्स विवरण</b>
                            <ul>
                                <li>१. जारी मिति : {{ $project->projectBidDetail->insurance_issue_date ?? '' }}

                                </li>
                                <li>२. सकिने मिति : {{ $project->projectBidDetail->insurance_expiry_date ?? '' }}

                                </li>
                                <li>३. म्याद थप हुने मिति
                                    : {{ $project->projectBidDetail->insurance_extended_date ?? '' }}</li>
                            </ul>
                        </h5>
                    </div>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="financial-transactions" role="tabpanel">
            <div class="p-2 border border-info">
                @if ($project->operated_through === \Modules\Plan\Enums\ProjectOperatedThroughEnum::CONSUMER_COMMITTEE)
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>क्र.सं.</th>
                                <th>प्रकार</th>
                                <th>मिति</th>
                                <th>रकम</th>
                                <th>कैफियत</th>
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
                @else
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>क्र.सं.</th>
                                <th>बिल/पेश्कीको प्रकार</th>
                                <th>बिल/पेश्कीको क्रम</th>
                                <th>मिति</th>
                                <th>रकम</th>
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
                        <tfoot>
                            <tr>
                                <th class="text-center" colspan="4">जम्मा रकम</th>
                                <td>रू. {{ $project->projectBidSubmissions->sum('amount') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="technical-cost-estimate" role="tabpanel">
            <div class="p-2 border border-info">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="bg-info">
                            <tr>
                                <th>क्र.स</th>
                                <th>विवरण</th>
                                <th>परिमाण</th>
                                <th>इकाई</th>
                                <th>दर</th>
                                <th>रकम</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($project->technicalCostEstimates as $technicalCostEstimate)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $technicalCostEstimate->detail }}</td>
                                    <td>{{ $technicalCostEstimate->quantity }}</td>
                                    <td>{{ $technicalCostEstimate->unit->title ?? '' }}</td>
                                    <td>{{ $technicalCostEstimate->rate }}</td>
                                    <td>{{ $technicalCostEstimate->amount }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">जम्मा रकम</th>
                                <td colspan="2">रू. {{ $project->technicalCostEstimates->sum('amount') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".printBtn").on("click", function(e) {
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
