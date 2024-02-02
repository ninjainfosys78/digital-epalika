@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">संगठन</li>
                    </ol>
                </div>
                <h4 class="page-title">संगठन </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{$organization->profile_photo_url}}" class="rounded-circle avatar-lg img-thumbnail"
                         alt="profile-image" style="width: 100px; height: 100px">

                    <h4 class="mt-2 text-black">{{$organization->name}}</h4>
                    {{--                    <p class="text-muted">@webdesigner</p>--}}
                    <a href="{{route('emap.admin.organization.update-login-status',$organization)}}"
                       class="btn btn-{{$organization->is_active==1 ?'success':'danger'}} btn-xs waves-effect mb-2 waves-light"
                       title="लग इन {{$organization->is_active==1 ?'गर्न मिल्छ':'गर्न मिल्दैन'}}">
                        <i class="fa  {{$organization->is_active==1 ?' fa-check':'fa-window-close'}}"></i>
                        लग इन स्थिति
                    </a>

                    <div class="text-start mt-3">

                        <p class="text-muted mb-2 font-15"><strong>नाम :</strong> <span
                                class="ms-2">{{$organization->name}}</span>
                        </p>
                        <p class="text-muted mb-2 font-15"><strong>इमेल :</strong><span
                                class="ms-2">{{$organization->email}}</span></p>

                        <p class="text-muted mb-2 font-15"><strong>फोन :</strong> <span
                                class="ms-2">{{$organization->phone}}</span></p>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-fill navtab-bg">
                        @if($organization->is_organization==0)
                            <li class="nav-item">
                                <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false"
                                   class="nav-link {{$organization->is_organization==0 ? 'active':''}}">
                                    व्यक्तिगत विवरण
                                </a>
                            </li>
                        @endif
                        @if($organization->is_organization==1)
                            <li class="nav-item">
                                <a href="#timeline" data-bs-toggle="tab" aria-expanded="true"
                                   class="nav-link {{$organization->is_organization==1 ? 'active':''}}">
                                    संगठनको विवरण
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                आवश्यक कागजात
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        @if($organization->is_organization==0)
                            <div class="tab-pane {{$organization->is_organization==0 ? 'show active':''}}" id="aboutme">
                                <table class="table table-sm mb-0 table-striped table-hover">
                                    <tr>
                                        <th>नाम</th>
                                        <td>{{$organization->userDetail->name_ne ?? ''}}
                                            ({{$organization->userDetail->name_en ?? ''}})
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>इमेल</th>
                                        <td>{{$organization->userDetail->email ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>फोन</th>
                                        <td>{{$organization->userDetail->phone ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>लिङ्ग</th>
                                        <td>{{ $organization->userDetail?->gender->label() }}</td>
                                    </tr>
                                    <tr>
                                        <th>बैबाहिक स्थिति</th>
                                        <td>{{ $organization->userDetail?->marital_status->label() }}</td>
                                    </tr>
                                    <tr>
                                        <th>बुवाको नाम</th>
                                        <td>{{$organization->userDetail->father_name ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>हजुरबुवाको नाम</th>
                                        <td>{{$organization->userDetail->grandfather_name ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>PAN नं</th>
                                        <td>{{$organization->userDetail->pan_no ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>NEC नं</th>
                                        <td>{{$organization->userDetail->nec_no ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>नागरिकता नं</th>
                                        <td>{{$organization->userDetail->citizenship_no ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>नागरिकता जारि भएको जिल्ला</th>
                                        <td>{{$organization->userDetail->citizenshipIssuedDistrict->district ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>नागरिकता जारि भएको मिति</th>
                                        <td>{{$organization->userDetail->citizenship_issued_date ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>स्थाई ठेगाना</th>
                                        <td>{{$organization->userDetail->permanentLocalBody->local_body ?? ''}}
                                            -{{$organization->userDetail->permanent_ward ?? ''}}
                                            , {{$organization->userDetail->permanent_tole ?? ''}}
                                            , {{$organization->userDetail->permanentDistrict->district ?? ''}}
                                            , {{$organization->userDetail->permanentProvince->province ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>अस्थाई ठेगाना</th>
                                        <td>{{$organization->userDetail->temporaryLocalBody->local_body ?? ''}}
                                            -{{$organization->userDetail->temporary_ward ?? ''}}
                                            , {{$organization->userDetail->temporary_tole ?? ''}}
                                            , {{$organization->userDetail->temporaryDistrict->district ?? ''}}
                                            , {{$organization->userDetail->temporaryProvince->province ?? ''}}</td>

                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($organization->is_organization==1)
                            <div class="tab-pane {{$organization->is_organization==1 ? 'show active':''}}"
                                 id="timeline">
                                <table class="table table-sm mb-0 table-striped table-hover">
                                    <tr>
                                        <th>नाम</th>
                                        <td>{{$organization->organizationDetail->org_name_ne ?? ''}}
                                            ({{$organization->organizationDetail->org_name_en ?? ''}})
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>इमेल</th>
                                        <td>{{$organization->organizationDetail->org_email ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>फोन</th>
                                        <td>{{$organization->organizationDetail->org_contact ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>लिङ्ग</th>
                                        <td>{{$organization->organizationDetail->org_registration_no ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <th>इमेल</th>
                                        <td>{{$organization->organizationDetail->org_pan_no ?? ''}}</td>
                                    </tr>

                                    <tr>
                                        <th>ठेगाना</th>
                                        <td>{{$organization->organizationDetail->localBody->local_body ?? ''}}
                                            -{{$organization->organizationDetail->ward ?? ''}}
                                            , {{$organization->organizationDetail->tole ?? ''}}
                                            , {{$organization->organizationDetail->district->district ?? ''}}
                                            , {{$organization->organizationDetail->province->province ?? ''}}</td>
                                    </tr>

                                </table>
                            </div>
                        @endif

                        <div class="tab-pane" id="settings">
                            <div class="row">
                                @if($organization->is_organization==0)
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-around">
                                                <p>नागरिकता (आगाडी)</p>
                                                <a href="{{route('admin.file-url-download', ['file_url'=>$organization->userDetail->citizenship_front]??'')}}"
                                                   class="btn btn-xs ">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <img src="{{$organization->userDetail->citizenship_front_url ?? ''}}"
                                                     alt=""
                                                     style="max-width: 100%;height: 200px;object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($organization->is_organization==0)
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-around">
                                                <p>नागरिकता (पछाडी)</p>
                                                <a href="{{route('admin.file-url-download', ['file_url'=>$organization->userDetail->citizenship_back]??'')}}"
                                                   class="btn btn-xs">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <img src="{{$organization->userDetail->citizenship_back_url ?? ''}}"
                                                     alt=""
                                                     style="max-width: 100%;height: 200px;object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($organization->is_organization==0)
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-around">
                                                <p>NEC को प्रमाणपत्र</p>
                                                <a href="{{route('admin.file-url-download', ['file_url'=>$organization->userDetail->nec_certificate]??'')}}"
                                                   class="btn btn-xs">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <img src="{{$organization->userDetail->nec_certificate_url ?? ''}}"
                                                     alt=""
                                                     style="max-width: 100%;height: 200px;object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($organization->is_organization==1)
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-around">
                                                <p>कम्पनी दर्ताको प्रमाणपत्र</p>
                                                <a href="{{route('admin.file-url-download', ['file_url'=>$organization->organizationDetail->org_registration_document]??'')}}"
                                                   class="btn btn-xs">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <img
                                                    src="{{$organization->organizationDetail->org_registration_document_url ?? ''}}"
                                                    alt="" style="max-width: 100%;height: 200px;object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($organization->is_organization==1)
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-around">
                                                <p>कम्पनी PANको प्रमाणपत्र</p>
                                                <a href="{{route('admin.file-url-download', ['file_url'=>$organization->organizationDetail->org_pan_document]??'')}}"
                                                   class="btn btn-xs ">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <img
                                                    src="{{$organization->organizationDetail->org_pan_document_url ?? ''}}"
                                                    alt="" style="max-width: 100%;height: 200px;object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($organization->is_organization==1)
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-around">
                                                <p>लोगो</p>
                                                <a href="{{route('admin.file-url-download', ['file_url'=>$organization->organizationDetail->logo]??'')}}"
                                                   class="btn btn-xs">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <img src="{{$organization->organizationDetail->logo_url ?? ''}}" alt=""
                                                     style="max-width: 100%;height: 200px;object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @if($organization->is_organization==1)
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-sm mb-0 table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>क्र.सं</th>
                                                <th>वर्ष</th>
                                                <th>कागजात</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($organization->organizationDetail->taxClearances??collect() as $taxClearance)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$taxClearance->year ?? ''}}
                                                        <a href="{{route('admin.file-url-download', ['file_url'=>$taxClearance->document]??'')}}"
                                                           class="btn btn-xs text-primary">
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                    </td>
                                                    <td><img src="{{$taxClearance->document_url}}" alt=""
                                                             style="max-width: 100%;height: 200px;object-fit: contain;">
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-fill navtab-bg"
                        @foreach (\Modules\EMap\Enums\MapStatusEnum::cases() as $mapStatus)
                        <li class="nav-item">
                            <a href="#{{ $mapStatus->value }}" data-bs-toggle="tab" aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                               class="nav-link {{$loop->first ? 'active':''}}">
                               {{ $mapStatus->label() }}
                            </a>
                        </li>
                        @endforeach

                    </ul>
                    <div class="tab-content">
                        @foreach (\Modules\EMap\Enums\MapStatusEnum::cases() as $mapStatus)
                            <div class="tab-pane {{$loop->first ? 'show active':''}}"
                                 id="{{ $mapStatus->value }}">
                                 <div class="mt-3">
                                    <table class="table table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th>क्र.सं.</th>
                                                <th>आर्थिक वर्ष</th>
                                                <th>सबममिसन नं</th>
                                                <th>दर्ता नं</th>
                                                <th>किता नं</th>
                                                <th>वडा नं</th>
                                                <th>स्थिती</th>
                                                <th>डेस्क</th>
                                                <th>Pending Days</th>
                                                <th>निर्माण कार्यको किसिम</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($organization->mapApplies?->where('sent_to_organization', $mapStatus->value) as $mapApply)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $mapApply->fiscalYear->title ?? '' }}</td>
                                                    <td>{{ $mapApply->unique_id ?? '' }}</td>
                                                    <td>{{ $mapApply->registration_no ?? '' }}</td>
                                                    <td>{{ $mapApply->landDetail?->plot_no ?? '' }}</td>
                                                    <td>{{ $mapApply->landDetail?->ward_no ?? '' }}</td>
                                                    <td>{{$mapApply->index_data['status'] ?? ''}}</td>
                                                    <td>{{$mapApply->index_data['desk'] ?? ''}}</td>
                                                    <td>{{$mapApply->index_data['pendingDays'] ?? ''}}</td>
                                                    <td>{{ $mapApply->construction_type->label() ?? '' }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-1">
{{--                                                            @if ($mapApply->sent_to_organization == 'Accept')--}}
{{--                                                                <a href="{{ route('emap.admin.mapApply.mapRegistration.index', $mapApply) }}"--}}
{{--                                                                    class="btn btn-outline-info btn-sm" title="दर्ता गर्नुहोस्">--}}
{{--                                                                    <i--}}
{{--                                                                        class="fa fa-{{ empty($mapApply->registration_no) ? 'times-circle' : 'check-circle' }}"></i>--}}
{{--                                                                    दर्ता {{ empty($mapApply->registration_no) ? 'गर्नुहोस्' : 'भएको' }}--}}
{{--                                                                </a>--}}
{{--                                                            @endif--}}
                                                            <form
                                                                action="{{ route('emap.admin.map.mapApply.updateStatus', [$mapApply, $mapApply->application_type]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('put')
                                                                <div class="input-group d-flex align-items-center">
                                                                    <select class="form-select form-select-sm" name="sent_to_organization"
                                                                        id="sent_to_organization" aria-label="Example select with button addon"
                                                                      >
                                                                        <option value="" disabled selected>--- छान्नुहोस् ---</option>
                                                                        <option value="Unseen"
                                                                            {{ $mapApply->sent_to_organization == 'Unseen' ? 'selected' : '' }}>
                                                                            प्रक्रियामा</option>
                                                                        <option value="Accept"
                                                                            {{ $mapApply->sent_to_organization == 'Accept' ? 'selected' : '' }}>स्वीकार
                                                                        </option>
                                                                        <option value="Reject"
                                                                            {{ $mapApply->sent_to_organization == 'Reject' ? 'selected' : '' }}>
                                                                            अस्वीकार</option>
                                                                            <option value="Complete"
                                                                            {{ $mapApply->sent_to_organization == 'Complete' ? 'selected' : '' }}>
                                                                            सम्पन्न</option>
                                                                    </select>
                                                                    <button  class="btn btn-lg btn-outline-primary" type="submit"   ><i class="fa fa-paper-plane"></i></button>
                                                                </div>

                                                            </form>
                                                            <a href="{{ route('emap.admin.map.mapApply.mapDetail', [$mapApply, $mapApply->application_type]) }}" title="विवरण हेर्नुहोस"
                                                                class="btn btn-xs btn-outline-success">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('emap.admin.mapApply.admin-step.form-list', $mapApply) }}" title="नक्सा विवरण"
                                                                class="btn btn-xs btn-outline-primary">
                                                                <i class="fa fa-step-forward"></i>
                                                            </a>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="12">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

