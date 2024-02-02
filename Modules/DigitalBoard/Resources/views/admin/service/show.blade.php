@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.digitalBoard.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">सेवा बिबरण </li>
                    </ol>
                </div>
                <h4 class="page-title">सेवा</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">सेवा बिबरण </h4>

                        <a href="{{route('admin.digitalBoard.service.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> सेवा सूची
                        </a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mb-0 table-striped table-hover">
                            <tbody>
                            <tr>
                                <th>सेवाको नाम</th>
                                <td>{{$service->service_name}}</td>
                            </tr>
                            <tr>
                                <th>शाखा</th>
                                <td>{{$service->branch->branch_name??''}}</td>
                            </tr>
                            <tr>
                                <th>लाग्ने समय</th>
                                <td>{{$service->time_taken}}</td>
                            </tr>
                            <tr>
                                <th>जिम्मेवार अधिकारी</th>
                                <td>{{$service->responsible_officer}}</td>
                            </tr>
                            <tr>
                                <th>कोठा नम्बर/कार्यालय</th>
                                <td>{{$service->office}}</td>
                            </tr>
                            <tr>
                                <th>फोटो</th>
                                <td>
                                    <img src="{{$service->photo_url}}" height="70" alt="Photo">
                                </td>
                            </tr>
                            <tr>
                                <th>इमेल</th>
                                <td>{{$service->email}}</td>
                            </tr>
                            <tr>
                                <th>फोन नम्बर</th>
                                <td>{{$service->phone}}</td>
                            </tr>
                            <tr>
                                <th>आबश्यक कागजात</th>
                                <td>
                                    <ul>
                                        @foreach($service->serviceDocuments as $serviceDocument)
                                            <li>{{$serviceDocument->description}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th>सिफारिस/प्रमाणित उपलब्ध गराउने प्रक्रिया</th>
                                <td>
                                    <ul>
                                        @foreach($service->serviceProcesses as $serviceProcess)
                                            <li>{{$serviceProcess->description}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">सेवा दिने कर्मचारी</th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="table-responsive">
                                        <table class="table table-sm mb-0 table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>क्र.स</th>
                                                <th> नाम</th>
                                                <th> पद</th>
                                                <th>फोन</th>
                                                <th>इमेल</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($service->serviceEmployees as $key=>$serviceEmployee)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td class="table-user">
                                                        <img src="{{$serviceEmployee->photo_url}}" class="me-2 rounded-circle" alt="">
                                                        {{$serviceEmployee->employee_name}}
                                                    </td>
                                                    <td>{{$serviceEmployee->designation}}</td>
                                                    <td>{{$serviceEmployee->phone}}</td>
                                                    <td>{{$serviceEmployee->email}}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
