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
                            <a href="{{route('admin.roaster.training.index')}}">तालिम</a>
                        </li>
                        <li class="breadcrumb-item">
                            तालिम रिपोर्ट
                        </li>
                    </ol>
                </div>
                <h5 class="page-title">तालिम रिपोर्ट</h5>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>तालिमको रिपोर्ट</h5>
            <div class="print-section">
                <button class="btn btn-primary btn-sm"><i class="fa fa-print"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" style="font-size: 15px;">
                    <div class="card-body">
                        <h5>१. तालिमको नाम :
                            {{$training->name ?? ''}}
                        </h5>
                    </div>
                    <div class="card-body">
                        <h5> २. तालिमको संचालन मिति
                            : {{$training->open_date ?? ''}}
                            &nbsp;&nbsp;तालिमको अन्त्य मिति
                            : {{$training->closed_date ?? ''}}
                        </h5>
                    </div>
                    <div class="card-body">
                        <h5>३. तालिमको उदेश्य :
                            {{$training->aim}}
                        </h5>
                    </div>
                    <div class="card-body">
                        <h5>४. तालिममा समाबेश गरीएका बिषयबस्तुहरु
                                :{{$training->included_subjects}}
                        </h5>
                    </div>
                    <div class="card-body">
                        <h5>५. जम्मा सहभागी संख्या:
                            {{count($training->trainingTrainees->pluck('model')->where('select',1))}}
                        </h5>
                    </div>
                    <div class="card mt-2 mb-2">
                        <div class="card-header d-flex justify-content-between">
                            <h5>६. परिक्ष्याथीको विवरण</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>पुरा नाम</th>
                                    <th>ठेगाना</th>
                                    <th>नागरिकता नं</th>
                                    <th>फोन</th>
                                    <th>इमेल</th>
                                    <th>योग्यता</th>
                                    <th>हालको पेशा</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($training->trainingTrainees->pluck('model')->where('select',1) as $trainee)
                                    <tr>
                                        <td>{{$trainee->full_name ?? ''}}</td>
                                        <td>{{$trainee->localBody->local_body ?? ''}}-{{$trainee->ward_no ?? ''}}
                                            , {{$trainee->district->district ?? ''}}
                                            , {{$trainee->province->province ?? ''}}</td>
                                        <td>{{$trainee->citizenship_no ?? ''}}</td>
                                        <td>{{$trainee->phone_no ?? ''}}</td>
                                        <td>{{$trainee->email_id ?? ''}}</td>
                                        <td>{{$trainee->qualification ?? ''}}</td>
                                        <td>{{$trainee->current_profession ?? ''}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">No Trainee Selected</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>७. उक्त तालिममा प्रशिक्षकको विवरण</h5>
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
                                        <td>{{$trainee->citizenship_no ?? ''}}</td>
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
                            <h5>८. तालिम मुल्यांकन</h5>
                            <div class="update-section">
                                <a class="btn btn-sm btn-primary"
                                   href="{{route('admin.roaster.training.marks', $training)}}">अपडेट गर्नुहोस्
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
                            <h5>९. तालिमका मुख्य मुख्य फोटोहरु</h5>
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
                    <div class="card-body"><h5>१०. फिल्ड भ्रमण सम्बन्धि विवरण: {{$training->description}}
                        </h5></div>
                    <div class="card-body"><h5>११. फिल्ड अबलोकन गरेको स्थान: {{$training->places}}</h5></div>
                </div>
            </div>
        </div>
    </div>
@endsection
