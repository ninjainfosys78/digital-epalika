@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.roaster.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.roaster.trainer.index') }}">प्रशिक्षक</a>
                        </li>
                        <li class="breadcrumb-item">
                            प्रशिक्षकहरु
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">प्रशिक्षकहरु</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-0">
                <div class="card-header search-card">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">प्रशिक्षकहरु</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')
                        </div>
                    </div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-custom">
                            <thead>
                                <tr>
                                    <th>क्र.सं</th>
                                    <th>फोटो</th>
                                    <th>नाम</th>
                                    <th>विभाग</th>
                                    <th>पद</th>
                                    <th>कार्यालय</th>
                                    <th>स्वीकृत</th>
                                    <th>सम्पर्क</th>
                                    <th class="text-center">#</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($trainers as $trainer)
                                    <tr>
                                        <td>{{ $loop->iteration ?? '' }}</td>
                                        <td><img src="{{ $trainer->photo_url ?? '' }}" alt="{{ $trainer->name ?? '' }}"
                                                height="100" width="100" class="img-fluid avatar-md rounded-circle">
                                        </td>
                                        <td>{{ $trainer->name ?? '' }}</td>
                                        <td>{{ $trainer->department->title ?? '' }}</td>
                                        <td>{{ $trainer->designation->title ?? '' }}</td>
                                        <td>{{ $trainer->office ?? '' }}</td>
                                        <td>

                                            <a href="">
                                                <i
                                                    class="fa fa-2x fa-{{ $trainer->approved_at == null ? 'toggle-off text-danger' : 'toggle-on text-success' }}"></i>
                                            </a>

                                        </td>
                                        <td>
                                            @if ($trainer->phone)
                                                <i class="fa fa-phone"></i> {{ $trainer->phone }} <br>
                                            @endif
                                            @if ($trainer->email)
                                                <i class="fa fa-envelope"></i> {{ $trainer->email }}
                                            @endif
                                        </td>

                                        <td class="d-flex gap-1">
                                            @can('trainer_access')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.roaster.trainer.show', $trainer) }}"
                                                    class="btn btn-xs btn-outline-info" title="विवरण हेर्नुहोस्">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('trainer_edit')
                                                <a data-bs-type="edit"
                                                    href="{{ route('admin.roaster.trainer.edit', $trainer) }}"
                                                    class="btn btn-xs btn-outline-primary {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                    title="सम्पादन गर्नुहोस्">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                                    </svg>
                                                </a>
                                            @endcan

                                        </td>
                                    </tr>
                                    <tr class="empty">
                                        <td></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-2">
                        {{ $trainers->onEachSide(config('app.pagination_count'))->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
