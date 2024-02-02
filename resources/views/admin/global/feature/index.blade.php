@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                                <i class="fa fa-home"></i>गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.global.dashboard')}}">सेटिङ</a>
                        </li>
                        <li class="breadcrumb-item active">सुविधा सेटिंग सम्पादन गर्नुहोस्</li>
                    </ol>
                </div>
                <h4 class="page-title">सुविधा सेटिंग</h4>
            </div>
        </div>
    </div>

    @foreach($featureActivations as $key=>$featureActivation)
        <div class="row">
            <h4 class="page-title">{{\App\Enums\FeatureTypeEnum::tryFrom($key)->label()}}</h4>
            @foreach($featureActivation as $data)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                {{$data->feature_name_ne}}
                            </h5>
                        </div>
                        <div class="card-body">
                            <a href="{{route('admin.global.update-feature-activation',$data)}}">
                                <i class="fa fa-2x fa-toggle-{{$data->feature_status===true ? 'on':'off'}} text-{{$data->feature_status===true ? 'success':'danger'}}"></i>
                            </a>

                        </div>
                        <p class="px-2">{{$data->feature_description}}</p>
                        <p class="px-2 text-center my-2"><a href="{{$data->feature_type->settingUrl()}}">Click Here</a>
                        </p>

                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
