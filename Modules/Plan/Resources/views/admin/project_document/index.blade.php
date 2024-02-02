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
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.plan.project.index') }}">
                                योजनाहरु
                            </a>
                        </li>
                        <li class="breadcrumb-item active">सम्बन्धित कागजातहरू</li>
                    </ol>
                </div>
                <h4 class="page-title">सम्बन्धित कागजातहरू</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="header-title">
                        सम्बन्धित कागजातहरू
                    </h4>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.plan.project.index') }}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> योजना/कार्यक्रमहरू
                        </a>
                        <a href="{{ route('admin.plan.project.projectDocument.create', $project) }}"
                            class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-plus-circle"> नयाँ कागजात थप्नुहोस्</i>
                        </a>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>कागजातको नाम</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($project->projectDocuments as $document)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $document->document_name }}</td>
                                        <td>
                                            <a data-bs-type="edit"
                                                href="{{ route('admin.plan.project.projectDocument.edit', [$project, $document]) }}"
                                                class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @can('projectDocument_delete')
                                                <form
                                                    action="{{ route('admin.plan.project.projectDocument.destroy', [$project, $document]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button data-bs-type="delete"
                                                        class="btn btn-xs btn-outline-danger {{ get_setting('Pin') ? 'confirm_pin' : 'show_confirm' }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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
