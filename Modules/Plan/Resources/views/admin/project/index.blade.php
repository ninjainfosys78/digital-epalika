@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">योजना/कार्यक्रमहरु</li>
                    </ol>
                </div>
                <h4 class="page-title">योजना/कार्यक्रमहरु</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="collapse mb-2" id="collapseFilterForm">
                <div class="card p-0">
                    <div class="card-body px-0">
                        <form>
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <x-date-input-component nameNe="from_date" labelNe="मिति देखि" :get-today-date="false"
                                        :edit-date-ne="request('from_date')" />
                                </div>
                                <div class="col-md-3">
                                    <x-date-input-component nameNe="to_date" labelNe="मिति सम्म" :get-today-date="false"
                                        :edit-date-ne="request('to_date')" />
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="project_status">योजनाको अवस्था</label>
                                    <select name="project_status" id="project_status" class="form-select">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach (\Modules\Plan\Enums\ProjectStatusEnum::cases() as $projectStatus)
                                            <option
                                                {{ $projectStatus->value == request('project_status') ? 'selected' : '' }}
                                                value="{{ $projectStatus->value }}">{{ $projectStatus->label() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="expense_head_id">खर्च शिर्षक</label>
                                    <select name="expense_head_id" id="expense_head_id" class="form-select">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        @foreach ($expenseHeads as $expenseHead)
                                            <option {{ $expenseHead->id == request('expense_head_id') ? 'selected' : '' }}
                                                value="{{ $expenseHead->id }}">{{ $expenseHead->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="is_contracted">सम्झौता भएको/नभएको</label>
                                    <select name="is_contracted" id="is_contracted" class="form-select">
                                        <option value="">--- छान्नुहोस् ---</option>
                                        <option value="1" {{ request('is_contracted') == 1 ? 'selected' : '' }}>
                                            भएको
                                        </option>
                                        <option value="0" {{ request('is_contracted') == '0' ? 'selected' : '' }}>
                                            नभएको
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fa fa-search"> पेश गर्नुहोस्</i>
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header search-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">योजना/कार्यक्रमहरु</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                            <button class="btn btn-sm mx-1 btn-outline-info waves-effect waves-light collapsed"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilterForm"
                                aria-expanded="false" aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                            @can('project_create')
                                <a href="{{ route('admin.plan.project.create') }}"
                                    class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                    <i class="fa fa-plus-circle"></i> नयाँ थप्नुहोस्</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <table id="demo-foo-accordion" class="table table-custom toggle-arrow-tiny">
                        <thead>
                            <tr>
                                <th data-toggle="true">क्र.स</th>
                                <th>दर्ता नं.</th>
                                <th>आयोजना/कार्यक्रमको नाम</th>
                                <th data-hide="phone">योजना उपक्षेत्र</th>
                                <th data-hide="phone">सुरु हुने मिति</th>
                                <th data-hide="phone">वडा नं.</th>
                                <th data-hide="phone">स्वीकृत रकम</th>
                                <th data-hide="phone">आयोजनाको अवस्था</th>
                                <th data-hide="all">लागत</th>
                                <th data-hide="all">सम्झौता</th>
                                <th data-hide="all">अन्य</th>
                                <th data-hide="all">कार्य</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($projects as $project)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a class="projectShowBtn"
                                            action-url="{{ route('admin.plan.project.show', $project) }}"
                                            href="javascript:void(0)">
                                            {{ $project->registration_no }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="projectShowBtn"
                                            action-url="{{ route('admin.plan.project.show', $project) }}"
                                            href="javascript:void(0)">
                                            {{ $project->project_name }}
                                        </a>
                                    </td>
                                    <td>{{ $project->planArea->area_name ?? '' }}</td>
                                    <td>
                                        @if ($project->project_start_date)
                                            {{ $project->project_start_date }}
                                        @else
                                            <p class="text-danger">सुरु भएको छैन</p>
                                        @endif
                                    </td>
                                    <td>{{ implode(',', $project->ward_no) }}</td>
                                    <td>रू. {{ $project->project_allocated_amounts_sum_amount }}</td>
                                    <td>{{ $project->project_status->label() }}</td>
                                    <td class="d-flex gap-1">
                                        <a class="btn btn-xs btn-outline-secondary" title="आयोजनाको लागत"
                                            href="{{ route('admin.plan.project.projectCostDetail.index', $project) }}">
                                            <i class="fa fa-list"> </i>
                                        </a>
                                        @can('technicalCostEstimate_access')
                                            <a class="btn btn-xs btn-outline-secondary" title=" प्राविधिक लागत"
                                                href="{{ route('admin.plan.project.technicalCostEstimate.index', $project) }}">
                                                <i class="fa fa-user-cog"></i>
                                            </a>
                                        @endcan
                                    </td>
                                    <td class="d-flex gap-1">
                                        <a class="btn btn-xs btn-outline-primary" title=" योजना सम्झौता"
                                            href="{{ route('admin.plan.project.projectAgreement.index', $project) }}">
                                            <i class="fa fa-handshake"></i>
                                        </a>
                                        @if ($project->operated_through === \Modules\Plan\Enums\ProjectOperatedThroughEnum::CONSUMER_COMMITTEE)
                                            @if ($project->is_contracted)
                                                <a class="btn btn-xs btn-outline-primary" title="आर्थिक कारोबार"
                                                    href="{{ route('admin.plan.project.consumerCommitteeTransaction.index', $project) }}">
                                                    <i class="fa fa-money-bill"></i>
                                                </a>
                                                <a class="btn btn-xs btn-outline-primary" title=" मर्मत संम्भार सम्बन्धी"
                                                    href="{{ route('admin.plan.project.projectMaintenanceArrangement.index', $project) }}">
                                                    <i class="fa fa-cog"></i>

                                                </a>
                                            @endcan
                                </td>
                        @endif
                        </td>
                        <td class="d-flex gap-1">
                            @if ($project->is_contracted)
                                <a class="btn btn-xs btn-outline-success" title="शर्तहरु"
                                    href="{{ route('admin.plan.project.projectAgreementTerm.create', $project) }}">
                                    <i class="fa fa-clipboard-check"> </i>
                                </a>
                                @can('projectDocument_access')
                                    <a class="btn btn-xs btn-outline-success" title=" सम्बन्धित कागजातहरू "
                                        href="{{ route('admin.plan.project.projectDocument.index', $project) }}">
                                        <i class="fa fa-file-contract"></i>
                                    </a>
                                @endcan
                                <a class="btn btn-xs btn-outline-success" title="सम्बन्धित फोटो/फाईलहरू"
                                    href="{{ route('admin.plan.project.fileList', $project) }}">
                                    <i class="fa fa-file"> </i>
                                </a>
                                <a class="btn btn-xs btn-outline-success" title="म्याद थप"
                                    href="{{ route('admin.plan.project.projectDeadlineExtension.index', $project) }}">
                                    <i class="fa fa-calendar-alt"> </i>
                                </a>
                            @else
                                <p class="text-center">सम्झौता भएको छैन ।</p>
                            @endif
                        </td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('admin.plan.project.show', $project) }}" title=" विवरण हेर्नुहोस्"
                                class="btn btn-xs btn-outline-info">
                                <i class="fa fa-eye"></i></a>
                            <a href="{{ route('admin.plan.project.edit', $project) }}" title=" सम्पादन गर्नुहोस्"
                                class="btn btn-xs btn-outline-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                </svg>
                        </td>
                        </tr>
                        <tr class="empty">
                            <td></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-2">
                    {{ $projects->onEachSide(config('app.pagination_count'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div id="project-info-modal" class="modal fade" tabindex="-1" aria-labelledby="fullWidthModalLabel"
    style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-full-width">
        <div class="modal-content" id="project-data">

        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.projectShowBtn').on('click', function(e) {
                e.preventDefault()
                $.ajax({
                    method: "GET",
                    url: $(this).attr("action-url"),
                    success: function(resp) {
                        $('#project-info-modal').modal('toggle')
                        $('#project-data').html(resp.view)
                    },
                    error: function() {
                        alert("Something Went Wrong");
                    }
                });
            })
        })
    </script>
    <script src="{{ asset('assets/backend/js/plugins/footable.min.js') }}"></script>
@endpush
@endsection
