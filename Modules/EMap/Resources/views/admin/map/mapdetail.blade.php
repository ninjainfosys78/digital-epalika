@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item ">नक्सा</li>
                        <li class="breadcrumb-item active">व्यक्तिको विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">व्यक्ति र संस्थाको पुरा विवरण</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">व्यक्ति र संस्थाको पुरा विवरण</h4>
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <a href="{{ route('emap.admin.map.mapApply.index', $applicationFormTypeEnum) }}"
                                class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                <i class="fa fa-list"></i> व्यक्ति र संस्थाको पुरा विवरणहरूको सुची</a>
                            <x-print-button target-element="printData" title="प्रतिवेदन रिपोर्ट" />
                        </div>
                    </div>
                </div>
                <div id="printData">
                    <div class="row mt-2 mx-2">
                        <div class="col-md-4">
                            <h4><b>संस्था :</b> {{ $mapApply->organization?->organizationDetail?->org_name_ne ?? '' }}</h4>
                        </div>
                        <div class="col-md-4">
                            <h4><b>नक्सा :</b> {{ $mapApply->application_type?->label() }}</h4>
                        </div>
                    </div>
                    <fieldset class="mx-2">
                        <legend>
                            <h5 class="py-2">१. प्रस्तावित भवनको विवरण</h5>
                        </legend>
                        <div class="mb-3">
                            <h4 class="form-label fw-bold">१.१ निर्माण कार्यको किसिम :
                                {{ $mapApply->construction_type?->label() }}
                            </h4>
                        </div>
                        <div class="mb-3">
                            <h4 class="form-label"><b>१.२ प्रयोजन :</b> {{ $mapApply->usage?->label() }}</h4>
                        </div>
                        <div class="mb-3">
                            <h4 class="form-label"><b>१.३ भवन ऐन अनुसार वर्गीकरण :</b>
                                {{ $mapApply->building_category?->label() }}</h4>
                        </div>
                        <div class="mb-3">
                            <h4 class="form-label"><b>१.४ स्ट्रकचर टाईप
                                    :</b> {{ $mapApply->structureType?->title ?? '' }}
                            </h4>
                        </div>
                        <div class="mb-1">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"><b>१.५ हाल निर्माण गर्ने तल्ला
                                            संख्या :</b> {{ $mapApply->current_storey }}</h4>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"><b>१.६ प्लिन्थको क्षेत्रफल
                                            :</b> {{ $mapApply->area_of_plinth }}
                                    </h4>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"><b>१.७ भविष्यमा निर्माण गर्ने तल्ला संख्या :</b>
                                        {{ $mapApply->future_storey }}</h4>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"><b>१.८ कुल भवनको लम्बाई :</b> {{ $mapApply->length }}</h4>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"><b>१.९ कुल भवनको चौडाई :</b> {{ $mapApply->breadth }}</h4>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"><b>१.१० भवनको कुल उचाई जमिनको सतहबाट
                                            : {{ $mapApply->height }}
                                    </h4>
                                </div>
                                <div class="col-md-12">
                                    <h4 class="form-label"><b>१.११ तल्लाको क्षेत्रफल र उचाईको विवरण </b></h4>
                                    <div class="col-md-12">
                                        <div class="table-responsive mt-1">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    <tr>
                                                        <th>क्र.स</th>
                                                        <th>तल्ला</th>
                                                        <th>प्रस्तावित निर्माणको क्षेत्रफल</th>
                                                        <th>साविक निर्माणको क्षेत्रफल</th>
                                                        <th>जम्मा क्षेत्रफल</th>
                                                        <th>उचाई</th>
                                                    </tr>
                                                </tbody>
                                                @foreach ($mapApply->storeyDetails as $storeyDetail)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $storeyDetail->mapFee?->storey ?? '' }}</td>
                                                        <td>{{ $storeyDetail->area_of_proposed_construction }}</td>
                                                        <td>{{ $storeyDetail->area_of_former_construction }}</td>
                                                        <td>{{ $storeyDetail->total_area }}</td>
                                                        <td>{{ $storeyDetail->height }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mx-2">
                        <legend>
                            <h5 class="py-2">२. जग्गाको विवरण</h5>
                        </legend>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>२.१ भू-उपयोग्य क्षेत्र :</b>
                                    {{ $mapApply->landDetail?->landUseArea?->title ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>२.२ वडा नं :</b> {{ $mapApply->landDetail?->ward_no ?? '' }}
                                </h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>२.३ साविक वडा नं :</b>
                                    {{ $mapApply->landDetail?->ward_no ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>२.४ टोलको नाम :</b>
                                    {{ $mapApply->landDetail?->tole ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>२.५ सडक कोड नं :</b>
                                    {{ $mapApply->landDetail?->street_code_no ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>२.६ जग्गा कित्ता नं :</b>
                                    {{ $mapApply->landDetail?->plot_no ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>२.७ क्षेत्रफल (बिघा) :</b>
                                    {{ $mapApply->landDetail?->unit_value ?? '' }}</h4>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label">
                                    <b>२.८ भवनले
                                        ढाक्ने क्षेत्रफलको प्रतिशत (GCR) :</b>
                                    {{ $mapApply->landDetail?->percentage_of_area_covered_by_building ?? '' }}
                                </h4>

                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mx-2">
                        <legend>
                            <h5 class="py-2">३. जग्गा धनीको विवरण</h5>
                        </legend>
                        <div class="mb-3">
                            <h4 class="form-label"><b>३.१ जग्गा धनीको किसिम :</b>
                                {{ $mapApply->landOwner?->land_owner_type->label() ?? '' }}</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.१ जग्गा धनीको नाम :</b> {{ $mapApply->landOwner?->name ?? '' }}
                                </h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.२ फोन नं. :</b> {{ $mapApply->landOwner?->phone ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.३ बुवाको नाम :</b>
                                    {{ $mapApply->landOwner?->father_name ?? '' }}
                                </h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.४ हजुरबुबाको नाम :</b>
                                    {{ $mapApply->landOwner?->grandfather_name ?? '' }}
                                </h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.६ नागरिकता नम्बर :</b>
                                    {{ $mapApply->landOwner?->citizenship_no ?? '' }}
                                </h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.७ नागरिकता लिएको मिति :</b>
                                    {{ $mapApply->landOwner?->citizenship_issue_date ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.५ नागरिकता लिएको जिल्ला :</b>
                                    {{ $mapApply->landOwner?->citizenship_issue_district_id ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.८ ठेगाना :</b> {{ $mapApply->landOwner?->address ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.९ पालिका :</b> {{ $mapApply->landOwner?->local_body ?? '' }}
                                </h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.१० वडा नं. :</b> {{ $mapApply->landOwner?->ward_no ?? '' }}
                                </h4>

                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mx-2">
                        <legend>
                            <h5 class="py-2">४. घर धनीको विवरण (जग्गाधनी भन्दा फरक भएमा)</h5>
                        </legend>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <h4 for="detail_check">के घर धनीको विवरण र जग्गाधनीको विवरण एउटै हो ?</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.१ जग्गा धनीको नाम :</b>
                                    {{ $mapApply->houseOwner?->name ?? '' }} </h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.२ फोन नं. :</b>
                                    {{ $mapApply->houseOwner?->phone ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.३ बुवाको नाम :</b>
                                    {{ $mapApply->houseOwner?->father_name ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.४ हजुरबुबाको नाम :</b>
                                    {{ $mapApply->houseOwner?->grandfather_name ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.६ नागरिकता नम्बर :</b>
                                    {{ $mapApply->houseOwner?->citizenship_no ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.७ नागरिकता लिएको मिति :</b>
                                    {{ $mapApply->houseOwner?->citizenship_issue_date ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.५ नागरिकता लिएको
                                        जिल्ला
                                        :</b> {{ $mapApply->houseOwner?->citizenship_issue_district_id ?? '' }}
                                </h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.८ ठेगाना :</b>
                                    {{ $mapApply->houseOwner?->address ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.९ पालिका :</b>
                                    {{ $mapApply->houseOwner?->local_body ?? '' }}</h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.१० वडा नं. :</b>
                                    {{ $mapApply->houseOwner?->ward_no ?? '' }}</h4>

                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="mx-2 my-2">
                        <legend>५. चार किल्लाको विवरण</legend>
                        <div class="table-responsive">
                            <table class="table table-sm table-responsive table-bordered">
                                <thead>
                                    <tr>
                                        <th width="20%">विवरण</th>
                                        <th>पूर्व</th>
                                        <th>पश्चिम</th>
                                        <th>उत्तर</th>
                                        <th>दक्षिण</th>
                                    </tr>
                                </thead>
                                @foreach ($mapApply->fourForts as $fourFort)
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $fourFort->detail?->label() }}
                                            </td>
                                            <td>{{ $fourFort->east }}</td>
                                            <td>{{ $fourFort->west }}</td>
                                            <td>{{ $fourFort->north }}</td>
                                            <td>{{ $fourFort->south }}</td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </fieldset>

                    <fieldset class="mx-2">
                        <legend>
                            <h5 class="py-2">६. डिजाइनरको विवरण</h5>
                        </legend>
                        @foreach ($mapApply->designerDetails as $designerDetail)
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <h4><b>१.१ {{ $designerDetail->post?->label() }}</b></h4>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"> नाम :
                                        {{ $designerDetail->name }} </h4>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"> बुवाको नाम :
                                        {{ $designerDetail->father_name }}</h4>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"> हजुरबुबाको नाम :
                                        {{ $designerDetail->grandfather_name }}</h4>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"> फोन नं. :
                                        {{ $designerDetail->phone }}</h4>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"> ठेगाना :
                                        {{ $designerDetail->address }}</h4>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"> पालिका :
                                        {{ $designerDetail->local_body }}</h4>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"> वडा नं. :
                                        {{ $designerDetail->ward_no }}</h4>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"> NEC Council No :
                                        {{ $designerDetail->nec_council_no }}</h4>

                                </div>
                                <div class="col-md-4 mb-3">
                                    <h4 class="form-label"> पालिका दर्ता नं. :
                                        {{ $designerDetail->local_body_registration_no }}</h4>

                                </div>
                            </div>
                        @endforeach

                    </fieldset>


                    <fieldset class="mx-2">
                        <legend>
                            <h5 class="py-2">७. निवेदकको विवरण</h5>
                        </legend>
                        <div class="mb-3">
                            <h4 class="form-label"><b>५.१ निवेदकको प्रकार :</b>
                                {{ $mapApply->applicantDetail?->applicant_type?->label() }}</h4>

                        </div>
                        <div class="mb-3">
                            <h4 class="form-label"><b>५.२ घरधनी सँगको सम्बन्ध :</b>
                                {{ $mapApply->applicantDetail?->relation_with_owner?->label() }}</h4>

                        </div>
                        <div class="row">
                            <h4 class="form-label fw-bold mb-2">जग्गाधनी वा घरधनी भन्दा फरक भएमा</h4>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.१ नाम :</b> {{ $mapApply->applicantDetail?->name }}</h4>
                            </div>

                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.२ फोन नं. :</b> {{ $mapApply->applicantDetail?->phone }}</h4>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.३ बुवाको नाम :</b>
                                    {{ $mapApply->applicantDetail?->father_name }}
                                </h4>

                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.४ नागरिकता लिएको
                                        जिल्ला :</b> {{ $mapApply->applicantDetail?->citizenship_issue_district_id }}
                                </h4>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h4 class="form-label"><b>१.५ नागरिकत नम्बर :</b>
                                    {{ $mapApply->applicantDetail?->citizenship_no }}</h4>

                            </div>
                            <div class="col-md-4 mb-4">
                                <h4 class="form-label"><b>१.६ नागरिकता लिएको मिति :</b>
                                    {{ $mapApply->applicantDetail?->citizenship_issue_date }}</h4>

                            </div>

                        </div>

                    </fieldset>
                    <div class="d-flex justify-content-between my-3 px-2">
                        <div class="col-3">
                            <h4 class="form-label fw-bold">निबेदनको मिति :
                                {{ $mapApply->applicantDetail?->application_date }}
                            </h4>

                        </div>
                        <div class="col-3">
                            <h4 class="form-label fw-bold">निवेदकको सहि :
                                <img src="{{ $mapApply->applicantDetail?->signature_url }}" height="80"
                                    width="80" alt="Signature">
                            </h4>
                        </div>
                    </div>


                    <h4 class="fw-bold mt-3 text center text-black">निर्माण हुने भवन तथा मापदण्ड सम्बन्धि संक्षिप्त
                        विवरण
                    </h4>
                    <fieldset class="mx-2 ">
                        <legend class="py-2">मापदण्ड सम्बन्धि विवरण</legend>
                        <div class="col-md-12">
                            <div class="table-responsive mt-1">
                                <table class="table table-sm table-responsive table-bordered">
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
                                        @foreach ($mapApply->CriteriaDetails as $criteriaDetail)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <label for="name">
                                                        {{ $criteriaDetail->detail?->label() }}
                                                    </label>
                                                </td>
                                                <td>
                                                    {{ $criteriaDetail->according_to_criteria }}
                                                </td>
                                                <td>
                                                    {{ $criteriaDetail->according_to_map }}
                                                </td>
                                                <td>
                                                    {{ $criteriaDetail->compliance }}
                                                </td>
                                                <td>
                                                    {{ $criteriaDetail->remarks }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="my-3 mx-2">
                        <legend class="py-2">भवन सम्बन्धि विवरण</legend>
                        <table class="table table-sm table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.सं</th>
                                    <th colspan="2" class="text-center">विवरण</th>
                                    <th>कैफियत</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapApply->buildingDetails as $buildingDetail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $buildingDetail->detail?->label() }}

                                        </td>
                                        <td>
                                            {{ $buildingDetail->description }}
                                        </td>
                                        <td>
                                            {{ $buildingDetail->remarks }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </fieldset>

                    <div class="d-flex flex-column align-items-end">
                        <div class="col-4">
                            <div class="mb-1">


                            </div>
                            <div class="mb-1">
                                <h4 class="form-label" for="applyMap.consultant_signature">(कन्सल्टेन्ट इंन्जिनियरको
                                    सहि) : <img src="{{ $mapApply->consultant_signature_url }}" height="80"
                                        width="80" alt="Signature"></h4>
                                <div class="mb-1">
                                    <label class="form-label" for="applyMap.consultant_name">नाम :
                                        {{ $mapApply->consultant_name }}</label>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label" for="applyMap.consultant_mobile_no">मोबाइल नं. :
                                        {{ $mapApply->consultant_mobile_no }}</label>
                                </div>
                                <div class="mb-1">
                                    <label for="applyMap.consultant_nec_no"><b>एन. ई. सी. नं :
                                            {{ $mapApply->consultant_nec_no }} </b></label>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($mapApply->attachDocument))
        <div class="card">
            <div class="card-header">
                <h4 class="header-title mb-0">कागजातहरू</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i
                                                    class="fa {{ getFileIconClass($mapApply->attachDocument?->land_owner_document ?? '') }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                            onclick="openFileModal('जग्गा धनी प्रमाणपत्र प्रतिलिपि', '{{ pathinfo($mapApply->attachDocument?->land_owner_document ?? '', PATHINFO_EXTENSION) }}', '{{ $mapApply->attachDocument->land_owner_document }}')"
                                            class="text-muted fw-medium" type="button">जग्गा धनी प्रमाणपत्र प्रतिलिपि
                                            .{{ pathinfo($mapApply->attachDocument?->land_owner_document ?? '', PATHINFO_EXTENSION) }}</a>
                                        <p class="mb-0 font-13">
                                            {{ convert_to_highest_unit($mapApply->attachDocument?->land_owner_document_size ?? '') }}
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ route('admin.file-url-download', ['file_url' => $mapApply->attachDocument?->getRawOriginal('land_owner_document')]) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $mapApply->attachDocument?->land_owner_document ?? '' }}"
                                            alt="" style="max-width: 100%;height: 200px;object-fit: contain;">
                                        <form
                                            action="{{ route('emap.admin.map.mapApply.updateDocumentStatus', $mapApply) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <div class="input-group d-flex align-items-center">
                                                <select class="form-select form-select-sm"
                                                    name="land_owner_document_status" id="land_owner_document_status"
                                                    aria-label="Example select with button addon">
                                                    <option value="" disabled selected>--- छान्नुहोस् ---</option>
                                                    <option value="pending"
                                                        {{ $mapApply->attachDocument?->land_owner_document_status == 'pending' ? 'selected' : '' }}>
                                                        प्रक्रियामा</option>
                                                    <option value="accept"
                                                        {{ $mapApply->attachDocument?->land_owner_document_status == 'accept' ? 'selected' : '' }}>
                                                        स्वीकार
                                                    </option>
                                                    <option value="reject"
                                                        {{ $mapApply->attachDocument?->land_owner_document_status == 'reject' ? 'selected' : '' }}>
                                                        अस्वीकार</option>

                                                </select>
                                                <button class="btn btn-lg btn-outline-primary" type="submit"><i
                                                        class="fa fa-paper-plane"></i></button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i
                                                    class="fa {{ getFileIconClass($mapApply->attachDocument?->land_revenue_document ?? '') }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                            onclick="openFileModal('चालु आर्थिक वर्षको मालपोत तिरेको रसिदको प्रतिलिपि', '{{ pathinfo($mapApply->attachDocument?->land_revenue_document ?? '', PATHINFO_EXTENSION) }}', '{{ $mapApply->attachDocument->land_revenue_document }}')"
                                            class="text-muted fw-medium" type="button">चालु आर्थिक वर्षको मालपोत तिरेको
                                            रसिदको प्रतिलिपि
                                            .{{ pathinfo($mapApply->attachDocument?->land_revenue_document ?? '', PATHINFO_EXTENSION) }}</a>
                                        <p class="mb-0 font-13">
                                            {{ convert_to_highest_unit($mapApply->attachDocument?->land_revenue_document_size ?? '') }}
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ route('admin.file-url-download', ['file_url' => $mapApply->attachDocument?->getRawOriginal('land_revenue_document')]) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $mapApply->attachDocument?->land_revenue_document ?? '' }}"
                                            alt="" style="max-width: 100%;height: 200px;object-fit: contain;">
                                        <form
                                            action="{{ route('emap.admin.map.mapApply.updateDocumentStatus', $mapApply) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <div class="input-group d-flex align-items-center">
                                                <select class="form-select form-select-sm"
                                                    name="land_revenue_document_status" id="land_revenue_document_status"
                                                    aria-label="Example select with button addon">
                                                    <option value="" disabled selected>--- छान्नुहोस् ---</option>
                                                    <option value="pending"
                                                        {{ $mapApply->attachDocument?->land_revenue_document_status == 'pending' ? 'selected' : '' }}>
                                                        प्रक्रियामा</option>
                                                    <option value="accept"
                                                        {{ $mapApply->attachDocument?->land_revenue_document_status == 'accept' ? 'selected' : '' }}>
                                                        स्वीकार
                                                    </option>
                                                    <option value="reject"
                                                        {{ $mapApply->attachDocument?->land_revenue_document_status == 'reject' ? 'selected' : '' }}>
                                                        अस्वीकार</option>

                                                </select>
                                                <button class="btn btn-lg btn-outline-primary" type="submit"><i
                                                        class="fa fa-paper-plane"></i></button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i
                                                    class="fa {{ getFileIconClass($mapApply->attachDocument?->land_owner_citizenship ?? '') }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                            onclick="openFileModal('ज.ध. दर्ता प्रमाण पुर्जामा फोटो नभएको भए नागरिकता प्रमाणपत्रको प्रतिलिपि', '{{ pathinfo($mapApply->attachDocument?->land_owner_citizenship ?? '', PATHINFO_EXTENSION) }}', '{{ $mapApply->attachDocument?->land_owner_citizenship }}')"
                                            class="text-muted fw-medium" type="button">ज.ध. दर्ता प्रमाण पुर्जामा फोटो
                                            नभएको
                                            भए नागरिकता प्रमाणपत्रको प्रतिलिपि
                                            .{{ pathinfo($mapApply->attachDocument?->land_owner_citizenship ?? '', PATHINFO_EXTENSION) }}</a>
                                        <p class="mb-0 font-13">
                                            {{ convert_to_highest_unit($mapApply->attachDocument?->land_owner_citizenship_size ?? '') }}
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ route('admin.file-url-download', ['file_url' => $mapApply->attachDocument?->getRawOriginal('land_owner_citizenship')]) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $mapApply->attachDocument?->land_owner_citizenship ?? '' }}"
                                            alt="" style="max-width: 100%;height: 200px;object-fit: contain;">
                                        <form
                                            action="{{ route('emap.admin.map.mapApply.updateDocumentStatus', $mapApply) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <div class="input-group d-flex align-items-center">
                                                <select class="form-select form-select-sm"
                                                    name="land_owner_citizenship_status"
                                                    id="land_owner_citizenship_status"
                                                    aria-label="Example select with button addon">
                                                    <option value="" disabled selected>--- छान्नुहोस् ---</option>
                                                    <option value="pending"
                                                        {{ $mapApply->attachDocument?->land_owner_citizenship_status == 'pending' ? 'selected' : '' }}>
                                                        प्रक्रियामा</option>
                                                    <option value="accept"
                                                        {{ $mapApply->attachDocument?->land_owner_citizenship_status == 'accept' ? 'selected' : '' }}>
                                                        स्वीकार
                                                    </option>
                                                    <option value="reject"
                                                        {{ $mapApply->attachDocument?->land_owner_citizenship_status == 'reject' ? 'selected' : '' }}>
                                                        अस्वीकार</option>

                                                </select>
                                                <button class="btn btn-lg btn-outline-primary" type="submit"><i
                                                        class="fa fa-paper-plane"></i></button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i
                                                    class="fa {{ getFileIconClass($mapApply->attachDocument?->blue_print ?? '') }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                            onclick="openFileModal('कि . न. स्पष्ट भएको नापी प्रमाणित नक्शा (ब्लु प्रिन्ट)', '{{ pathinfo($mapApply->attachDocument?->blue_print ?? '', PATHINFO_EXTENSION) }}', '{{ $mapApply->attachDocument?->blue_print }}')"
                                            class="text-muted fw-medium" type="button">कि . न. स्पष्ट भएको नापी प्रमाणित
                                            नक्शा (ब्लु
                                            प्रिन्ट)
                                            .{{ pathinfo($mapApply->attachDocument?->blue_print ?? '', PATHINFO_EXTENSION) }}</a>
                                        <p class="mb-0 font-13">
                                            {{ convert_to_highest_unit($mapApply->attachDocument?->blue_print_size ?? '') }}
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ route('admin.file-url-download', ['file_url' => $mapApply->attachDocument?->getRawOriginal('blue_print')]) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $mapApply->attachDocument?->blue_print ?? '' }}" alt=""
                                            style="max-width: 100%;height: 200px;object-fit: contain;">
                                        <form
                                            action="{{ route('emap.admin.map.mapApply.updateDocumentStatus', $mapApply) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <div class="input-group d-flex align-items-center">
                                                <select class="form-select form-select-sm" name="blue_print_status"
                                                    id="blue_print_status" aria-label="Example select with button addon">
                                                    <option value="" disabled selected>--- छान्नुहोस् ---</option>
                                                    <option value="pending"
                                                        {{ $mapApply->attachDocument?->blue_print_status == 'pending' ? 'selected' : '' }}>
                                                        प्रक्रियामा</option>
                                                    <option value="accept"
                                                        {{ $mapApply->attachDocument?->blue_print_status == 'accept' ? 'selected' : '' }}>
                                                        स्वीकार
                                                    </option>
                                                    <option value="reject"
                                                        {{ $mapApply->attachDocument?->blue_print_status == 'reject' ? 'selected' : '' }}>
                                                        अस्वीकार</option>

                                                </select>
                                                <button class="btn btn-lg btn-outline-primary" type="submit"><i
                                                        class="fa fa-paper-plane"></i></button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i
                                                    class="fa {{ getFileIconClass($mapApply->attachDocument?->pass_document ?? '') }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                            onclick="openFileModal('पास गरिने नक्शाको फोटोकपी वा ब्लुप्रिन्ट(डीजाईनर र नक्शावालाको हस्ताक्षर सहित)', '{{ pathinfo($mapApply->attachDocument?->pass_document ?? '', PATHINFO_EXTENSION) }}', '{{ $mapApply->attachDocument?->pass_document }}')"
                                            class="text-muted fw-medium" type="button">पास गरिने नक्शाको फोटोकपी वा
                                            ब्लुप्रिन्ट
                                            (डीजाईनर र नक्शावालाको हस्ताक्षर सहित)
                                            .{{ pathinfo($mapApply->attachDocument?->pass_document ?? '', PATHINFO_EXTENSION) }}</a>
                                        <p class="mb-0 font-13">
                                            {{ convert_to_highest_unit($mapApply->attachDocument?->pass_document_size ?? '') }}
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ route('admin.file-url-download', ['file_url' => $mapApply->attachDocument?->getRawOriginal('pass_document')]) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $mapApply->attachDocument?->pass_document ?? '' }}" alt=""
                                            style="max-width: 100%;height: 200px;object-fit: contain;">
                                        <form
                                            action="{{ route('emap.admin.map.mapApply.updateDocumentStatus', $mapApply) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <div class="input-group d-flex align-items-center">
                                                <select class="form-select form-select-sm" name="pass_document_status"
                                                    id="pass_document_status"
                                                    aria-label="Example select with button addon">
                                                    <option value="" disabled selected>--- छान्नुहोस् ---</option>
                                                    <option value="pending"
                                                        {{ $mapApply->attachDocument?->pass_document_status == 'pending' ? 'selected' : '' }}>
                                                        प्रक्रियामा</option>
                                                    <option value="accept"
                                                        {{ $mapApply->attachDocument?->pass_document_status == 'accept' ? 'selected' : '' }}>
                                                        स्वीकार
                                                    </option>
                                                    <option value="reject"
                                                        {{ $mapApply->attachDocument?->pass_document_status == 'reject' ? 'selected' : '' }}>
                                                        अस्वीकार</option>

                                                </select>
                                                <button class="btn btn-lg btn-outline-primary" type="submit"><i
                                                        class="fa fa-paper-plane"></i></button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i
                                                    class="fa {{ getFileIconClass($mapApply->attachDocument?->designer_document ?? '') }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                            onclick="openFileModal('डीजाईनरको इजाजतपत्रको नवीकरण सहितको फोटोकपी (सरोकारवालाबाट प्रमाणित)', '{{ pathinfo($mapApply->attachDocument?->designer_document ?? '', PATHINFO_EXTENSION) }}', '{{ $mapApply->attachDocument?->designer_document }}')"
                                            class="text-muted fw-medium" type="button">डीजाईनरको इजाजतपत्रको नवीकरण
                                            सहितको
                                            फोटोकपी (सरोकारवालाबाट प्रमाणित)
                                            .{{ pathinfo($mapApply->attachDocument?->designer_document ?? '', PATHINFO_EXTENSION) }}</a>
                                        <p class="mb-0 font-13">
                                            {{ convert_to_highest_unit($mapApply->attachDocument?->designer_document_size ?? '') }}
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ route('admin.file-url-download', ['file_url' => $mapApply->attachDocument?->getRawOriginal('designer_document')]) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $mapApply->attachDocument?->designer_document ?? '' }}"
                                            alt="" style="max-width: 100%;height: 200px;object-fit: contain;">
                                        <form
                                            action="{{ route('emap.admin.map.mapApply.updateDocumentStatus', $mapApply) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <div class="input-group d-flex align-items-center">
                                                <select class="form-select form-select-sm" name="designer_document_status"
                                                    id="designer_document_status"
                                                    aria-label="Example select with button addon">
                                                    <option value="" disabled selected>--- छान्नुहोस् ---</option>
                                                    <option value="pending"
                                                        {{ $mapApply->attachDocument?->designer_document_status == 'pending' ? 'selected' : '' }}>
                                                        प्रक्रियामा</option>
                                                    <option value="accept"
                                                        {{ $mapApply->attachDocument?->designer_document_status == 'accept' ? 'selected' : '' }}>
                                                        स्वीकार
                                                    </option>
                                                    <option value="reject"
                                                        {{ $mapApply->attachDocument?->designer_document_status == 'reject' ? 'selected' : '' }}>
                                                        अस्वीकार</option>

                                                </select>
                                                <button class="btn btn-lg btn-outline-primary" type="submit"><i
                                                        class="fa fa-paper-plane"></i></button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i
                                                    class="fa {{ getFileIconClass($mapApply->attachDocument?->permission_document ?? '') }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                            onclick="openFileModal('मन्जुरी लिई बनाउने भएमा नक्शा वालाले कानुन शाखाको रोहवरमा भएको मन्जुरीनामाको सक्क्ल', '{{ pathinfo($mapApply->attachDocument?->permission_document ?? '', PATHINFO_EXTENSION) }}', '{{ $mapApply->attachDocument?->permission_document }}')"
                                            class="text-muted fw-medium" type="button">मन्जुरी लिई बनाउने भएमा नक्शा
                                            वालाले
                                            कानुन शाखाको रोहवरमा भएको मन्जुरीनामाको सक्क्ल
                                            .{{ pathinfo($mapApply->attachDocument?->permission_document ?? '', PATHINFO_EXTENSION) }}</a>
                                        <p class="mb-0 font-13">
                                            {{ convert_to_highest_unit($mapApply->attachDocument?->permission_document_size ?? '') }}
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ route('admin.file-url-download', ['file_url' => $mapApply->attachDocument?->getRawOriginal('permission_document')]) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $mapApply->attachDocument?->permission_document ?? '' }}"
                                            alt="" style="max-width: 100%;height: 200px;object-fit: contain;">
                                        <form
                                            action="{{ route('emap.admin.map.mapApply.updateDocumentStatus', $mapApply) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <div class="input-group d-flex align-items-center">
                                                <select class="form-select form-select-sm"
                                                    name="permission_document_status" id="permission_document_status"
                                                    aria-label="Example select with button addon">
                                                    <option value="" disabled selected>--- छान्नुहोस् ---</option>
                                                    <option value="pending"
                                                        {{ $mapApply->attachDocument?->permission_document_status == 'pending' ? 'selected' : '' }}>
                                                        प्रक्रियामा</option>
                                                    <option value="accept"
                                                        {{ $mapApply->attachDocument?->permission_document_status == 'accept' ? 'selected' : '' }}>
                                                        स्वीकार
                                                    </option>
                                                    <option value="reject"
                                                        {{ $mapApply->attachDocument?->permission_document_status == 'reject' ? 'selected' : '' }}>
                                                        अस्वीकार</option>

                                                </select>
                                                <button class="btn btn-lg btn-outline-primary" type="submit"><i
                                                        class="fa fa-paper-plane"></i></button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i
                                                    class="fa {{ getFileIconClass($mapApply->attachDocument?->inheritance_document ?? '') }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                            onclick="openFileModal('वारेश राखि नक्सा पास गर्ने भए वारिसको प्रमाणितको प्रतिलिपि', '{{ pathinfo($mapApply->attachDocument?->inheritance_document ?? '', PATHINFO_EXTENSION) }}', '{{ $mapApply->attachDocument?->inheritance_document }}')"
                                            class="text-muted fw-medium" type="button">वारेश राखि नक्सा पास गर्ने भए
                                            वारिसको
                                            प्रमाणितको प्रतिलिपि
                                            .{{ pathinfo($mapApply->attachDocument?->inheritance_document ?? '', PATHINFO_EXTENSION) }}</a>
                                        <p class="mb-0 font-13">
                                            {{ convert_to_highest_unit($mapApply->attachDocument?->inheritance_document_size ?? '') }}
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ route('admin.file-url-download', ['file_url' => $mapApply->attachDocument?->getRawOriginal('inheritance_document')]) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <img src="{{ $mapApply->attachDocument?->inheritance_document ?? '' }}"
                                            alt="" style="max-width: 100%;height: 200px;object-fit: contain;">
                                        <form
                                            action="{{ route('emap.admin.map.mapApply.updateDocumentStatus', $mapApply) }}"
                                            method="post">
                                            @csrf
                                            @method('put')
                                            <div class="input-group d-flex align-items-center">
                                                <select class="form-select form-select-sm"
                                                    name="inheritance_document_status" id="inheritance_document_status"
                                                    aria-label="Example select with button addon">
                                                    <option value="" disabled selected>--- छान्नुहोस् ---</option>
                                                    <option value="pending"
                                                        {{ $mapApply->attachDocument?->inheritance_document_status == 'pending' ? 'selected' : '' }}>
                                                        प्रक्रियामा</option>
                                                    <option value="accept"
                                                        {{ $mapApply->attachDocument?->inheritance_document_status == 'accept' ? 'selected' : '' }}>
                                                        स्वीकार
                                                    </option>
                                                    <option value="reject"
                                                        {{ $mapApply->attachDocument?->inheritance_document_status == 'reject' ? 'selected' : '' }}>
                                                        अस्वीकार</option>

                                                </select>
                                                <button class="btn btn-lg btn-outline-primary" type="submit"><i
                                                        class="fa fa-paper-plane"></i></button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="card shadow-none border">
                            <div class="p-2">
                                <div class="row align-items-center">
                                    <div class="col-2 pe-0">
                                        <div class="avatar-sm">
                                            <span class="avatar-title bg-light text-secondary rounded">
                                                <i
                                                    class="fa {{ getFileIconClass($mapApply->attachDocument?->analysis_document ?? '') }} font-18"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-8">
                                        <a href="javascript:void(0);"
                                            onclick="openFileModal('Analysis Document', '{{ pathinfo($mapApply->attachDocument?->analysis_document ?? '', PATHINFO_EXTENSION) }}', '{{ $mapApply->attachDocument?->analysis_document }}')"
                                            class="text-muted fw-medium" type="button">Analysis Document
                                            .{{ pathinfo($mapApply->attachDocument?->analysis_document ?? '', PATHINFO_EXTENSION) }}</a>
                                        <p class="mb-0 font-13">
                                            {{ convert_to_highest_unit(intval($mapApply->attachDocument?->analysis_document_size ?? '')) }}
                                        </p>
                                        <div class="col-2">
                                            <a href="{{ route('admin.file-url-download', ['file_url' => $mapApply->attachDocument?->getRawOriginal('analysis_document')]) }}"
                                                class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <img src="{{ $mapApply->attachDocument?->analysis_document ?? '' }}"
                                                alt="" style="max-width: 100%;height: 200px;object-fit: contain;">
                                            <form
                                                action="{{ route('emap.admin.map.mapApply.updateDocumentStatus', $mapApply) }}"
                                                method="post">
                                                @csrf
                                                @method('put')
                                                <div class="input-group d-flex align-items-center">
                                                    <select class="form-select form-select-sm"
                                                        name="analysis_document_status" id="analysis_document_status"
                                                        aria-label="Example select with button addon">
                                                        <option value="" disabled selected>--- छान्नुहोस् ---
                                                        </option>
                                                        <option value="pending"
                                                            {{ $mapApply->attachDocument?->analysis_document_status == 'pending' ? 'selected' : '' }}>
                                                            प्रक्रियामा</option>
                                                        <option value="accept"
                                                            {{ $mapApply->attachDocument?->analysis_document_status == 'accept' ? 'selected' : '' }}>
                                                            स्वीकार
                                                        </option>
                                                        <option value="reject"
                                                            {{ $mapApply->attachDocument?->analysis_document_status == 'reject' ? 'selected' : '' }}>
                                                            अस्वीकार</option>

                                                    </select>
                                                    <button class="btn btn-lg btn-outline-primary" type="submit"><i
                                                            class="fa fa-paper-plane"></i></button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.inc.file-view');
            </div>
        </div>
    @endif
   
@endsection
