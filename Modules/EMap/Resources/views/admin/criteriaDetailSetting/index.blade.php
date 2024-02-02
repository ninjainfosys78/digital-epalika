@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">मापदण्ड</h4>
                <div class="mb-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-home"></i> गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="">इ-नक्सा</a>
                        </li>
                        <li class="breadcrumb-item active">मापदण्ड</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">मापदण्ड सूची</h4>
                        @can('mapFee_create')
                            <a href="{{ route('emap.admin.criteriaDetailSetting.create') }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>शीर्षक</th>
                                    <th>क्षेत्र</th>
                                    <th>संकेत</th>
                                    <th>GCR</th>
                                    <th>FAR</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($criteriaDetailSettings as $criteriaDetailSetting)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $criteriaDetailSetting->title }}</td>
                                        <td>{{ $criteriaDetailSetting->area }}</td>
                                        <td>{{ $criteriaDetailSetting->sign->label() }}</td>
                                        <td>{{ $criteriaDetailSetting->gcr }}</td>
                                        <td>{{ $criteriaDetailSetting->far }}</td>
                                        <td class="d-flex">
                                            <a data-bs-type="edit"
                                                href="{{ route('emap.admin.criteriaDetailSetting.edit', $criteriaDetailSetting) }}"
                                                class="btn btn-xs me-1 btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="सम्पादन गर्नुहोस">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            {{-- <a data-bs-type="show"
                                            href="{{route('emap.admin.criteriaDetailSetting.show',$dynamicForm)}}"
                                            class="btn btn-xs me-1 btn-outline-warning"  data-bs-toggle="tooltip" data-bs-placement="top" title="हेर्नुहोस">
                                            <i class="fa fa-eye"></i>
                                        </a> --}}
                                            <form
                                                action="{{ route('emap.admin.criteriaDetailSetting.destroy', $criteriaDetailSetting) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-bs-type="delete"
                                                    class="btn btn-xs me-1 btn-outline-danger show_confirm">
                                                    <i class="fa fa-trash {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="मेटाउनु होस्"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
