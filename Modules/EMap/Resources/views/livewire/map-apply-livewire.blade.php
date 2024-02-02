<form wire:submit.prevent="saveFormData" method="post" class="building-construction-application">
    @csrf
    <fieldset>
        <legend class="title">१. चार किल्लाको विवरण</legend>
        <div class="row">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-hover table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th>विवरण</th>
                                        <th>पूर्व</th>
                                        <th>दक्षिण</th>
                                        <th>पश्चिम</th>
                                        <th>उत्तर</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fourFortDetails as $key => $fourFort)
                                        <tr>
                                            <td>
                                                <label for="fourFortDetail.detail">
                                                    १.{{ $loop->iteration }}
                                                    {{ \Modules\EMap\Enums\FourSideParticularEnum::tryFrom($fourFort['detail'])->label() }}
                                                </label>
                                                <input type="hidden" id="fourFortDetails.{{ $key }}.detail"
                                                    wire:model="fourFortDetails.{{ $key }}.detail">
                                                @error("fourFortDetails.$key.detail")
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" id="fourFortDetails.{{ $key }}.east"
                                                    wire:model="fourFortDetails.{{ $key }}.east">
                                                @error("fourFortDetails.$key.east")
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" id="fourFortDetails.{{ $key }}.south"
                                                    wire:model="fourFortDetails.{{ $key }}.south">
                                                @error("fourFortDetails.$key.south")
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" id="fourFortDetails.{{ $key }}.west"
                                                    wire:model="fourFortDetails.{{ $key }}.west">
                                                @error("fourFortDetails.$key.west")
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="text" id="fourFortDetails.{{ $key }}.north"
                                                    wire:model="fourFortDetails.{{ $key }}.north">
                                                @error("fourFortDetails.$key.north")
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </fieldset>

    <fieldset>
        <legend>२. डिजाइनरको विवरण</legend>
        @foreach ($designerDetails as $key => $designerDetail)
            <div class="row">
                <label class="fs-6 fw-semibold pb-3" for="designerDetails.{{ $key }}.post">
                    १.{{ $loop->iteration }}
                    {{ \Modules\EMap\Enums\PostsEnum::tryFrom($designerDetail['post'])->label() }}
                </label>
                <input type="hidden" id="designerDetails.{{ $key }}.post"
                    wire:model="designerDetails.{{ $key }}.post">
                @error("designerDetails.$key.post")
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="table-responsive">
                    <table class="table table-hover table-responsive table-bordered">
                        <tr>
                            <td><label for="designerDetails.{{ $key }}.name">नाम</label>
                                <input type="text" class="form-control form-control-sm"
                                    id="designerDetails.{{ $key }}.name"
                                    wire:model="designerDetails.{{ $key }}.name">
                                @error("designerDetails.$key.name")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <label for="designerDetails.{{ $key }}.father_name"> बुवाको नाम</label>
                                <input type="text" class="form-control form-control-sm"
                                    id="designerDetails.{{ $key }}.father_name"
                                    wire:model="designerDetails.{{ $key }}.father_name">
                                @error("designerDetails.$key.father_name")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <label for="designerDetails.{{ $key }}.grandfather_name">
                                    हजुरबुबाको नाम
                                </label>
                                <input type="text" class="form-control form-control-sm"
                                    id="designerDetails.{{ $key }}.grandfather_name"
                                    wire:model="designerDetails.{{ $key }}.grandfather_name">
                                @error("designerDetails.$key.grandfather_name")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="designerDetails.{{ $key }}.phone">
                                    फोन
                                </label>
                                <input type="text" class="form-control form-control-sm"
                                    id="designerDetails.{{ $key }}.phone"
                                    wire:model="designerDetails.{{ $key }}.phone">
                                @error("designerDetails.$key.phone")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <label for="designerDetails.{{ $key }}.address">
                                    ठेगाना
                                </label>
                                <input type="text" class="form-control form-control-sm"
                                    id="designerDetails.{{ $key }}.address"
                                    wire:model="designerDetails.{{ $key }}.address">
                                @error("designerDetails.$key.address")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <label for="designerDetails.{{ $key }}.local_body">
                                    पालिका
                                </label>
                                <input type="text" class="form-control form-control-sm"
                                    id="designerDetails.{{ $key }}.local_body"
                                    wire:model="designerDetails.{{ $key }}.local_body">
                                @error("designerDetails.$key.local_body")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="designerDetails.{{ $key }}.ward_no">
                                    वडा नं.
                                </label>
                                <input type="text" class="form-control form-control-sm"
                                    id="designerDetails.{{ $key }}.ward_no"
                                    wire:model="designerDetails.{{ $key }}.ward_no">
                                @error("designerDetails.$key.ward_no")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <label for="designerDetails.{{ $key }}.nec_council_no">
                                    NEC Council No.
                                </label>
                                <input type="text" class="form-control form-control-sm"
                                    id="designerDetails.{{ $key }}.nec_council_no"
                                    wire:model="designerDetails.{{ $key }}.nec_council_no">
                                @error("designerDetails.$key.nec_council_no")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                            <td>
                                <label for="designerDetails.{{ $key }}.local_body_registration_no">
                                    पालिकाको दर्ता नं
                                </label>
                                <input type="text" class="form-control form-control-sm"
                                    id="designerDetails.{{ $key }}.local_body_registration_no"
                                    wire:model="designerDetails.{{ $key }}.local_body_registration_no">
                                @error("designerDetails.$key.local_body_registration_no")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="designerDetails.{{ $key }}.consulting_firm_name">
                                    कन्सल्टिंग फर्मबाट भए सो को नाम
                                </label>
                                <input type="text" class="form-control form-control-sm"
                                    id="designerDetails.{{ $key }}.consulting_firm_name"
                                    wire:model="designerDetails.{{ $key }}.consulting_firm_name">
                                @error("designerDetails.$key.consulting_firm_name")
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach

    </fieldset>

    <fieldset>
        <legend class="text-center"><b>निर्माण हुने भवन तथा मापदण्ड सम्बन्धि संक्षिप्त विवरण</b>
        </legend>
        <div class="row">
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <b>मापदण्ड सम्बन्धि विवरण :</b>
                        <table class="table table-hover table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.सं</th>
                                    <th>विवरण</th>
                                    <th>मापदण्ड अनुसार</th>
                                    <th>नक्सा अनुसार</th>
                                    <th>अनुपालन</th>
                                    <th>कैफियत</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criteriaDetails as $key => $criteriaDetail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <label for="name">
                                                {{ \Modules\EMap\Enums\DetailsRegardingCriteriaEnum::tryFrom($criteriaDetail['detail'])->label() }}
                                            </label>
                                            <input type="hidden" id="criteriaDetails.{{ $key }}.detail"
                                                wire:model="criteriaDetails.{{ $key }}.detail">
                                            @error("criteriaDetails.$key.detail")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text"
                                                wire:model="criteriaDetails.{{ $key }}.according_to_criteria">
                                            @error("criteriaDetails.$key.according_to_criteria")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text"
                                                wire:model="criteriaDetails.{{ $key }}.according_to_map">
                                            @error("criteriaDetails.$key.according_to_map")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text"
                                                wire:model="criteriaDetails.{{ $key }}.compliance">
                                            @error("criteriaDetails.$key.compliance")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>

                                        <td>
                                            <input type="text"
                                                wire:model="criteriaDetails.{{ $key }}.remarks">
                                            @error("criteriaDetails.$key.remarks")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                                @error('criteriaDetails')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <b>भवन सम्बन्धि विवरण :</b>
                        <table class="table table-hover table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.सं</th>
                                    <th colspan="2" class="text-center">विवरण</th>
                                    <th>कैफियत</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buildingDetails as $key => $buildingDetail)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <label for="name">
                                                {{ \Modules\EMap\Enums\BuildingDetailEnum::tryFrom($buildingDetail['detail'])->label() }}
                                            </label>
                                            <input type="hidden" id="detail"
                                                wire:model="buildingDetails.{{ $key }}.detail">
                                            @error("buildingDetails.$key.detail")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text"
                                                wire:model="buildingDetails.{{ $key }}.description">
                                            @error("buildingDetails.$key.description")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="text"
                                                wire:model="buildingDetails.{{ $key }}.remarks">
                                            @error("buildingDetails.$key.remarks")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                                @error('buildingDetails')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </fieldset>

    <div class="d-flex justify-content-end">
        <div>

            <div>
                <input type="file" wire:model="applyMap.consultant_signature" id="applyMap.consultant_signature">
            </div>
            <div class="px-5">
                <label for="applyMap.consultant_signature">
                    <b>(कन्सल्टेन्ट इंन्जिनियरको सहि): </b>
                </label>
            </div>
            @error('applyMap.consultant_signature')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div>
                <label for="applyMap.consultant_name">
                    <b>नाम: </b>
                </label>
                <input type="text" wire:model="applyMap.consultant_name" id="applyMap.consultant_name">
            </div>
            @error('applyMap.consultant_name')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div>
                <label for="applyMap.consultant_mobile_no"><b>मोबाइल नं.: </b></label>
                <input type="text" wire:model="applyMap.consultant_mobile_no" id="applyMap.consultant_mobile_no">
            </div>
            @error('applyMap.consultant_mobile_no')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div>
                <label for="applyMap.consultant_nec_no"><b>एन. ई. सी. नं: </b></label>
                <input type="text" wire:model="applyMap.consultant_nec_no" id="applyMap.consultant_nec_no">
            </div>
            @error('applyMap.consultant_nec_no')
                <p class="text-danger">{{ $message }}</p>
            @enderror

        </div>
    </div>
    <div class="mt-4 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary    ">Save</button>
    </div>
</form>
