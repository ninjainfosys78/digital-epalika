@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.plan.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">योजना {{$type=='planSubLevel' ? 'उपस्तरहरु':'स्तरहरू'}}</li>
                    </ol>
                </div>
                <h4 class="page-title">योजना {{$type=='planSubLevel' ? 'उपस्तरहरु':'स्तरहरू'}}</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">योजना {{$type=='planSubLevel' ? 'उपस्तरहरु':'स्तरहरू'}} सम्पादन गर्नुहोस्</h4>
                        <a href="{{route('admin.plan.planLevel.index',$type)}}" class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> योजना {{$type=='planSubLevel' ? 'उपस्तरहरु':'स्तरहरू'}}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.plan.planLevel.update',[$type,$planLevel])}}" method="post">
                        @csrf
                        @method('put')
                        <div class="row">
                            @if($type=='planSubLevel')
                            <div class="col-md-12 mb-2">
                                <label for="plan_level_id" class="form-label">मुख्य योजना स्तर</label>
                                <select
                                    name="plan_level_id"
                                    class="form-control @error('plan_level_id') is-invalid @enderror"
                                    id="plan_level_id" data-toggle="select2" data-width="100%">
                                    <option value="">--- छान्नुहोस् ---</option>
                                    @foreach($mainLevels as $mainLevel)
                                        <option {{$mainLevel->id==old('plan_level_id',$planLevel->plan_level_id) ? 'selected' : ''}}
                                                value="{{$mainLevel->id}}">
                                            {{$mainLevel->level_name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('plan_level_id')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            @endif
                            <div class="col-md-12 mb-2">
                                <label for="level_name" class="form-label">स्तर को नाम *</label>
                                <input
                                    type="text"
                                    name="level_name"
                                    value="{{old('level_name',$planLevel->level_name)}}"
                                    class="form-control @error('level_name') is-invalid @enderror"
                                    id="level_name"
                                    placeholder="योजना स्तर"
                                    required
                                />
                                @error('level_name')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
