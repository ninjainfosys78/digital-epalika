@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">अपाङ्गता परिचय पत्र</li>
                        <li class="breadcrumb-item active">पूर्ण विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title"> अपाङ्गता परिचय पत्र</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">अपाङ्गता परिचय पत्रहरु</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-table" id="printData">
                        <table class="table  table-bordered table-hover table-responsive py-1">
                            <tbody>
                                <tr>
                                    @if (!is_null($disabilityIdentityCard->citizenship_no))
                                        <td>
                                            नागरिकता नं. : {{ get_nepali_number($disabilityIdentityCard->citizenship_no) }}
                                        </td>
                                    @else
                                        <td>
                                            जन्म दर्ता नं. :
                                            {{ get_nepali_number($disabilityIdentityCard->birth_registration_no) }}
                                        </td>
                                    @endif


                                    <td>
                                        परिचयपत्रको प्रकार
                                        :
                                        ({{ $disabilityIdentityCard->governmentalDisabilityType?->category->label() ?? '' }})
                                    </td>
                                    <td rowspan="4" class="text-center ">
                                        <img src="{{ $disabilityIdentityCard->photo_url }}"
                                            alt="{{ $disabilityIdentityCard->name }}"
                                            style="object-fit: cover; height: 6rem; width: 6rem; border: 1px solid var(--primary); border-radius: 10px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        आमाको नाम : {{ $disabilityIdentityCard->mother_name }}
                                    </td>
                                    <td>
                                        बाबुको नाम : {{ $disabilityIdentityCard->father_name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>जन्म मिति : {{ get_nepali_number($disabilityIdentityCard->dob) }}</td>
                                    <td> लिङ्ग : {{ $disabilityIdentityCard->gender?->label() ?? '' }}</td>
                                </tr>

                                <tr>
                                    <td>
                                        ठेगाना : {{ $disabilityIdentityCard->localBody->local_body ?? '' }}
                                        -{{ $disabilityIdentityCard->ward_no }}
                                        , {{ $disabilityIdentityCard->tole }}
                                    </td>
                                    <td>
                                        अपाङ्गताको प्रकार : {{ $disabilityIdentityCard->disabilityType->title ?? '' }}
                                    </td>
                                </tr>


                                <tr>
                                    <th colspan="3" class="text-center">संरक्षकको विवरण</th>
                                </tr>
                                <tr>
                                    <td>नाम: {{ $disabilityIdentityCard->guardian_name }}</td>
                                    <td> नाता : {{ $disabilityIdentityCard->relationship->title ?? '' }}</td>
                                    <td>फोन : {{ $disabilityIdentityCard->phone }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-center">पूर्ण विवरण</th>
                                </tr>
                                <tr>
                                    <td>अपाङ्गताको कारण: {{ $disabilityIdentityCard->disabilityReason->title ?? '' }}</td>
                                    <td> रक्त समुह : {{ $disabilityIdentityCard->blood_group->label() ?? '' }}</td>
                                    <td>सामाग्री विवरण: {{ $disabilityIdentityCard->material_description ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-center">दैनिक क्रियाकलाप गर्न</th>
                                </tr>
                                <tr>
                                    <td>पछिल्लो सैक्षिक योग्यता :
                                        {{ $disabilityIdentityCard->qualification->label() ?? '' }}</td>
                                    <td>दैनिक क्रियाकलाप गर्न :
                                        {{ $disabilityIdentityCard->daily_activity == 1 ? 'सक्ने' : ' नसक्ने' }}</td>
                                    <td>साहायक सामाग्री प्रयोग गर्ने :
                                        {{ $disabilityIdentityCard->daily_activity == 1 ? 'गरेको' : ' नगरेको' }}</td>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-center">अन्य व्यक्तिको सहयोग लिनु पर्ने भए त्यस्तो सहयोग
                                        लिनु पर्ने काम</th>
                                </tr>
                                <tr>
                                    <td>
                                        अन्य व्यक्तिको सहयोग लिनु पर्ने भए त्यस्तो सहयोग लिनु पर्ने काम :
                                        @if (!is_null($disabilityIdentityCard->helping_task))
                                            @if(is_array($disabilityIdentityCard->helping_task))
                                                @foreach ($disabilityIdentityCard->helping_task as $helpingTask)
                                                    {{ $helpingTask }}
                                                @endforeach
                                            @else
                                                {{ $disabilityIdentityCard->helping_task }}
                                            @endif
                                        @endif
                                    </td>

                                    <td>अन्य व्यक्तिको सहयोग बिना गर्न सक्ने दैनिक कार्य :
                                        @if (!is_null($disabilityIdentityCard->without_helping_task))
                                            @foreach ($disabilityIdentityCard->without_helping_task as $withoutHelpingTask)
                                                {{ $withoutHelpingTask }}
                                            @endforeach
                                        @endif
                                    <td>कुनै तालिम प्राप्त गरेको भए मुख्य तालिमको :
                                        {{ $disabilityIdentityCard->main_training_name ?? '' }}</td>

                                </tr>
                                <tr>
                                    <td>हालको पेसा : {{ $disabilityIdentityCard->Occupation->title ?? '' }}</td>
                                </tr>


                                <table class="table  table-bordered table-hover table-responsive py-1">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="text-center">संशोधन मिति</th>
                                        </tr>
                                        <tr>
                                            <th>परिचयपत्र लिएको पुरानो मिति</th>
                                            <th>परिचयपत्र लिएको हालसालै मिति</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($disabilityIdentityCard->identityRecords as $identityRecord)
                                            <tr>
                                                <td>{{ get_nepali_number($identityRecord->old_print_date) }}</td>
                                                <td>{{ get_nepali_number($identityRecord->print_date) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </tbody>
                        </table>


                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-around">
                                        <p> नागरिकता (आगाडी) </p>
                                        <a href="{{ route('admin.file-url-download', ['file_url' => $disabilityIdentityCard->getRawOriginal('document_photo')]) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        @if ($disabilityIdentityCard->document_photo)
                                            <img src="{{ asset($disabilityIdentityCard->document_photo) }}"
                                                alt="Document Photo"
                                                style="max-width: 100%; height: 200px; object-fit: contain;">
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-around">
                                        <p>नागरिकता (पछाडी)</p>
                                        <a href="{{ route('admin.file-url-download', ['file_url' => $disabilityIdentityCard->getRawOriginal('document_photo_back')]) }}"
                                            class="btn btn-xs btn-outline-primary">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        @if ($disabilityIdentityCard->document_photo_back)
                                            <img src="{{ asset($disabilityIdentityCard->document_photo_back) }}"
                                                alt="Document Photo"
                                                style="max-width: 100%; height: 200px; object-fit: contain;">
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
