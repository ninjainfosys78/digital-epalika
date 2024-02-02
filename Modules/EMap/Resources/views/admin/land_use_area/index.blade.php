@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">भूउपयोग क्षेत्र</h4>
                <div class="">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="http://127.0.0.1:8000/assets/backend/images/home.svg"
                                    alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="">इ-नक्सा</a>
                        </li>
                        <li class="breadcrumb-item active">भूउपयोग क्षेत्र</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="mt-3">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">भूउपयोग क्षेत्र सूची</h4>
                        <a href="{{ route('emap.admin.landUseArea.create') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>शीर्षक</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($landUseAreas as $landUseArea)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $landUseArea->title }}</td>
                                        <td class="d-flex">
                                            <a data-bs-type="edit"
                                                href="{{ route('emap.admin.landUseArea.edit', $landUseArea) }}"
                                                class="btn btn-xs me-1 btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="सम्पादन गर्नुहोस">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('emap.admin.landUseArea.destroy', $landUseArea) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-bs-type="delete"
                                                    class="btn btn-xs me-1 btn-outline-danger show_confirm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="मेटाउनु होस्">
                                                    <i
                                                        class="fa fa-trash {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"></i>

                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
