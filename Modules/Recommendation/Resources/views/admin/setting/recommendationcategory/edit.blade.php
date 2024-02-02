@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.recommendation.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>

                        <li class="breadcrumb-item active">{{$type=="recommendationCategory" ? 'सिफारिस श्रेणी':'सिफारिस उप श्रेणी'}}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{$type=="recommendationCategory" ? 'सिफारिस श्रेणी':'सिफारिस उप श्रेणी'}}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">{{$type=="recommendationCategory" ? 'सिफारिस श्रेणी':'सिफारिस उप श्रेणी'}} सम्पादन गर्नुहोस</h4>
                        @can('branch_create')
                            <a href="{{ route('admin.recommendation.setting.recommendationCategory.index', $type) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> {{$type=="recommendationCategory" ? 'सिफारिस श्रेणी':'सिफारिस उप श्रेणी'}} सूची
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.recommendation.setting.recommendationCategory.update', [ $type, $recommendationCategory]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            @if($type=='recommendationSubCategory')
                            <div class="col-md-12">
                                <label for="recommendation_category_id">वर्ग</label>
                                <select id="recommendation_category_id" name="recommendation_category_id" class="form-control">
                                    <option>छान्नुहोस्</option>
                                    @foreach ($recommendationCategories as $recommendationCategoryData )
                                    <option value="{{ $recommendationCategoryData->id }}" {{ old('recommendation_category_id',$recommendationCategory->recommendation_category_id) == $recommendationCategoryData->id ? 'selected':''}}>{{ $recommendationCategoryData->title }}</option>
                                    @endforeach

                                </select>
                            </div>
                            @endif
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">शिर्षक *</label>
                                <input type="text" name="title" value="{{ old('title',$recommendationCategory->title) }}"
                                    class="form-control @error('title') is-invalid @enderror" id="name"
                                    placeholder="शिर्षक" required />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            पेश गर्नुहोस्
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
