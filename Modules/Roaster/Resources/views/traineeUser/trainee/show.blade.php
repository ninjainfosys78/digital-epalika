@extends('roaster::traineeUser.layouts.master')
@section('content')
    <div class="">
        <div class="page-title d-flex justify-content-between">
            <h5>प्रशिक्षार्थी</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">ड्यासबोर्ड</a></li>
                    <li class="breadcrumb-item active" aria-current="page">प्रशिक्षार्थी विवरण</li>
                </ol>
            </nav>
        </div>
        <div class="card">
            <div class="card-header">
                प्रशिक्षार्थी विवरण
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <tr>
                            <th>फोटो</th>
                            <td>
                                <img
                                    src="{{$trainee->photo_url}}"
                                    alt="" width="80">
                            </td>
                        </tr>
                        <tr>
                            <th>नाम</th>
                            <td>
                                {{$trainee->full_name}}
                            </td>
                        </tr>

                        @if($trainee->is_employee==1)
                        <tr>
                            <th>सेवा समुह </th>
                            <td>
                                {{$trainee->department->title??''}}
                            </td>
                        </tr>
                        <tr>
                            <th>पद</th>
                            <td>
                                {{$trainee->designation->title??''}}
                            </td>
                        </tr>
                        <tr>
                            <th>सेवा अवधि</th>
                            <td>
                                {{$trainee->service_time}}
                            </td>
                        </tr>
                        <tr>
                            <th>कार्यालयको
                                नाम</th>
                            <td>
                                {{$trainee->office_name}}
                            </td>
                        </tr>
                        <tr>
                            <th> कार्यालयको
                                ठेगाना</th>
                            <td>
                                {{$trainee->office_address}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                कार्यालयको
                                फोन नम्बर</th>
                            <td>
                                {{$trainee->office_phone}}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                कार्यालयको इमेल</th>
                            <td>
                                {{$trainee->office_email}}
                            </td>
                        </tr>

                        @endif
                        <tr>
                            <th>प्रशिक्षार्थी आइडी</th>
                            <td>
                                {{$trainee->reference_id}}
                            </td>
                        </tr>

                        <tr>
                            <th>ठेगाना</th>
                            <td>
                                {{$trainee->LocalBody->local_body ??''}}, {{$trainee->ward_no}}
                                - {{$trainee->district->district??''}} ,{{$trainee->province->province??''}}
                            </td>
                        </tr>
                        <tr>
                            <th>फोन</th>
                            <td>
                                {{$trainee->phone_no}}
                            </td>
                        </tr>
                        <tr>
                            <th>इमेल</th>
                            <td>{{$trainee->email_id}}</td>
                        </tr>
                        <tr>
                            <th>शैक्षिक योग्यता</th>
                            <td>{{$trainee->qualification}}</td>
                        </tr>
                        <tr>
                            <th>नागरिकता नं</th>
                            <td>{{$trainee->citizenship_no}}</td>
                        </tr>

                        <tr>
                            <th>लिङ्ग</th>
                            <td>{{$trainee->gender}}</td>
                        </tr>
                        <tr>
                            <th>जातीय</th>
                            <td>{{$trainee->ethnicity->title??''}}</td>
                        </tr>
                        <tr>
                            <th>हालको पेशा</th>
                            <td>{{$trainee->current_profession}}</td>
                        </tr>

                    </table>
                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h6>वडा सिफारिस</h6>
                                    <div class="header-button">
                                        <a href="{{$trainee->ward_recommendation}}"
                                           download="{{$trainee->ward_recommendation}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img class="file"
                                         src="{{$trainee->ward_recommendation}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h6>आवेदन फारम</h6>
                                    <div class="header-button">
                                        <a href="{{$trainee->application_form}}"
                                           download="{{$trainee->application_form}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img class="file"
                                         src="{{$trainee->application_form}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h6>मार्कसिट</h6>
                                    <div class="header-button">
                                        <a href="{{$trainee->mark_sheet}}" download="{{$trainee->mark_sheet}}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img class="file"
                                         src="{{$trainee->mark_sheet}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h6>नागरिकता (अगाडि)</h6>
                                    <div class="header-button">
                                        <a href="{{$trainee->citizenship_front}}"
                                           download="{{$trainee->citizenship_front}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img class="file"
                                         src="{{$trainee->citizenship_front}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h6>नागरिकता (पछाडि)</h6>
                                    <div class="header-button">
                                        <a href="{{$trainee->citizenship_back}}"
                                           download="{{$trainee->citizenship_back}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img class="file"
                                         src="{{$trainee->citizenship_back}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h6>राहदानी</h6>
                                    <div class="header-button">
                                        <a href="{{$trainee->passport}}" download="{{$trainee->passport}}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img class="file"
                                         src="{{$trainee->passport}}">
                                </div>
                            </div>
                        </div>
                        @if($trainee->is_employee==1)
                        <div class="col-md-6 mt-2">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h6>मनोनयन पत्र</h6>
                                    <div class="header-button">
                                        <a href="{{$trainee->nomination_letter}}" download="{{$trainee->nomination_letter}}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img class="file"
                                         src="{{$trainee->nomination_letter}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h6>सिफारिस </h6>
                                    <div class="header-button">
                                        <a href="{{$trainee->recommendation_letter}}" download="{{$trainee->recommendation_letter}}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img class="file"
                                         src="{{$trainee->recommendation_letter}}">
                                </div>
                            </div>
                        </div>
                        @endif

                        @foreach ($trainee->documents as $document)
                        <div class="col-md-6 mt-2">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h6>{{ $document->title }} </h6>
                                    <div class="header-button">
                                        <a href="{{$document->document_url}}" download="{{$document->document_url}}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <img class="file"
                                         src="{{$document->document_url}}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
