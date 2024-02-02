@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">सडक विवरण</h4>
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
                        <li class="breadcrumb-item active">सडक विवरण</li>
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
                        <h4 class="header-title mb-0">सडक विवरण सूची</h4>
                        <a href="{{ route('emap.admin.streetDetail.create') }}" class="btn btn-sm btn-outline-primary">
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
                                    <th>नाम</th>
                                    <th>देखि</th>
                                    <th>सम्म</th>
                                    <th>सेटब्याक</th>
                                    <th>सडक कोड</th>
                                    <th>अवस्था</th>
                                    <th>वडा</th>
                                    <th>सडक अधिकार क्षेत्र</th>
                                    <th>बाटोको चौडाई</th>
                                    <th>सडकको प्रकार</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($streetDetails as $streetDetail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $streetDetail->name }}</td>
                                        <td>{{ $streetDetail->from }}</td>
                                        <td>{{ $streetDetail->to }}</td>
                                        <td>{{ $streetDetail->setback }}</td>
                                        <td>{{ $streetDetail->street_code }}</td>
                                        <td>{{ $streetDetail->condition->label() }}</td>
                                        <td>{{ $streetDetail->wards }}</td>
                                        <td>{{ $streetDetail->right_of_way }}</td>
                                        <td>{{ $streetDetail->width }}</td>
                                        <td>{{ $streetDetail->road_type->label() }}</td>
                                        <td class="d-flex">
                                            <a data-bs-type="edit"
                                                href="{{ route('emap.admin.streetDetail.edit', $streetDetail) }}"
                                                class="btn btn-xs me-1 btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="सम्पादन गर्नुहोस">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('emap.admin.streetDetail.destroy', $streetDetail) }}"
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
                                        <td colspan="13" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
