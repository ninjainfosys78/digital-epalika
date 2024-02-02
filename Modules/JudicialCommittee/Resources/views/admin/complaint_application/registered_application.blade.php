@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.judicialCommittee.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">दर्ता भएका उजुरी</li>
                    </ol>
                </div>
                <h4 class="page-title">दर्ता भएका उजुरी</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header search-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">दर्ता भएका उजुरीहरु</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive-md">
                        <table class="table table-sm table-custom">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>सबमिशन नं.</th>
                                <th>दर्ता नं.</th>
                                <th>निवेदकको पुरा नाम</th>
                                <th>मिति</th>
                                <th>विषय</th>
                                <th>मुद्दा प्रकृति</th>
                                <th class="text-center">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($complaintApplications as $complaintApplication)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$complaintApplication->submission_no}}</td>
                                    <td>{{ $complaintApplication->registration_no }}</td>
                                    <td>{{ $complaintApplication->applicant_name }}</td>
                                    <td>{{ $complaintApplication->date }}</td>
                                    <td>{{ $complaintApplication->subject }}</td>
                                    <td>
                                        {{ $complaintApplication->lawsuitNature->title ?? '' }}
                                    </td>
                                    <td class="d-flex">
                                        <div class="btn-group dropstart">
                                            <a style="width:75px;" href="{{route('admin.judicialCommittee.complaintApplication.show',$complaintApplication)}}"
                                               class="btn btn-sm me-1 btn-primary">
                                                <i class="fa fa-eye"> विवरण </i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-sm btn-info waves-effect waves-light dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                            <div class="dropdown-menu" style="">
                                                @can('judicialReceiptBill_access')
                                                    <a href="{{ route('admin.judicialCommittee.complaintApplication.judicialReceiptBill.index', $complaintApplication) }}"
                                                       class="dropdown-item">
                                                        <i class="fa fa-cash-register"> निस्सा सनाखत </i>
                                                    </a>
                                                @endcan
                                                @if($complaintApplication->judicialReceiptBill)
                                                    @can('dateSheet_access')
                                                        <a href="{{ route('admin.judicialCommittee.complaintApplication.dateSheet.index', $complaintApplication) }}"
                                                           class="dropdown-item">
                                                            <i class="fa fa-calendar-alt"> तारिख पर्चा </i>
                                                        </a>
                                                    @endcan
                                                @endif
                                                @if($complaintApplication->date_sheets_count>0)
                                                    @can('defendantIssuedDeadline_access')
                                                        <a href="{{ route('admin.judicialCommittee.complaintApplication.defendantIssuedDeadline.index', $complaintApplication) }}"
                                                           class="dropdown-item">
                                                            <i class="fa fa-calendar-alt"> प्रतिवादी म्याद जारी </i>
                                                        </a>
                                                    @endcan
                                                @endif
                                                @if($complaintApplication->defendant_issued_deadlines_count>0)
                                                    @can('writtenAnswer_access')
                                                        <a href="{{ route('admin.judicialCommittee.complaintApplication.writtenAnswer.index', $complaintApplication) }}"
                                                           class="dropdown-item">
                                                            <i class="fa fa-calendar-alt"> लिखित जवाफ </i>
                                                        </a>
                                                    @endcan
                                                @endif
                                                @if($complaintApplication->written_answers_count>0)
                                                    @can('complaintDecision_access')
                                                        <a href="{{ route('admin.judicialCommittee.complaintApplication.complaintDecision.index', $complaintApplication) }}"
                                                           class="dropdown-item">
                                                            <i class="fa fa-file-alt"> निर्णयहरु </i>
                                                        </a>
                                                    @endcan
                                                @endif
                                                {{--                                                @can('dateCompensation_access')--}}
                                                {{--                                                    <a href="{{ route('admin.judicialCommittee.complaintApplication.dateCompensation.index', $complaintApplication) }}"--}}
                                                {{--                                                       class="dropdown-item">--}}
                                                {{--                                                        <i class="fa fa-calendar-alt"> तारिख भरपाई </i>--}}
                                                {{--                                                    </a>--}}
                                                {{--                                                @endcan--}}
                                                @if($complaintApplication->complaintDecision)
                                                    @can('conciliationApplication_access')
                                                        <a href="{{ route('admin.judicialCommittee.complaintApplication.conciliationApplication.index', $complaintApplication) }}"
                                                           class="dropdown-item">
                                                            <i class="fa fa-file"> मिलापत्रको निवेदन </i>
                                                        </a>
                                                    @endcan
                                                @endif
                                                @if($complaintApplication->conciliationApplication)
                                                    @can('conciliationVerification_access')
                                                        <a href="{{ route('admin.judicialCommittee.complaintApplication.conciliationVerification.index', $complaintApplication) }}"
                                                           class="dropdown-item">
                                                            <i class="fa fa-file-alt"> मिलापत्र प्रमाणीकरण आदेश </i>
                                                        </a>
                                                    @endcan
                                                @endif
                                                @if($complaintApplication->conciliationVerification)
                                                    @can('conciliation_access')
                                                        <a href="{{ route('admin.judicialCommittee.complaintApplication.conciliation.index', $complaintApplication) }}"
                                                           class="dropdown-item">
                                                            <i class="fa fa-file-alt"> मिलापत्र </i>
                                                        </a>
                                                    @endcan
                                                @endif
                                                <a href="{{ route('admin.judicialCommittee.complaintApplication.complaintLog.index', $complaintApplication) }}"
                                                   class="dropdown-item">
                                                    <i class="fa fa-tasks"> गतिविधिहरु </i>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="empty">
                                    <td></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $complaintApplications->onEachSide(config('app.pagination_count'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
