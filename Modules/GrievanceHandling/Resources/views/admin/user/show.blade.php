@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.grievanceHandling.grievanceDetail.index') }}">प्रयोगकर्ताको
                                बिबरण </a>
                        </li>
                        <li class="breadcrumb-item active">प्रयोगकर्ताको बिबरण</li>
                    </ol>
                </div>
                <h4 class="page-title">प्रयोगकर्ताको बिबरण </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">प्रयोगकर्ताको बिबरण</h4>

                        <a href="{{route('admin.grievanceHandling.grievanceDetail.index')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> प्रयोगकर्ताको बिबरण
                        </a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 table-striped table-hover table-bordered">

                                    <tbody>
                                    <tr>
                                        <th>नाम.</th>
                                        <td>{{$grievanceUser->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>इमेल</th>
                                        <td>{{$grievanceUser->email}}</td>
                                    </tr>
                                    <tr>
                                        <th>फोन नं.</th>
                                        <td>{{$grievanceUser->phone}}</td>
                                    </tr>
                                    <tr>
                                        <th>गुनासो संख्या.</th>
                                        <td>{{$grievanceUser->grievance_details_count}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
