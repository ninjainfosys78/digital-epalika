@extends('admin.layouts.master')
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.roaster.dashboard')}}">
                                   <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.roaster.training.index')}}">तालिम विवरण</a>
                            </li>
                            <li class="breadcrumb-item">
                                 मार्क अपडेट
                            </li>
                        </ol>
                    </div>
                    <h5 class="page-title"> मार्क अपडेट</h5>
                </div>
            </div>
        </div>
    <div class="card">
        <div class="card-header">
            <h4>मार्क अपडेट गर्नुहोस्</h4>
        </div>
        <div class="card-body">
            <form action="{{route('admin.roaster.training.update-marks', $training)}}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="pre_max_mark">पूर्व अधिकतम अंक</label>
                        <input type="number" name="pre_max_mark" value="{{old('pre_max_mark',$training->pre_max_mark)}}"
                               class="form-control @error('pre_max_mark') is-invalid @enderror" id="pre_max_mark"
                               min="0">
                        @error('pre_max_mark')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="pre_min_mark">पूर्व न्यूनतम अंक</label>
                        <input type="number" name="pre_min_mark" value="{{old('pre_min_mark',$training->pre_min_mark)}}"
                               class="form-control @error('pre_min_mark') is-invalid @enderror" id="pre_min_mark"
                               min="0">
                        @error('pre_min_mark')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="pre_average_mark">पूर्व औसत अंक</label>
                        <input type="number" name="pre_average_mark"
                               value="{{old('pre_average_mark',$training->pre_average_mark)}}"
                               class="form-control @error('pre_average_mark') is-invalid @enderror"
                               id="pre_average_mark" min="0">
                        @error('pre_average_mark')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="post_max_mark">पोस्ट अधिकतम अंक</label>
                        <input type="number" name="post_max_mark"
                               value="{{old('post_max_mark',$training->post_max_mark)}}"
                               class="form-control @error('post_max_mark') is-invalid @enderror"
                               id="post_max_mark" min="0">
                        @error('post_max_mark')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="post_min_mark">पोस्ट न्यूनतम अंक</label>
                        <input type="number" name="post_min_mark"
                               value="{{old('post_min_mark',$training->post_min_mark)}}"
                               class="form-control @error('post_min_mark') is-invalid @enderror"
                               id="post_min_mark" min="0">
                        @error('post_min_mark')<span class="text-danger">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group col-md-4">
                        <label for="post_average_mark">पोस्ट न्यूनतम अंक</label>
                        <input type="number" name="post_average_mark"
                               value="{{old('post_average_mark',$training->post_average_mark)}}"
                               class="form-control @error('post_average_mark') is-invalid @enderror"
                               id="post_average_mark" min="0">
                        @error('post_average_mark')<span class="text-danger">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="name">तालिमको नाम</label>
                        <input type="text" name="name" value="{{old('name', $training->name)}}"
                               class="form-control  @error('name') is-invalid @enderror"
                               id="name">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="places">फिल्ड भ्रमण स्थल</label>
                        <input type="text" name="places" value="{{old('places',$training->places)}}"
                               class="form-control @error('places') is-invalid @enderror"
                               id="places">
                        @error('places')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label for="included_subjects">समावेश गरिएका बिषयहरु</label>
                        <input type="text" name="included_subjects"
                               value="{{old('included_subjects',$training->included_subjects)}}"
                               class="form-control @error('included_subjects') is-invalid @enderror"
                               id="included_subjects">
                        @error('included_subjects')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="aim">लक्ष्य :</label>
                        <textarea name="aim" id="aim" cols="20" rows="10"
                                  class="form-control  @error('aim') is-invalid @enderror">{{old('aim',$training->aim)}}</textarea>
                        @error('aim')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">क्षेत्र विवरण:</label>
                        <textarea name="description" id="description" cols="20" rows="10"
                                  class="form-control  @error('description') is-invalid @enderror">{{old('description',$training->description)}}</textarea>
                        @error('description')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                        <div class="col-md-12 d-flex justify-content-around pt-1">
                            <button class="btn btn-danger" type="submit"> पेश गर्नुहोस्</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
@endsection
