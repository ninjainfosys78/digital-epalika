@extends('roaster::traineeUser.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('traineeOrganization.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">कर चुक्ता</li>
                    </ol>
                </div>
                <h4 class="page-title">कर चुक्ता</h4>
            </div>
        </div>
    </div>
    <div class="card p-0">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="card-title mb-0">कर चुक्ता</h3>
                <a href="{{ route('traineeOrganization.admin.traineeTaxClearance.create') }}"
                    class="btn btn-outline-primary btn-xs">
                    <i class="fa fa-plus"></i> नयाँ थप्नुहोस
                </a>
            </div>
        </div>
        <div class="card-body px-0">
            <table class="table table-sm table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">बर्ष</th>
                        <th scope="col">फाईल</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taxClearances as $taxClearance)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $taxClearance->year }}</td>
                            <td>
                                <img src="{{ $taxClearance->document_url }}" alt="" height="60">
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('traineeOrganization.admin.traineeTaxClearance.edit', $taxClearance) }}"
                                        class="btn btn-sm btn-outline-warning mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form
                                        action="{{ route('traineeOrganization.admin.traineeTaxClearance.destroy', $taxClearance) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger show_confirm mx-1">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
