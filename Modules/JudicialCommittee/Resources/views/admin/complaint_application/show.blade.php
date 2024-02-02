@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">निवेदन फारम</li>
                    </ol>
                </div>
                <h4 class="page-title">निवेदन फारम</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">उजुरी फारम विवरण</h4>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.judicialCommittee.complaintApplication.index') }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> निवेदन फारम सूची
                            </a>
                            <a href="{{ route('admin.judicialCommittee.complaintApplication.judicialReceiptBill.create', $complaintApplication) }}"
                                class="btn btn-sm btn-outline-primary mx-1">
                                @if (!$complaintApplication->judicialReceiptBill)
                                    <i class="fa fa-plus-circle"> भुक्तानी गर्नुहोस्</i>
                                @else
                                    <i class="fa fa-edit"> भुक्तानी सम्पादन गर्नुहोस्</i>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills navtab-bg nav-justified" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#complaint-application" data-bs-toggle="tab" aria-expanded="true"
                                class="nav-link active" aria-selected="true" role="tab">
                                उजुरी फारम विवरण
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#complainant-application" data-bs-toggle="tab" aria-expanded="false" class="nav-link"
                                aria-selected="false" tabindex="-1" role="tab">
                                वादी दर्ता नालेस
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="complaint-application" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <span class="fw-bold">निवेदकको पुरा नाम : </span>
                                                {{ $complaintApplication->applicant_name }}
                                            </td>
                                            <td>
                                                <span class="fw-bold">निवेदकको फोन : </span>
                                                {{ $complaintApplication->applicant_phone }}
                                            </td>
                                            <td rowspan="4" class="text-center">
                                                <span class="fw-bold pb-2">निवेदकको सहि : </span> <br>
                                                <img src="{{ $complaintApplication->applicant_signature_url }}"
                                                    height="80" width="80" alt="Signature">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="fw-bold">निवेदकको ठेगाना : </span>
                                                {{ $complaintApplication->applicant_address }}
                                            </td>
                                            <td>
                                                <span class="fw-bold">सबमिशन नं. : </span>
                                                {{ $complaintApplication->submission_no }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="fw-bold">दर्ता नं. : </span>
                                                {{ $complaintApplication->registration_no }}
                                            </td>
                                            <td>
                                                <span class="fw-bold">मिति : </span> {{ $complaintApplication->date }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="fw-bold">विषय : </span> {{ $complaintApplication->subject }}
                                            </td>
                                            <td>
                                                <span class="fw-bold">मुद्दा प्रकृति : </span>
                                                {{ $complaintApplication->lawsuitNature->title ?? '' }}
                                                ({{ $complaintApplication->lawsuitNature->code ?? '' }})
                                            </td>
                                        </tr>
                                        @foreach (Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum::cases() as $complainantDefendantType)
                                            <tr>
                                                <td colspan="3" class="text-primary fw-bold border-bottom-0">
                                                    {{ $complainantDefendantType?->label() }}को विवरण
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm mb-0 table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>क्र.स.</th>
                                                                    <th>विवदको प्रकार</th>
                                                                    <th>नाम</th>
                                                                    <th>उमेर</th>
                                                                    <th>बुवाको नाम</th>
                                                                    <th>हजुरबुबाको नाम</th>
                                                                    <th>पति/पत्नी</th>
                                                                    <th>ठेगाना</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($complaintApplication->complainantDefendants->where('type', $complainantDefendantType) as $key => $complainant)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{$complainant->complain_type}}</td>
                                                                        <td>{{ $complainant->name }}</td>
                                                                        <td>{{ $complainant->age }}</td>
                                                                        <td>{{ $complainant->father_name }}</td>
                                                                        <td>{{ $complainant->grandfather_name }}</td>
                                                                        <td>{{ $complainant->spouse_name }}</td>
                                                                        <td>
                                                                            {{ $complainant->localBody->local_body ?? '' }}
                                                                            -{{ $complainant->ward_no }},{{ $complainant->tole }}
                                                                            ,{{ $complainant->district->district ?? '' }}
                                                                            ,{{ $complainant->province->province ?? '' }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="header-title mt-3">साक्षीहरु</h4>
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 table-bordered">
                                    <thead>
                                        <tr>
                                            <th>क्र.स.</th>
                                            <th>नाम</th>
                                            <th>उमेर</th>
                                            <th>फोन</th>
                                            <th>ठेगाना</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($complaintApplication->witnesses as $key=>$witness)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $witness->name }}</td>
                                                <td>{{ $witness->age }}</td>
                                                <td>{{ $witness->phone }}</td>
                                                <td>{{ $witness->address }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="5">
                                                    तालिकामा कुनै डाटा उपलब्ध छैन !!!
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="header-title mt-3">सम्बन्धित सदस्यहरू</h4>
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 table-bordered">
                                    <thead>
                                        <tr>
                                            <th>क्र.स.</th>
                                            <th>नाम</th>
                                            <th>फोन</th>
                                            <th>इमेल</th>
                                            <th>पद</th>
                                            <th>ठेगाना</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($complaintApplication->relatedMembers as $key=>$member)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->phone }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->designation }}</td>
                                                <td>{{ $member->address }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="6">
                                                    तालिकामा कुनै डाटा उपलब्ध छैन !!!
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="header-title mt-3">वादीको सम्बन्धित कागजातहरू</h4>
                            <div class="row">
                                @foreach ($complaintApplication->supportedDocuments->where('type', \Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum::COMPLAINANT) as $supportedDocument)
                                    <div class="col-md-4 mb-3">
                                        <div class="card border border-info">
                                            <div class="card-header d-flex justify-content-between">
                                                <h5 class="card-title">
                                                    {{ $supportedDocument->document_name }}
                                                </h5>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('admin.file-url-download', ['file_url' => $supportedDocument->document]) }}"
                                                        class="btn btn-xs btn-outline-primary mx-1">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.judicialCommittee.complaintApplication.supportedDocument.destroy', [$complaintApplication, $supportedDocument]) }}"
                                                        method="post">
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
                                                @if ($supportedDocument->extension === 'pdf')
                                                    <iframe src="{{ $supportedDocument->document_url }}" frameborder="0"
                                                        width="100%"></iframe>
                                                @elseif(in_array($supportedDocument->extension, ['png', 'jpg', 'jpeg']))
                                                    <img src="{{ $supportedDocument->document_url }}" class="card-image"
                                                        alt="Image" height=150px;" width="100%">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <h4 class="header-title mt-3">प्रतिवादीको सम्बन्धित कागजातहरू</h4>
                            <div class="row">
                                @foreach ($complaintApplication->supportedDocuments->where('type', \Modules\JudicialCommittee\Enums\ComplainantDefendantTypeEnum::DEFENDANT) as $supportedDocument)
                                    <div class="col-md-4 mb-3">
                                        <div class="card border border-info">
                                            <div class="card-header d-flex justify-content-between">
                                                <h5 class="card-title">
                                                    {{ $supportedDocument->document_name }}
                                                </h5>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('admin.file-url-download', ['file_url' => $supportedDocument->document]) }}"
                                                        class="btn btn-xs btn-outline-primary mx-1">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('admin.judicialCommittee.complaintApplication.supportedDocument.destroy', [$complaintApplication, $supportedDocument]) }}"
                                                        method="post">
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
                                                @if ($supportedDocument->extension === 'pdf')
                                                    <iframe src="{{ $supportedDocument->document_url }}" frameborder="0"
                                                        width="100%"></iframe>
                                                @elseif(in_array($supportedDocument->extension, ['png', 'jpg', 'jpeg']))
                                                    <img src="{{ $supportedDocument->document_url }}" class="card-image"
                                                        alt="Image" height=150px;" width="100%">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="complainant-application" role="tabpanel">
                            <div class="border mx-4 p-2 border-secondary">
                                <x-print-button title="वादी दर्ता नालेस" target-element="print-complainant-application" />
                                <div id="print-complainant-application">
                                    {!! $complaintApplication->getSpecificTemplateData(
                                        \Modules\JudicialCommittee\Enums\JudicialTemplateTypeEnum::COMPLAINANT_APPLICATION,
                                    ) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
