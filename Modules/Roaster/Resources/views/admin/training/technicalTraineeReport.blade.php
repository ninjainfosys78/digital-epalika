@extends('admin.layouts.master')
@section('content')
    <div class="">
        <div class="page-title d-flex justify-content-between">
            <h5>रिपोर्ट</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">ड्यासबोर्ड</a></li>
                    <li class="breadcrumb-item active" aria-current="page">तालिमको रिपोर्ट</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h6>तालिमको रिपोर्ट</h6>
                <div class="print-section">
                    <button class="btn btn-primary btn-sm"><i class="fa fa-print"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" style="font-size: 15px;">
                        <div class="card-body"><h6>१. <b>तालिमको नाम</b> : {{$training->name ?? ''}} </h6></div>
                        <div class="card-body"><h6> २. <b>तालिमको संचालन मिति</b>
                                : {{$training->open_date->toDateString() ?? ''}}
                                &nbsp;&nbsp;<b>तालिमको अन्त्य मिति </b>
                                : {{$training->closed_date->toDateString() ?? ''}} </h6></div>
                        <div class="card-body"><h6>३. <b>तालिमको उदेश्य</b> : {{$training->aim}}</h6></div>
                        <div class="card-body"><h6>४. <b>तालिममा समाबेश गरीएका बिषयबस्तुहरु
                                    :</b>{{$training->included_subjects}} </h6></div>
                        <div class="card-body">
                            <h6>५. <b>जम्मा सहभागी संख्या</b>:
                                {{count($training->trainingTrainees->pluck('model')->where('select',1))}}</h6>
                        </div>
                        <div class="card mt-2 mb-2">
                            <div class="card-header d-flex justify-content-between">
                                <h6 class="fw-bold">६. परिक्ष्याथीको विवरण</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>पुरा नाम</th>
                                        <th>ठेगाना</th>
                                        {{--                                        <th>पद</th>--}}
                                        <th>फोन</th>
                                        <th>इमेल</th>
                                        <th>शैक्षिक योग्यता</th>
                                        <th>कार्यालयको नाम,  ठेगाना </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($training->trainingTrainees->pluck('model')->where('select',1) as $trainee)
                                        <tr>
                                            <td>{{$trainee->employee_name ?? ''}}</td>
                                            <td>{{$trainee->localBody->local_body ?? ''}}-{{$trainee->ward_no ?? ''}}
                                                , {{$trainee->district->district ?? ''}}
                                                , {{$trainee->province->province ?? ''}}</td>
                                            {{--                                            <td>{{$trainee->designation->title ?? ''}}</td>--}}
                                            <td>{{$trainee->contact_no ?? ''}}</td>
                                            <td>{{$trainee->email ?? ''}}</td>
                                            <td>{{$trainee->education_qualification ?? ''}}</td>
                                            <td>{{$trainee->office_name ?? ''}}, {{$trainee->office_address ?? ''}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No Trainee Selected</td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h6>७. उक्त तालिममा प्रशिक्षकको विवरण</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>नाम</th>
                                        <th>अफिस</th>
                                        <th>ठेगाना</th>
                                        <th>पद</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($training->trainers as $trainer)
                                        <tr>
                                            <td>{{$trainer->name}}</td>
                                            <td>{{$trainer->office}}</td>
                                            <td>{{$trainer->localBody->local_body ?? ''}}-{{$trainer->ward ?? ''}}
                                                , {{$trainer->district->district ?? ''}}
                                                , {{$trainer->province->province ?? ''}}
                                            </td>
                                            <td>{{$trainer->designation->title}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">कुनै डाटा उपलब्ध छैन</td>
                                        </tr>
                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-header d-flex justify-content-between">
                                <h6>८. तालिम मुल्यांकन</h6>
                                <div class="update-section">
                                    <a class="btn btn-sm btn-primary" href="{{route('admin.roaster.training.marks', $training)}}">अपडेट गर्नुहोस्
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>सहभागी संख्या</th>
                                        <th>प्राप्त अधिक अंक</th>
                                        <th>प्राप्त न्यूनतम अंक</th>
                                        <th>ओषत</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th>पूर्व परिक्षा</th>
                                        <th>{{count($training->trainingTrainees->pluck('model')->where('select',1))}}</th>
                                        <th>{{$training->pre_max_mark ?? ''}}</th>
                                        <th>{{$training->pre_min_mark ?? ''}}</th>
                                        <th>{{$training->pre_average_mark ?? ''}}</th>
                                    </tr>
                                    <tr>
                                        <th>अन्तिम परिक्षा</th>
                                        <th>{{count($training->trainingTrainees->pluck('model')->where('select',1))}}</th>
                                        <th>{{$training->post_max_mark ?? ''}}</th>
                                        <th>{{$training->post_min_mark ?? ''}}</th>
                                        <th>{{$training->post_average_mark ?? ''}}</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-header d-flex justify-content-between">
                                <h6>९. तालिमका मुख्य मुख्य फोटोहरु</h6>
                            </div>
                            <div class="card-body">
                                @foreach($training->documents as $document)
                                    <div class="col-md-3">
                                        <img src="{{$document->document_url}}" height="150">
                                    </div>
                                @endforeach

                            </div>
                            <div class="card-footer">
                                <form action="{{route('admin.roaster.training.store-photos',$training)}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="com-md-8">
                                            <div class="form-group">
                                                <input type="file" name="images[]" class="form-control" multiple="">
                                            </div>
                                            @error('images.*')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            @error('images')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <input class="btn btn-danger" type="submit" value="Save" name="submit">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body"><h6>१०. <b>फिल्ड भ्रमण सम्बन्धि विवरण:</b> {{$training->description}}
                            </h6></div>
                        <div class="card-body"><h6>११. <b>फिल्ड अबलोकन गरेको स्थान: </b>{{$training->places}}</h6></div>
                    </div>
                </div>
            </div>
        </div>
@endsection
