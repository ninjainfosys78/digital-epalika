@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.grant.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">निजि उधम/फर्म आव्धता</li>
                    </ol>
                </div>
                <h4 class="page-title">अनुदान लिएको तालिका</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">अनुदान लिएको तालिका</h4>
                        @can('enterprise_access')
                            <a href="{{route('admin.grant.enterprise.show', $enterprise)}}"
                               class="btn btn-sm btn-outline-primary">
                               <i class="fa fa-user"></i> प्रोफाइल
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="header-title my-2">
                                अनुदान लिएको तालिका
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">क्र.स</th>
                                        <th scope="col">कार्यक्रम/क्रियाकलाप</th>
                                        <th scope="col">अनुदानग्राही लगानी</th>
                                        <th scope="col">अनुदान स्थल</th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @foreach ($enterprise->grantDetails as $grantDetail)
                                  <tr>
                                    <td>{{ $loop->iteration }}</th>
                                    <td>{{$grantDetail->grant->grantProgram->name??''}}</td>
                                    <td>{{$grantDetail->personal_investment}}</td>
                                    <td>{{$grantDetail->localBody->local_body ?? ''}} - {{$grantDetail->ward_no}} {{$grantDetail->village}}, {{$grantDetail->tole}}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
