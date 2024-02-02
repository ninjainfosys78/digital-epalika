@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.grant.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">कृषक/व्यक्ति</li>
                    </ol>
                </div>
                <h4 class="page-title">कृषक/व्यक्ति प्रोफाइल </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card text-center">
                <div class="card-body">
                    <img src="{{ $farmer->photo_url }}" class="rounded-circle avatar img-thumbnail"
                         alt="{{ $farmer->name }}" style="object-fit: cover; height: 6rem; width: 6rem">

                    <h3 class="mt-3">{{ $farmer->name }}</h3>
                    <h5 class="mb-0 text-dark">{{ $farmer->unique_id }}</h5>
                    <hr class="border-top border-1">
                    <div class="text-start mt-3">

                        <p class=" text-dark mb-2 font-16"><strong>कृषक/व्यक्ति परिचय पत्र नं :</strong>
                            <span class="ms-2 text-muted">{{ $farmer->farmer_id_card_no }}</span>
                        </p>
                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>सम्पर्क नम्बर :</strong> <span
                                class="ms-2 text-muted">{{ $farmer->phone_no }}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>नागरिकता नं. :</strong> <span
                                class="ms-2 text-muted">{{ $farmer->citizenship_no }}</span></p>

                        <p class=" border-top border-1 text-dark mb-2 font-16"><strong>लिङ्ग :</strong> <span
                                class="ms-2 text-muted">{{ $farmer->gender->label() }}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>वैवाहिक स्थिति :</strong> <span
                                class="ms-2 text-muted">{{ $farmer->marital_status->label() }}</span></p>
                        @if ($farmer->marital_status == \App\Enums\MaritalStatusEnum::MARRIED)
                            <p class="border-top border-1 text-dark mb-2 font-16"><strong>दम्पतिको नाम :</strong> <span
                                    class="ms-2 text-muted">
                                    {{ $farmer->spouse_name }}</span>
                            </p>
                        @endif

                        <p class=" border-top border-1 text-dark mb-2 font-16"><strong>बुबाको नाम :</strong> <span
                                class="ms-2 text-muted">{{ $farmer->father_name }}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>बुबा/ससुराको नाम :</strong> <span
                                class="ms-2 text-muted">{{ $farmer->grandfather_name }}</span></p>

                        <p class="border-top border-1 text-dark mb-2 font-16"><strong>ठेगाना :</strong> <span
                                class="ms-2 text-muted">{{ $farmer->province->province ?? '' }},
                                {{ $farmer->district->district ?? '' }},
                                {{ $farmer->localBody->local_body ?? '' }} -
                                {{ $farmer->ward_no ?? '' }},
                                {{ $farmer->village ?? '' }}
                                {{ $farmer->tole ?? '' }}
                            </span></p>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8 ">
            <div class="row">
                <div class="col-md-4 text-center px-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class=" text-dark font-19">आवद्ध सहकारी</h4>
                            <p class=" pt-1 font-16">कृषक/व्यक्तिको आवद्ध सहकारी।</p>
                        </div>
                        <div class="card-btn pb-2">
                            <a href="" class="btn btn-sm btn-outline-primary "> विवरण हेर्नुहोस <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center px-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class=" text-dark font-19">आवद्ध उधम</h4>
                            <p class=" pt-1 font-16">कृषक/व्यक्तिको आवद्ध उधम।</p>
                        </div>
                        <div class="card-btn pb-2">
                            <a href="" class="btn btn-sm btn-outline-primary "> विवरण हेर्नुहोस <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center px-2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class=" text-dark font-19">आवद्ध समुह</h4>
                            <p class=" pt-1 font-16">कृषक/व्यक्तिको आवद्ध समुह।</p>
                        </div>
                        <div class="card-btn pb-2">
                            <a href="" class="btn btn-sm btn-outline-primary "> विवरण हेर्नुहोस <i
                                    class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title my-2">
                            अनुदानग्राही तालिका
                        </h4>
                        <a href="{{ route('admin.grant.farmer.grantDetails', $farmer) }}"
                           class="btn btn-outline-primary btn-sm" style="border-radius: 25px; padding:10px">विवरण
                            हेर्नुहोस</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mt-3">
                            <thead>
                            <tr>
                                <th scope="col">क्र.स</th>
                                <th scope="col">कार्यक्रम/क्रियाकलाप</th>
                                <th scope="col">अनुदानग्राही लगानी</th>
                                <th scope="col">अनुदान स्थल</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($farmer->grantDetails as $grantDetail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $grantDetail->grant->grantProgram->name ?? '' }}</td>
                                    <td>{{ $grantDetail->personal_investment }}</td>
                                    <td>{{ $grantDetail->localBody->local_body ?? '' }}
                                        - {{ $grantDetail->ward_no }} {{ $grantDetail->village }},
                                        {{ $grantDetail->tole }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title my-2">
                            परिवार विवरण
                        </h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mt-3">
                            <thead>
                            <tr>
                                <th scope="col">क्र.स</th>
                                <th scope="col">नाम</th>
                                <th scope="col">नागरिकता नं</th>
                                <th scope="col">नाता</th>
                                <th scope="col">अहिलेसम्म लागेको अनुदान</th>
                                <th scope="col">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($families as $family)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$family->name ?? ''}}</td>
                                    <td>{{$family->citizenship_no ?? ''}}</td>
                                    <td>{{$family->relationship->title ?? 'घरमुली'}}</td>
                                    <td>{{count($family->grantDetails) ?? 0}}</td>
                                    <td>
                                        <a data-bs-type="edit" href="{{route('admin.grant.farmer.show', $family)}}"
                                           class="btn btn-xs btn-outline-primary {{get_setting('Pin')?'confirm_pin':''}}"
                                           title="विवरण हेर्नुहोस">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @can('farmer_edit')
                                            <a data-bs-type="edit" href="{{route('admin.grant.farmer.edit', $family)}}"
                                               class="btn btn-xs btn-outline-primary {{get_setting('Pin')?'confirm_pin':''}}"
                                               title="सम्पादन गर्नुहोस्">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('farmer_delete')
                                            <form
                                                action="{{route('admin.grant.farmer.destroy', $family)}}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button data-bs-type="delete"
                                                        class="btn btn-xs btn-outline-danger {{get_setting('Pin')?'confirm_pin':'show_confirm'}}"
                                                        title=" मेटाउनु होस्">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
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
