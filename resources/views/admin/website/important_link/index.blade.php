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
                        <li class="breadcrumb-item active">महत्त्वपूर्ण लिङ्क</li>
                    </ol>
                </div>
                <h4 class="page-title">महत्त्वपूर्ण लिङ्क</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">महत्त्वपूर्ण लिङ्क सूची</h4>
                        @can('role_create')
                            <a href="{{route('admin.global.website.importantLink.create')}}"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm mb-0 table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>शीर्षक</th>
                                <th>लिङ्क</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($importantLinks as $importantLink)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$importantLink->link_title}}</td>
                                    <td>{{$importantLink->link_url}}</td>
                                    <td class="d-flex gap-1">
                                        <a data-bs-type="edit" href="{{route('admin.global.website.importantLink.edit',$importantLink)}}"
                                           class="btn btn-xs btn-outline-primary {{get_setting('Pin')?'confirm_pin':''}}" title="सम्पादन गर्नुहोस्">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{route('admin.global.website.importantLink.destroy',$importantLink)}}"
                                              method="post">
                                            @csrf
                                            @method('delete')
                                            <button data-bs-type="delete" class="btn btn-xs btn-outline-danger {{get_setting('Pin')?'confirm_pin':'show_confirm'}}" title=" मेटाउनु होस्">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="4">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
