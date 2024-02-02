@extends('frontend.layouts.master')
@section('content')
        <div class="content-section">
            <div class="breadcrumb mt-3 d-flex">
                <div class="breadcrumb-item">
                    <a class="whitespace-nowrap text-primary-500" href="{{route('digitalBoard.helpdesk.helpdesk')}}">हेल्प डेस्क</a>
                    <i class="fa fa-angle-double-right text-light"></i>
                    <a class="ml-1 text-primary-500">{{$service->service_name}}</a>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card border-info">
                    <div class="text-center text-decoration-underline mt-2">
                        <h6 class="fw-bold fs-5">{{$service->service_name}}</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">सेवाको नाम</th>
                                <th scope="col">आवश्यक कागजात</th>
                                <th scope="col">सिफारिस/प्रमिरित उपलब्ध गराउने प्रक्रिया</th>
                                <th scope="col">लाग्ने समय</th>
                                <th scope="col">जिम्मेवार अधिकारी</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">{{$service->service_name}}</td>
                                <td>
                                    <ol>
                                        @foreach($service->serviceDocuments as $requiredDocument)
                                            <li>{{$requiredDocument->description}}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>
                                    <ol>
                                        @foreach($service->serviceProcesses as $process)
                                            <li>{{$process->description}}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>{{$service->time_taken}}</td>
                                <td class="responsive-person" width="250">
                                    {{$service->responsible_officer}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            @foreach($service->serviceEmployees as $responsibleEmployee)
                            <div class="card-02 col-md-4 mb-2 px-5">
                                <div class="card responsible-person shadow text-center">
                                    <img class="mt-1 rounded-circle mx-auto" src="{{$responsibleEmployee->photo_url}}" alt="">
                                    <div class="card-body p-0 mt-1 m-0">
                                        <div class="card-description ">
                                            <h5 class="card-title pt-1">{{$responsibleEmployee->employee_name}}</h5>
                                            <h6 class="card-title ">पद: {{$responsibleEmployee->designation}}</h6>
                                            <p>{{$responsibleEmployee->email}}</p>
                                            <p>{{$responsibleEmployee->phone}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card-body d-flex justify-content-sm-between">
                            <h6>आवश्यक कागजातहरु सबै छन् ?</h6>
                            <div class="action">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#token">
                                    छन्
                                </button>
                                <div class="modal fade" id="token" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    छन् भने आफ्नो सम्पर्क न. हल्नुहोस
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="">
                                                        <input type="text" class="form-control" name="contact_no"
                                                               placeholder="सम्पर्क न.">
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">रद्द गर्नुहोस्</button>
                                                <button type="submit" class="btn btn-primary">पठाउनुहोस</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-danger" href="{{route('digitalBoard.helpdesk.helpdesk')}}">
                                    छैनन्
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
