@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.grant.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">अनुदान विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">अनुदान प्रोफाइल </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-xl-8">
            <div class="card text-center">
                <div class="card-body">
                    <div class="text-start mt-3">

                        <p class=" text-dark mb-2 font-16"><strong>अनुदान कार्यक्रम/क्रियाकलाप :</strong>
                            <span class="ms-2 text-muted">{{$grantDetail->grant->grant_program_name->name??''}}</span>
                        </p>
                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>अनुदानग्राही :</strong> <span
                                class="ms-2 text-muted">{{$grantDetail->model->name}}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>अनुदानग्राहीको प्रकार :</strong> <span
                                class="ms-2 text-muted">{{$grantDetail->grant_for->label()}}</span></p>

                        <p class=" border-top border-1 text-dark mb-2 font-16"><strong>अनुदानग्राहीको लगानी :</strong> <span
                                class="ms-2 text-muted">{{$grantDetail->personal_investment}}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>नयाँ वा निरन्तर</strong> <span
                                class="ms-2 text-muted">{{$grantDetail->is_old ? 'निरन्तरता': 'नयाँ'}}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>गत वर्षको लगानी:</strong> <span
                                class="ms-2 text-muted">{{$grantDetail->investment_amount}}</span></p>

                        <p class=" border-top border-1 text-dark mb-2 font-16"><strong>कित्ता नं. :</strong> <span
                                class="ms-2 text-muted">{{$grantDetail->plot_no}}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>अनुदान स्थल :</strong> <span
                                class="ms-2 text-muted">{{$grantDetail->localBody->local_body ?? ''}} - {{$grantDetail->ward_no}} {{$grantDetail->village}}, {{$grantDetail->tole}}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>सम्पर्क ब्यक्ति :</strong> <span
                                class="ms-2 text-muted">{{$grantDetail->contact_person}}
                            </span></p>
                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>सम्पर्क नं :</strong> <span
                                class="ms-2 text-muted">{{$grantDetail->contact}}
                            </span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>कैफियत :</strong> <span
                                class="ms-2 text-muted">{{$grantDetail->remarks}}
                            </span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

