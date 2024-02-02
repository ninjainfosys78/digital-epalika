@extends('admin.layouts.master')
@section('content')
    <div class="">
        <div class="page-title d-flex justify-content-between">
            <h5>प्राविधिक प्रशिक्षार्थी</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">ड्यासबोर्ड</a></li>
                    <li class="breadcrumb-item active" aria-current="page">प्राविधिक प्रशिक्षार्थी विवरण</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-header">
                प्राविधिक प्रशिक्षार्थी विवरण
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>फोटो</th>
                        <td>
                            <img
                                src="{{$technicalTrainee->photo_url}}"
                                alt="" width="80">
                        </td>
                    </tr>
                    <tr>
                        <th>नाम</th>
                        <td>
                            {{$technicalTrainee->employee_name}}
                        </td>
                    </tr>
                    <tr>
                        <th>प्रशिक्षार्थी आइडी</th>
                        <td>
                            {{$technicalTrainee->reference_id}}
                        </td>
                    </tr>
                    <tr>
                        <th>पद</th>
                        <td>
                            {{$technicalTrainee->designation->title??''}}
                        </td>
                    </tr>
                    <tr>
                        <th>सेवा समुह</th>
                        <td>
                            {{$technicalTrainee->department->title??''}}
                        </td>
                    </tr>
                    <tr>
                        <th>सेवा अवधि</th>
                        <td>
                            {{$technicalTrainee->service_time}}
                        </td>
                    </tr>

                    <tr>
                        <th>ठेगाना</th>
                        <td>
                            {{$technicalTrainee->LocalBody->local_body ??''}}, {{$technicalTrainee->ward_no}}
                            - {{$technicalTrainee->district->district??''}}
                            ,{{$technicalTrainee->province->province??''}}
                        </td>
                    </tr>
                    <tr>
                        <th>फोन</th>
                        <td>
                            {{$technicalTrainee->contact_no}}
                        </td>
                    </tr>
                    <tr>
                        <th>इमेल</th>
                        <td>{{$technicalTrainee->email}}</td>
                    </tr>
                    <tr>
                        <th>शैक्षिक योग्यता</th>
                        <td>{{$technicalTrainee->education_qualification}}</td>
                    </tr>
                    <tr>
                        <th>कार्यालयको नाम</th>
                        <td>{{$technicalTrainee->office_name}}</td>
                    </tr>
                    <tr>
                        <th>कार्यालयको ठेगाना</th>
                        <td>{{$technicalTrainee->office_address}}</td>
                    </tr>
                    <tr>
                        <th>कार्यालयको फोन नम्बर</th>
                        <td>{{$technicalTrainee->office_phone}}</td>
                    </tr>
                    <tr>
                        <th>कार्यालयको इमेल</th>
                        <td>{{$technicalTrainee->office_email}}</td>
                    </tr>

                </table>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h6>मनोनयन पत्र</h6>
                                <div class="header-button">
                                    <a href="{{$technicalTrainee->nomination_letter_url}}"
                                       download="{{$technicalTrainee->nomination_letter_url}}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <img class="file"
                                     src="{{$technicalTrainee->nomination_letter_url}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h6>सिफारिस</h6>
                                <div class="header-button">
                                    <a href="{{$technicalTrainee->recommendation_letter_url}}"
                                       download="{{$technicalTrainee->recommendation_letter_url}}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <img class="file"
                                     src="{{$technicalTrainee->recommendation_letter_url}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h6> अन्य कागजातहरु </h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>क्र.सं.</th>
                                <th>कागजातको नाम</th>
                                <th>फाइल</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($technicalTrainee->documents as $document)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$document->title}}</td>
                                    <td>
                                        <a href="{{$document->document_url}}" download="{{$document->document_url}}">
                                            <i class="fa fa-download"></i>
                                            File Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@endsection
