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
                            तालिम प्रिन्ट
                        </li>
                    </ol>
                </div>
                <h4 class="page-title">तालिम प्रिन्ट</h4>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title mb-0">तालिम प्रिन्ट</h4>
                    <x-print-button
                        target-element="print"
                        title="Test"
                    />
                </div>
            </div>
            <div class="card-body">
                <div id="print">
                    {!! letterHead() !!}
                    <div class="table-responsive mt-3">

                        <table class="table table-bordered table-striped table-sm">
                            <thead class="align-middle text-nowrap text-center">
                            <tr>
                                <td>क्र.सं.</td>
                                <td>पुरा नाम</td>
                                <td>ठेगाना</td>
                                <td>नागरिता नं</td>
                                <td>सम्पर्क न</td>
                                <td>इमेल</td>
                                <td> शैक्षिक योग्यता</td>
                                <td>लिङ्ग</td>
                                <td> जातीयता</td>
                                <td> हालको व्यवसाय</td>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            @foreach($training->trainingTrainees as $trainee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$trainee->model->full_name ??''}}</td>
                                    <td>{{$trainee->model->localBody->local_body ??''}} {{$trainee->model->ward_no ??''}} {{$trainee->model->district->district ??''}}{{$trainee->model->province->province ??''}}</td>
                                    <td>{{$trainee->model->citizenship_no??''}}</td>
                                    <td>{{$trainee->model->phone_no??''}}</td>
                                    <td>{{$trainee->model->email_id??''}}</td>
                                    <td>{{$trainee->model->qualification??''}}</td>
                                    <td>{{$trainee->model?->gender?->label()??''}}</td>
                                    <td>{{$trainee->model->ethnicity->title??''}}</td>
                                    <td>{{$trainee->model->current_profession??''}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
