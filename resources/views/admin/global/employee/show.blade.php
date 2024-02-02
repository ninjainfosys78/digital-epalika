@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.global.generalSetting.employee.index') }}">थप विवरण</a>
                        </li>
                        <li class="breadcrumb-item active"> थप विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">थप विवरण</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">शैक्षिक योग्यता</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                            <a href="{{ route('admin.global.generalSetting.employee.qualification.create', $employee) }}"
                                class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>शैक्षिक तह </th>
                                    <th>मुख्य विषय </th>
                                    <th>विश्वविद्यालय/शैक्षिक संस्था </th>
                                    <th>सम्पन्न वर्ष</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($qualifications as $qualification)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $qualification->achievement }}</td>
                                        <td>{{ $qualification->major_subject }}</td>
                                        <td>{{ $qualification->institute }}</td>
                                        <td>{{ $qualification->passed_year }}</td>

                                        <td class="d-flex gap-1">

                                            <a data-bs-type="edit"
                                                href="{{ route('admin.global.generalSetting.employee.qualification.edit', [$employee, $qualification]) }}"
                                                class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                title="सम्पादन गर्नुहोस्">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('admin.global.generalSetting.employee.qualification.destroy', [$employee, $qualification]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-bs-type="delete"
                                                    class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                    title="मेटाउनु होस्">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">कार्य अनुभव</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                            <a href="{{ route('admin.global.generalSetting.employee.experience.create', $employee) }}"
                                class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>कार्यालय/संस्था</th>
                                    <th>पद </th>
                                    <th> मिति देखि</th>
                                    <th> मिति सम्म </th>
                                    <th>मुख्य जिम्मेवारी</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($experiences as $experience)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $experience->office }}</td>
                                        <td>{{ $experience->designation }}</td>
                                        <td>{{ $experience->start_date }}</td>
                                        <td>{{ $experience->end_date }}</td>
                                        <td>{{ $experience->responsibility }}</td>

                                        <td class="d-flex gap-1">

                                            <a data-bs-type="edit"
                                                href="{{ route('admin.global.generalSetting.employee.experience.edit', [$employee, $experience]) }}"
                                                class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                title="सम्पादन गर्नुहोस्">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('admin.global.generalSetting.employee.experience.destroy', [$employee, $experience]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-bs-type="delete"
                                                    class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                    title="मेटाउनु होस्">
                                                    <i class="fa fa-trash"></i>
                                                </button>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">फाईल</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                            <a href="{{ route('admin.global.generalSetting.employee.experienceFile.create', $employee) }}"
                                class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>शिर्षक</th>
                                    <th>फाईल</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($experienceFiles as $experienceFile)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $experienceFile->title }}</td>
                                        <td>
                                            <a href="{{ $experienceFile->file }}" download="{{ $experienceFile->file }}">
                                                Download <i class="fa fa-download"></i>
                                            </a>
                                        </td>
                                        <td class="d-flex gap-1">

                                            <a data-bs-type="edit"
                                                href="{{ route('admin.global.generalSetting.employee.experienceFile.edit', [$employee, $experienceFile]) }}"
                                                class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                title="सम्पादन गर्नुहोस्">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('admin.global.generalSetting.employee.experienceFile.destroy', [$employee, $experienceFile]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-bs-type="delete"
                                                    class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                    title="मेटाउनु होस्">
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
