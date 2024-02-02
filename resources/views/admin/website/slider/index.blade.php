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
                        <li class="breadcrumb-item active">स्लाइडर</li>
                    </ol>
                </div>
                <h4 class="page-title">स्लाइडर</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">स्लाइडर सूची</h4>
                        @can('slider_create')
                            <a href="{{route('admin.global.website.slider.create')}}"
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
                                <th>फोटो</th>
                                <th>विवरण</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($sliders as $slider)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$slider->title}}</td>
                                    <td><img src="{{asset($slider->image_url)}}" height="60" width="100" alt="{{$slider->title}}"></td>
                                    <td>{{$slider->description}}</td>
                                    <td class="d-flex gap-1">
                                        @can('slider_edit')
                                        <a data-bs-type="edit" href="{{route('admin.global.website.slider.edit',$slider)}}"
                                           class="btn btn-xs btn-outline-primary {{get_setting('Pin')?'confirm_pin':''}}" title="सम्पादन गर्नुहोस्">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @endcan
                                        <form action="{{route('admin.global.website.slider.destroy',$slider)}}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            @can('slider_delete')
                                            <button data-bs-type="delete" class="btn btn-xs btn-outline-danger {{get_setting('Pin')?'confirm_pin':'show_confirm'}}" title="मेटाउनु होस्">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
