@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.businessRegistration.businessRegistration.index')}}">व्यवसाय
                                दर्ता </a>
                        </li>
                        <li class="breadcrumb-item active">व्यवसाय दर्ता</li>
                    </ol>
                </div>
                <h4 class="page-title">व्यवसाय दर्ता </h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">व्यवसाय दर्ता सूची</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm mb-2 table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th>क्र.स.</th>
                                <th>नाम</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse(\Modules\BusinessRegistration\Enums\TemplateTypeEnum::cases() as $businessRegistrationEnum)
                                <tr>
                                    <th>{{$loop->iteration}}</th>
                                    <th>{{$businessRegistrationEnum->label()}}</th>
                                    <td>
                                        <a href="{{route('admin.businessRegistration.businessRegistration.enumType',$businessRegistrationEnum)}}" >
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="13">तालिकामा कुनै डाटा उपलब्ध छैन !!!</td>
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

