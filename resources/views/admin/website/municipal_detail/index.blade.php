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
                        <li class="breadcrumb-item">
                            <a href="">पालिका विवरण</a>
                        </li>
                        <li class="breadcrumb-item active">पालिका विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">पालिका विवरण</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">पालिका विवरण सूची</h4>
                        @can('municipalDetail_create')
                            <a href="{{route('admin.global.website.municipalDetail.create')}}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>शीर्षक</th>
                                <th>आइकन</th>
                                <th>कलर</th>
                                <th>गणना</th>
                                <th>स्थिति</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($municipalDetails as $municipalDetail)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$municipalDetail->title}}</td>
                                    <td>{!! $municipalDetail->icon !!}</td>
                                    <td><div
                                            style="background-color: {{$municipalDetail->bg_color}};color: white;padding: 5px">{{$municipalDetail->bg_color}}</div>
                                    </td>
                                    <td>{{$municipalDetail->count}}</td>
                                    <td>{{$municipalDetail->position}}</td>
                                    <td class="d-flex gap-1">
                                        @can('municipalDetail_edit')
                                        <a data-bs-type="edit" href="{{route('admin.global.website.municipalDetail.edit',$municipalDetail)}}"
                                           class="btn btn-xs btn-outline-primary {{get_setting('Pin')?'confirm_pin':''}}" title="सम्पादन गर्नुहोस्">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @endcan
                                        <form
                                            action="{{route('admin.global.website.municipalDetail.destroy',$municipalDetail)}}"
                                            method="post">
                                            @csrf
                                            @method('delete')
                                            @can('municipalDetail_delete')
                                            <button data-bs-type="delete" class="btn btn-xs btn-outline-danger {{get_setting('Pin')?'confirm_pin':'show_confirm'}}" title=" मेटाउनु होस्">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
