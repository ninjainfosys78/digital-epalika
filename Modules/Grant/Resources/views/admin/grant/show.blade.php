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
                        <li class="breadcrumb-item active">अनुदान जारि</li>
                    </ol>
                </div>
                <h4 class="page-title">अनुदान कार्यक्रम प्रोफाइल </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <div class="text-start mt-3">

                        <p class=" text-dark mb-2 font-16"><strong>अनुदान कार्यक्रम :</strong>
                            <span class="ms-2 text-muted">
                                {{$grant->grant_program_name??''}}
                            </span>
                        </p>
                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>आर्थिक वर्ष :</strong> <span
                                class="ms-2 text-muted">
                                {{$grant->fiscalYear->title??''}}
                            </span>
                        </p>
                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>अनुदान प्रकार :</strong>
                            <span class="ms-2 text-muted">
                                {{$grant->grantType->title??''}}
                            </span>
                        </p>
                        <p class=" border-top border-1 text-dark mb-2 font-16"><strong>अनुदान दिने संस्था :</strong>
                            <span class="ms-2 text-muted">
                                {{$grant->grantOffice->office_name??''}}
                            </span>
                        </p>
                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>शाखा :</strong> <span
                                class="ms-2 text-muted">{{$grant->branch->branch_name??''}}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>अनुदान रकम :</strong> <span
                                class="ms-2 text-muted">{{$grant->grant_amount}}</span></p>

                        <div class="border-top border-1 text-dark mb-2 font-16"><strong>अनुदान लागि :</strong>
                            <ul class="ms-2 text-muted">
                                @foreach($grant->grant_for_data as $grant_for)
                                    <li>
                                        {{\Modules\Grant\Enums\GranteeEnum::tryFrom($grant_for)->label()}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>कैफियत :</strong> <span
                                class="ms-2 text-muted">
                                {{$grant->remarks}}
                            </span></p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title my-2">
                            अनुदानग्राही प्राप्तकर्ता
                        </h4>
                        <a href="{{route('admin.grant.grant.grantDetails',$grant)}}"
                         class="btn btn-outline-primary btn-sm" style="border-radius: 25px; padding:10px">विवरण हेर्नुहोस</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mt-3">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>नाम</th>
                                <th>अनुदानग्राहीको प्रकार</th>
                                <th>अनुदान रकम</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($grant->grantDetails as $grantDetail)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$grantDetail->model->name??''}}</td>
                                    <td>{{$grantDetail->grant_for?->label()}}</td>
                                    <td>{{$grantDetail->grant_amount??''}}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

