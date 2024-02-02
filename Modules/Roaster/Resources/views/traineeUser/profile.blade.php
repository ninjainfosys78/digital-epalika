@extends('roaster::traineeUser.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('traineeOrganization.admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">मेरो प्रोफाइल</li>
                    </ol>
                </div>
                <h4 class="page-title">मेरो प्रोफाइल</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{$traineeUser->profile_photo_url}}" class="rounded-circle avatar-lg img-thumbnail"
                         alt="profile-image">
                    <h4 class="mb-0">{{$traineeUser->name}}</h4>
                    <div class="text-start mt-3">
                        <p class="text-muted mb-2 font-13"><strong>नाम :</strong> <span
                                class="ms-2">{{$traineeUser->name}}</span>
                        </p>
                        <p class="text-muted mb-2 font-13"><strong>इमेल :</strong><span
                                class="ms-2">{{$traineeUser->email}}</span></p>
                        <p class="text-muted mb-2 font-13"><strong>फोन :</strong> <span
                                class="ms-2">{{$traineeUser->phone}}</span></p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-lg-8 col-xl-8">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-fill navtab-bg mb-2">
                        {{-- @if($organization->is_organization==0)
                        <li class="nav-item">
                            <a href="#aboutme" data-bs-toggle="tab" aria-expanded="false" class="nav-link {{$organization->is_organization==0 ? 'active':''}} ">
                                व्यक्तिगत विवरण
                            </a>
                        </li>
                        @endif --}}
                        @if($traineeUser->is_trainee==1)
                        <li class="nav-item">
                            <a href="#timeline" data-bs-toggle="tab" aria-expanded="true" class="nav-link {{$traineeUser->is_trainee==1 ? 'active':''}} ">
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
                        {{-- @if($organization->is_organization==0)
                        <div class="tab-pane {{$organization->is_organization==0 ? 'show active':''}}" id="aboutme">
                            <table class="table table-sm table-striped table-bordered">
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
                                    <td>{{$organization->userDetail->gender?->label() ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>बैवाहिक स्थिति</th>
                                    <td>{{$organization->userDetail->marital_status?->label() ?? ''}}</td>
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
                        @endif --}}
                            @if($traineeUser->is_trainee==1)
                        <div class="tab-pane {{$traineeUser->is_trainee==1 ? 'show active':''}}" id="timeline">
                            <table class="table table-sm mb-0 table-striped table-bordered">
                                <tr>
                                    <th>नाम</th>
                                    <td>{{$traineeUser->traineeUserDetail->org_name_ne ?? ''}}
                                        ({{$traineeUser->traineeUserDetail->org_name_en ?? ''}})
                                    </td>
                                </tr>
                                <tr>
                                    <th>इमेल</th>
                                    <td>{{$traineeUser->traineeUserDetail->org_email ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>फोन</th>
                                    <td>{{$traineeUser->traineeUserDetail->org_contact ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>दर्ता नं</th>
                                    <td>{{$traineeUser->traineeUserDetail->org_registration_no ?? ''}}</td>
                                </tr>
                                <tr>
                                    <th>पान नं</th>
                                    <td>{{$traineeUser->traineeUserDetail->org_pan_no ?? ''}}</td>
                                </tr>

                                <tr>
                                    <th>ठेगाना</th>
                                    <td>{{$traineeUser->traineeUserDetail->localBody->local_body ?? ''}}
                                        -{{$traineeUser->traineeUserDetail->ward ?? ''}}
                                        , {{$traineeUser->traineeUserDetail->tole ?? ''}}
                                        , {{$traineeUser->traineeUserDetail->district->district ?? ''}}
                                        , {{$traineeUser->traineeUserDetail->province->province ?? ''}}</td>
                                </tr>

                            </table>
                        </div>
                            @endif
                        <div class="tab-pane" id="settings">
                            <div class="row">
                                {{-- @if($organization->is_organization==0)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">नागरिकता (आगाडी)</div>
                                        <div class="card-body">
                                            <img src="{{$organization->userDetail->citizenship_front_url}}" alt=""
                                                 height="100" width="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">नागरिकता (पछाडी)</div>
                                        <div class="card-body">
                                            <img src="{{$organization->userDetail->citizenship_back_url}}" alt=""
                                                 height="100" width="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">NECको प्रमाणपत्र</div>
                                        <div class="card-body">
                                            <img src="{{$organization->userDetail->nec_certificate_url}}" alt=""
                                                 height="100" width="200">
                                        </div>
                                    </div>
                                </div>
                                @endif --}}
                                    @if($traineeUser->is_trainee==1)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">कम्पनी दर्ताको प्रमाणपत्र</div>
                                        <div class="card-body">
                                            <img
                                                src="{{$traineeUser->traineeUserDetail->org_registration_document_url ?? ''}}"
                                                alt="" height="100" width="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">कम्पनी PANको प्रमाणपत्र</div>
                                        <div class="card-body">
                                            <img src="{{$traineeUser->traineeUserDetail->org_pan_document_url ?? ''}}"
                                                 alt="" height="100" width="200">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">लोगो</div>
                                        <div class="card-body">
                                            <img src="{{$traineeUser->traineeUserDetail->logo_url ?? ''}}" alt=""
                                                 height="100" width="100">
                                        </div>
                                    </div>
                                </div>
                                    @endif
                            </div>
                            @if($traineeUser->is_trainee==1)
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-sm mb-0 table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>क्र.सं</th>
                                            <th>वर्ष</th>
                                            <th>कागजात</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($traineeUser->traineeUserDetail->traineeTaxClearances ?? collect() as $taxClearance)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$taxClearance->year ?? ''}}</td>
                                                <td><img src="{{$taxClearance->document_url}}" alt="" height="100" width="200"></td>
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
@endsection

