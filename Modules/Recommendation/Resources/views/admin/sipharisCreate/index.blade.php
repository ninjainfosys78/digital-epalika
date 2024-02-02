@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                                <i class="fa fa-home"></i> गृहपृष्ठ
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
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            @error('oc_file.*')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="collapse mb-2" id="collapseFilterForm">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="header-title mb-0">सिफारिस सूची</h4>
                        <div class="d-flex flex-wrap align-items-center">
                            @includeIf('inc.filter_form')

                            @can('recommendation_create')
                                <a href="{{ route('admin.recommendation.sipharish.sipharishCreate.create') }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-plus-circle"></i> नयाँ सिफारिस थप्नुहोस
                                </a>
                            @endcan
                            <button class="btn btn-sm mx-1 btn-outline-info waves-effect waves-light collapsed"
                                    type="button"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFilterForm" aria-expanded="false"
                                    aria-controls="collapseExample">
                                <i class="fa fa-filter"> फिल्टर</i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-2">
                        <ul class="nav nav-pills mb-3 nav-bordered nav-justified" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link  active" id="pending-tab-btn" data-bs-toggle="pill" href="#pending-tab"
                                   role="tab" aria-controls="pending-tab" aria-selected="false">Pending</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="approved-tab-btn" data-bs-toggle="pill"
                                   href="#approved-tab" role="tab" aria-controls="approved-tab" aria-selected="true">Approved</a>
                            </li>

                        </ul>
                    </div>
                    <div class="tab-content">
                        <!-- Approved Tab Content -->
                        <div class="tab-pane" id="approved-tab" role="tabpanel">
                            <table class="table table-sm table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>सेवाग्राहीको नाम</th>
                                    <th>सिफारिस नाम</th>
                                    <th>सिफारिस स्वीकृति</th>
                                    <th>स्थिति</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($sipharishCreates->where("approved_status",'approved') as $sipharish)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>   @if($sipharish->personalDetail)
                                                {{ $sipharish->personalDetail->name ?? '' }}
                                            @elseif($sipharish->mobileUser)
                                                {{ $sipharish->mobileUser->name ?? '' }}
                                            @endif</td>
                                        <td>{{ $sipharish->SipharishFormType?->title ?? '' }}</td>
                                        <td>{{ $sipharish->approved_status ?? '' }}</td>

                                        <td>
                                            @can('recommendationCategory_access')
                                                <a data-bs-type="edit" class="{{get_setting('Pin')?'confirm_pin':''}}"
                                                   href="{{route('admin.recommendation.sipharish.sipharishCreate.updateStatus',$sipharish)}}">
                                                    <i class="fa fa-2x {{ $sipharish->status ? 'fa-toggle-on ':' fa-toggle-off'}}"></i>
                                                </a>
                                            @endcan

                                        </td>
                                        <td>
                                            @can('recommendationCategory_access')
                                                <a data-bs-type="edit"
                                                   href="{{ route('admin.recommendation.sipharish.sipharishCreate.show', $sipharish->id) }}"
                                                   class="btn btn-xs btn-outline-warning {{get_setting('Pin')?'confirm_pin':''}}"
                                                   title="विवरण हेर्नुहोस">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            {{-- @can('recommendation_edit')
                                                 <a data-bs-type="edit"
                                                    href="{{ route('admin.recommendation.sipharish.sipharishCreate.edit',  $sipharish) }}"
                                                    class="btn btn-xs btn-outline-success  {{get_setting('Pin')?'confirm_pin':''}}"
                                                    title="फारम सम्पादन गर्नुहोस">
                                                     <i class="fa fa-pen"></i>
                                                 </a>
                                             @endcan
                                             @can('recommendation_delete')
                                                 <form
                                                     action="{{ route('admin.recommendation.sipharish.sipharishCreate.destroy', $sipharish) }}"
                                                     method="post">
                                                     @csrf
                                                     @method('delete')
                                                     <button data-bs-type="delete"
                                                             class="btn btn-xs btn-outline-danger {{get_setting('Pin')?'confirm_pin':'show_confirm'}}"
                                                             title="मेटाउनु होस्">
                                                         <i class="fa fa-trash"></i>
                                                     </button>
                                                 </form>
                                             @endcan--}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pending Tab Content -->
                        <div class="tab-pane  active show" id="pending-tab" role="tabpanel">
                            <table class="table table-sm table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>क्र.स</th>
                                    <th>सेवाग्राहीको नाम</th>
                                    <th>सिफारिस नाम</th>
                                    <th>सिफारिस स्वीकृति</th>
                                    <th>स्थिति</th>
                                    <th>#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($sipharishCreates->where("approved_status",'pending') as $sipharish)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>   @if($sipharish->personalDetail)
                                                {{ $sipharish->personalDetail->name ?? '' }}
                                            @elseif($sipharish->mobileUser)
                                                {{ $sipharish->mobileUser->name ?? '' }}
                                            @endif</td>
                                        <td>{{ $sipharish->SipharishFormType?->title ?? '' }}</td>
                                        <td>{{ $sipharish->approved_status ?? '' }}</td>

                                        <td>
                                            @can('recommendationCategory_access')
                                                <a data-bs-type="edit" class="{{get_setting('Pin')?'confirm_pin':''}}"
                                                   href="{{route('admin.recommendation.sipharish.sipharishCreate.updateStatus',$sipharish)}}">
                                                    <i class="fa fa-2x {{ $sipharish->status ? 'fa-toggle-on ':' fa-toggle-off'}}"></i>
                                                </a>
                                            @endcan

                                        </td>
                                        <td>
                                            @can('recommendationCategory_access')
                                                <a data-bs-type="edit"
                                                   href="{{ route('admin.recommendation.sipharish.sipharishCreate.show', $sipharish->id) }}"
                                                   class="btn btn-xs btn-outline-warning {{get_setting('Pin')?'confirm_pin':''}}"
                                                   title="विवरण हेर्नुहोस">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            {{-- @can('recommendation_edit')
                                                 <a data-bs-type="edit"
                                                    href="{{ route('admin.recommendation.sipharish.sipharishCreate.edit',  $sipharish) }}"
                                                    class="btn btn-xs btn-outline-success  {{get_setting('Pin')?'confirm_pin':''}}"
                                                    title="फारम सम्पादन गर्नुहोस">
                                                     <i class="fa fa-pen"></i>
                                                 </a>
                                             @endcan
                                             @can('recommendation_delete')
                                                 <form
                                                     action="{{ route('admin.recommendation.sipharish.sipharishCreate.destroy', $sipharish) }}"
                                                     method="post">
                                                     @csrf
                                                     @method('delete')
                                                     <button data-bs-type="delete"
                                                             class="btn btn-xs btn-outline-danger {{get_setting('Pin')?'confirm_pin':'show_confirm'}}"
                                                             title="मेटाउनु होस्">
                                                         <i class="fa fa-trash"></i>
                                                     </button>
                                                 </form>
                                             @endcan--}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
