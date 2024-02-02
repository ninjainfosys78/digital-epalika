@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.grant.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">जारी भएको अनुदान</li>
                    </ol>
                </div>
                <h4 class="page-title">जारी भएको अनुदान</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">अनुदान प्राप्तकर्ता</h4>
                        @can('grant_create')
                            <a href="{{route('admin.grant.grant.show',$grant)}}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-user"></i> प्रोफाइल
                            </a>
                        @endcan
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="header-title my-2">
                                अनुदान प्राप्तकर्ता
                            </h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mt-3">
                                <thead>
                                    <tr>
                                        <th>क्र.स</th>
                                        <th>नाम</th>
                                        <th>अनुदानग्राहीको प्रकार</th>
                                        <th>अनुदान रकम</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($grant->grantDetails as $grantDetail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $grantDetail->model->name ?? '' }}</td>
                                            <td>{{ $grantDetail->grant_for?->label() }}</td>
                                            <td>{{ $grantDetail->grant_amount ?? '' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
