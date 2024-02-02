@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">सिफारिस</li>
                    </ol>
                </div>
                <h4 class="page-title">सिफारिस</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @error('oc_file')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('oc_file.*')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="collapse mb-2" id="collapseFilterForm">
                <div class="card p-0">
                    <div class="card-body px-0">
                        <form>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="recommendation_category" class="form-label">सिफारिस *</label>
                                    <select name="recommendation_category" data-toggle="select2"
                                        id="recommendation_category" class="form-control">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($recommendationCategories as $data)
                                            @if (count($data->recommendationCategories) > 0)
                                                <optgroup label="{{ $data->title }}">
                                                    @foreach ($data->recommendationCategories as $subRecommendationCategory)
                                                        <option
                                                            {{ request('recommendation_category') == $subRecommendationCategory->id ? 'selected' : '' }}
                                                            value="{{ $subRecommendationCategory->id }}">
                                                            {{ $subRecommendationCategory->title }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @else
                                                <option
                                                    {{ request('recommendation_category') == $data->id ? 'selected' : '' }}
                                                    value="{{ $data->id }}">
                                                    {{ $data->title }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="personal_detail" class="form-label">व्यक्तिगत विवरण *</label>
                                    <select name="personal_detail" data-toggle="select2" id="personal_detail"
                                        class="form-control">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($personalDetails as $personalDetail)
                                            <option
                                                {{ request('personal_detail') == $personalDetail->id ? 'selected' : '' }}
                                                value="{{ $personalDetail->id }}">
                                                {{ $personalDetail->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <x-date-input-component nameNe="to_date" labelNe="देखि" :get-today-date="false"
                                        :edit-date-ne="request('to_date')" />
                                </div>
                                <div class="col-md-4">
                                    <x-date-input-component nameNe="from_date" labelNe="सम्म" :get-today-date="false"
                                        :edit-date-ne="request('from_date')" />
                                </div>
                                <div class="col-md-3">
                                    <label for="registration_no">दर्ता नं</label>
                                    <input type="text" name="registration_no" value="{{ request('registration_no') }}"
                                        id="registration_no" placeholder="दर्ता नं" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="mt-2 btn btn-sm btn-primary">
                                <i class="fa fa-search"> पेश गर्नुहोस्</i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">सिफारिस सूची</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')

                            @can('recommendation_create')
                                <a href="{{ route('admin.recommendation.recommendationCategory.registrationDetail.create', $recommendationCategory) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-plus-circle"></i> नयाँ सिफारिस थप्नुहोस
                                </a>
                            @endcan
                            <button class="btn btn-sm mx-1 btn-outline-info waves-effect waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>दर्ता नं</th>
                                    <th>नाम</th>

                                    <th>मिति</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($registrationDetails as $key=>$registrationDetail)
                                    <tr>
                                        <td>{{ $registrationDetails->firstItem() + $key }}</td>
                                        <td>{{ $registrationDetail->registration_no }}</td>
                                        <td>{{ $registrationDetail->personalDetail->name ?? '' }}</td>

                                        <td>{{ $registrationDetail->date_ne }}</td>
                                        <td>
                                            <a type="button" class="btn btn-xs btn-outline-info" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop">
                                                <i class="fa fa-file"></i>
                                            </a>
                                            @can('recommendation_access')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.recommendation.recommendationCategory.registrationDetail.show', [$recommendationCategory, $registrationDetail]) }}"
                                                    class="btn btn-xs btn-outline-warning {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    title="विवरण हेर्नुहोस">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('recommendation_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.recommendation.recommendationCategory.registrationDetail.edit', [$recommendationCategory, $registrationDetail]) }}"
                                                    class="btn btn-xs btn-outline-success  {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    title="फारम सम्पादन गर्नुहोस">
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                            @endcan
                                            <form
                                                action="{{ route('admin.recommendation.recommendationCategory.registrationDetail.destroy', [$recommendationCategory, $registrationDetail]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                @can('recommendation_delete')
                                                    <button data-bs-type="delete"
                                                        class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}"
                                                        title="मेटाउनु होस्">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                    @includeIf('recommendation::admin.registration.inc.document')
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $registrationDetails->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
