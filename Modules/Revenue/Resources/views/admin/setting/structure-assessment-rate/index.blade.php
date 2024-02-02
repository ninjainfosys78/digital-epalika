@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.revenue.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">संरचनाको मुल्यांकन</li>
                    </ol>
                </div>
                <h4 class="page-title">संरचनाको मुल्यांकन</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title">संरचनाको मुल्यांकन सूची</h4>
                        @can('structureAssessmentRate_create')
                            <a href="{{ route('admin.revenue.setting.structureAssessmentRate.create') }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>क्षेत्र</th>
                                    <th>स्ट्रकचर</th>
                                    <th>प्रयोजन</th>
                                    <th>दर (वर्ग फीटमा)</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($structureAssessmentRates as $structureAssessmentRate)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $structureAssessmentRate->sector->title }}</td>
                                        <td>{{ $structureAssessmentRate->physicalStructureType->title }}</td>
                                        <td>{{ $structureAssessmentRate->usage }}</td>
                                        <td>रु. {{ $structureAssessmentRate->rate }}</td>
                                        <td>
                                            @can('structureAssessmentRate_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.revenue.setting.structureAssessmentRate.edit', [$structureAssessmentRate]) }}"
                                                    class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                    <i class="fa fa-edit"></i> सम्पादन गर्नुहोस्
                                                </a>
                                            @endcan
                                            @can('structureAssessmentRate_delete')
                                                <form
                                                    action="{{ route('admin.revenue.setting.structureAssessmentRate.destroy', [$structureAssessmentRate]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-bs-type="delete"
                                                        class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}">
                                                        <i class="fa fa-trash"></i> मेटाउनु होस्
                                                    </button>
                                                </form>
                                            @endcan
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
