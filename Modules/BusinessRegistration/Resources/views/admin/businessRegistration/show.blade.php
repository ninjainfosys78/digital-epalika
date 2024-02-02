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
                        <li class="breadcrumb-item active">व्यवसायीको विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">व्यवसायीको विवरण </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills nav-fill navtab-bg">
                        <li class="nav-item">
                            <a href="#detail" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                विवरण
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#reg" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                दर्ता
                            </a>
                        </li>
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="#tax" data-bs-toggle="tab" aria-expanded="true" class="nav-link">--}}
                        {{--                                व्यवसाय कर दर्ता किताव--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                        <li class="nav-item">--}}
                        {{--                            <a href="#application" data-bs-toggle="tab" aria-expanded="false" class="nav-link">--}}
                        {{--                                व्यवसाय दर्ता प्रमाण-पत्र--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="detail">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h4 class="header-title">
                                                व्यवसायीको विवरण
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-sm mb-0 table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>नाम</th>
                                                        <td>{{$businessDetail->name??''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>नाम अंग्रेजी</th>
                                                        <td>{{$businessDetail->name_en??''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> ठेगाना</th>
                                                        <td>{{$businessDetail->address??''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> ठेगाना अंग्रेजी</th>
                                                        <td>{{$businessDetail->address_en??''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> व्यवसायको प्रकृति</th>
                                                        <td>{{$businessDetail->businessNature->title??''}}</td>
                                                    </tr>

                                                    <tr>
                                                        <th> कारोबार गर्ने वस्तु</th>
                                                        <td>{{$businessDetail->objectTransaction->title??''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> चालु पूँजी</th>
                                                        <td>{{ $businessDetail->working_capital ?? ''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> स्थिर पूँजी</th>
                                                        <td>{{$businessDetail->fixed_capital??''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> पुँजीगत लगानी</th>
                                                        <td>{{$businessDetail->investment??''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> उदेश्य</th>
                                                        <td>{{$businessDetail->purpose ??''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> ठेगाना</th>
                                                        <td>
                                                            {{$businessDetail->LocalBody->local_body ?? ''}}
                                                            -{{$businessDetail->ward_no ?? ''}}
                                                            , {{$businessDetail->tole ?? ''}}
                                                            , {{$businessDetail->District->district ?? ''}}
                                                            , {{$businessDetail->Province->province ?? ''}}
                                                        </td>
                                                    </tr>


                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach($businessDetail->partners as $partner)
                                    <div class="col-md-6">
                                        <div class="card mt-3">
                                            <div class="card-header">
                                                <h4 class="header-title">
                                                    {{$partner->name}} को विवरण
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-sm mb-0 table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>फोटो</th>
                                                            <td><img src="{{$partner->photo}}" height="60"
                                                                     class="rounded-circle"
                                                                     alt="{{$partner->name}}"></td>
                                                        </tr>
                                                        <tr>
                                                            <th>नागरिकता नं</th>
                                                            <td>{{$partner->citizenship_no}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>जारी मिति</th>
                                                            <td>{{$partner->issue_date}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>जारी जिल्ला</th>
                                                            <td>{{$partner->issueDistrict->district??''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>फोन</th>
                                                            <td>{{$partner->phone}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>ईमेल</th>
                                                            <td>{{$partner->email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>घर नं</th>
                                                            <td>{{$partner->house_no}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>व्यक्तिगत स्थाई लेखा नम्बर</th>
                                                            <td>{{$partner->account_no}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>राष्ट्रियता परिचयपत्र नम्बर</th>
                                                            <td>{{$partner->national_card_no}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>लिङ्ग</th>
                                                            <td>{{$partner->gender?->label()??''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>शैक्षिक योग्यता</th>
                                                            <td>{{$partner->education_qualification?->label()??''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>मुख्य पेशा</th>
                                                            <td>{{$partner->occupation}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>बुवाको नाम</th>
                                                            <td>{{$partner->father_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>हजुरबुवाको नाम</th>
                                                            <td>{{$partner->grandfather_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>ठेगाना</th>
                                                            <td>
                                                                {{$partner->localBody->local_body ?? ''}}
                                                                -{{$partner->ward_no ?? ''}}
                                                                , {{$partner->tole ?? ''}}
                                                                , {{$partner->district->district ?? ''}}

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>नागरिकता (आगाडी)</th>
                                                            <td>
                                                                <a href="{{$partner->citizenship_front}}"><i
                                                                        class="fa fa-download"></i> </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>नागरिकता (पछाडी)</th>
                                                            <td>
                                                                <a href="{{$partner->citizenship_back}}"><i
                                                                        class="fa fa-download"></i> </a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th> हस्ताक्षर</th>
                                                            <td>
                                                                <a href="{{$partner->signature}}"><i
                                                                        class="fa fa-download"></i> </a>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if($businessDetail->is_rent==1)
                                    <div class="col-md-6">
                                        <div class="card mt-3">
                                            <div class="card-header">
                                                <h4 class="header-title">
                                                    बहालमा
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-sm mb-0 table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <td> घर धनिको नाम थर</td>
                                                            <td>{{$businessDetail->house_owner_name??''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> घर धनिको मोबाइल नं</td>
                                                            <td>{{$businessDetail->house_owner_phone??''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> ठेगाना</td>
                                                            <td>{{$businessDetail->house_owner_address??''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> मासिक भाडा रु</td>
                                                            <td>{{$businessDetail->house_owner_monthly_rent??''}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> भाडा सम्झौता </td>
                                                            <td>
                                                                <a href="{{$businessDetail->rent_agreement??''}}"><i
                                                                        class="fa fa-download"></i> </a>
                                                            </td>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($businessDetail->registeredBusinesses->count() > 0)
                                    <div class="col-md-6">
                                        <div class="card mt-3">
                                            <div class="card-header">
                                                <h4 class="header-title">
                                                    यो भन्दा अगाडी गरेको व्यवसाय दर्ता
                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-sm mb-0 table-striped table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>दर्ता नम्बर</th>
                                                            <th>व्यवसायको नाम</th>
                                                            <th>दर्ता मिति</th>
                                                            <th>सक्रिय</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($businessDetail->registeredBusinesses as $registeredBusinesses)
                                                            <tr>
                                                                <td>{{$registeredBusinesses->registration_no}}</td>
                                                                <td>{{$registeredBusinesses->business_name}}</td>
                                                                <td>{{$registeredBusinesses->registration_date}}</td>
                                                                <td>{{$registeredBusinesses->is_active==1 ? 'छ':'छैन'}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="card mt-3">
                                        <div class="card-header">
                                            <h4 class="header-title">
                                                परिचय पार्टीको साइज
                                            </h4>

                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-sm mb-0 table-striped table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th> लम्बाई</th>
                                                        <td>{{$businessDetail->length??''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> चौडाई</th>
                                                        <td>{{$businessDetail->width??''}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th> वर्गफिट</th>
                                                        <td>({{$businessDetail->length??'' }} * {{ $businessDetail->width??''}}) Sq.ft</td>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-around">
                                            <p>आफ्नै घर जग्गा भए जग्गा धनि प्रमाणपत्र </p>
                                            <a href="{{route('admin.file-url-download', ['file_url'=>$businessDetail->getRawOriginal('land_ownership_certificate')])}}"
                                               class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <img src="{{$businessDetail->land_ownership_certificate??''}}"
                                                 alt=""
                                                 style="max-width: 100%;height: 200px;object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-around">
                                            <p> वार्ड सिफारिस </p>
                                            <a href="{{route('admin.file-url-download', ['file_url'=>$businessDetail->getRawOriginal('ward_recommendation')])}}"
                                               class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <img
                                                src="{{$businessDetail->ward_recommendation??''}}"
                                                alt=""
                                                style="max-width: 100%;height: 200px;object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-around">
                                            <p> राजदूतावासको कागजात </p>
                                            <a href="{{route('admin.file-url-download', ['file_url'=>$businessDetail->getRawOriginal('embassy_document')])}}"
                                               class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <img
                                                src="{{$businessDetail->embassy_document??''}}"
                                                alt=""
                                                style="max-width: 100%;height: 200px;object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-around">
                                            <p> दर्ता प्रमाणपत्र </p>
                                            <a href="{{route('admin.file-url-download', ['file_url'=>$businessDetail->getRawOriginal('registration_document')])}}"
                                               class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <img
                                                src="{{$businessDetail->registration_document??''}}"
                                                alt=""
                                                style="max-width: 100%;height: 200px;object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-around">
                                            <p> इजाजत पत्र </p>
                                            <a href="{{route('admin.file-url-download', ['file_url'=>$businessDetail->getRawOriginal('license')])}}"
                                               class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <img
                                                src="{{$businessDetail->license??''}}"
                                                alt=""
                                                style="max-width: 100%;height: 200px;object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-around">
                                            <p> कर तिरेको प्रमाणपत्र </p>
                                            <a href="{{route('admin.file-url-download', ['file_url'=>$businessDetail->getRawOriginal('tax_document')])}}"
                                               class="btn btn-xs btn-outline-primary">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <img src="{{$businessDetail->tax_document??''}}"
                                                 alt=""
                                                 style="max-width: 100%;height: 200px;object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                                @foreach($businessDetail->files as $file)
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-around">
                                                <p>अन्य </p>
                                                <a href="{{route('admin.file-url-download', ['file_url'=>$file->getRawOriginal('file')])}}"
                                                   class="btn btn-xs btn-outline-primary">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <img src="{{$file->file_url??''}}"
                                                     alt=""
                                                     style="max-width: 100%;height: 200px;object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane" id="reg">
                                <form action="{{route('admin.businessRegistration.store.custom',$businessDetail)}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <fieldset class="border p-2 mb-2">
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <label for="taxpayer_number" class="form-label">करदाता नम्बर </label>
                                                <input
                                                    type="text"
                                                    name="taxpayer_number"

                                                    placeholder="करदाता नम्बर "
                                                    value="{{old('taxpayer_number',$businessDetail->taxpayer_number??'')}}"
                                                    class="form-control @error('taxpayer_number') is-invalid @enderror"
                                                    id="taxpayer_number"
                                                />
                                                @error('taxpayer_number')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="bill_no" class="form-label">बिल नं</label>
                                                <input
                                                    type="text"
                                                    name="bill_no"
                                                    value="{{old('bill_no',$businessDetail->bill_no??'')}}"
                                                    placeholder="बिल नं"
                                                    class="form-control @error('bill_no') is-invalid @enderror"
                                                    id="bill_no"
                                                />
                                                @error('bill_no')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <x-date-input-component
                                                    get-today-date="{{false}}"
                                                    edit-date-ne="{{$businessDetail->bill_date_bs}}"
                                                    edit-date-en="{{$businessDetail->bill_date_ad}}"
                                                    name-ne="bill_date_bs" label-ne="बिल मिति (बि स.)"
                                                    name-en="bill_date_ad" label-en="बिल मिति"
                                                />
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label for="amount" class="form-label">रकम </label>
                                                <input
                                                    type="number"
                                                    name="amount"
                                                    step="0.01"
                                                    placeholder="रकम"
                                                    value="{{old('amount',$businessDetail->amount??'')}}"
                                                    class="form-control @error('amount') is-invalid @enderror"
                                                    id="amount"
                                                />
                                                @error('amount')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            @if(!empty($businessDetail->other_file))
                                                <a href="{{$businessDetail->other_file}}" download="{{$businessDetail->other_file}}">
                                                    <i class="fa fa-download"></i> Download
                                                </a>
                                            @endif
                                            <div class="col-md-12 mb-2">
                                                <label for="other_file" class="form-label"> फाईल </label>
                                                <input
                                                    type="file"
                                                    name="other_file"
                                                    class="form-control @error('other_file') is-invalid @enderror"
                                                    id="other_file"
                                                />
                                                @error('other_file')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </fieldset>
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </form>
                        </div>

                        {{--                        <div class="tab-pane" id="tax">--}}
                        {{--                            <div class="d-flex justify-content-end mb-2">--}}
                        {{--                                @can('businessRegistration_edit')--}}
                        {{--                                    <a class="btn btn-primary btn-sm"--}}
                        {{--                                       href="{{route('admin.businessRegistration.edit.template',[$businessDetail,\Modules\BusinessRegistration\Enums\TemplateTypeEnum::REGISTRATION_BOOK])}}">--}}
                        {{--                                        <i class="fa fa-pen"></i>--}}
                        {{--                                    </a>--}}
                        {{--                                @endcan--}}
                        {{--                                @can('businessRegistrationPrint_access')--}}
                        {{--                                    <button class="btn btn btn-info mx-1" onclick="print('print3')"><i--}}
                        {{--                                            class="fa fa-print"></i>--}}
                        {{--                                    </button>--}}
                        {{--                                @endcan--}}
                        {{--                            </div>--}}
                        {{--                            <div class="font-black ckEditor" id="print3">--}}
                        {{--                                {!! $printed_data->where('for', \Modules\BusinessRegistration\Enums\TemplateTypeEnum::REGISTRATION_BOOK)->first()->data--}}
                        {{--                                   ?? $businessDetail->getSpecificTemplateData(\Modules\BusinessRegistration\Enums\TemplateTypeEnum::REGISTRATION_BOOK)--}}
                        {{--                                   ?? ''!!}--}}

                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="tab-pane" id="application">--}}
                        {{--                            <div class="d-flex justify-content-end mb-2">--}}
                        {{--                                @can('businessRegistration_edit')--}}
                        {{--                                    <a class="btn btn-primary btn-sm"--}}
                        {{--                                       href="{{route('admin.businessRegistration.edit.template',[$businessDetail,\Modules\BusinessRegistration\Enums\TemplateTypeEnum::CERTIFICATE])}}">--}}
                        {{--                                        <i class="fa fa-pen"></i>--}}
                        {{--                                    </a>--}}
                        {{--                                @endcan--}}
                        {{--                                @can('businessRegistrationPrint_access')--}}
                        {{--                                    <button class="btn btn btn-info mx-1" onclick="print('print4')"><i--}}
                        {{--                                            class="fa fa-print"></i>--}}
                        {{--                                    </button>--}}
                        {{--                                @endcan--}}
                        {{--                            </div>--}}
                        {{--                            <div class="font-black ckEditor" id="print4">--}}
                        {{--                                {!! $printed_data->where('for', \Modules\BusinessRegistration\Enums\TemplateTypeEnum::CERTIFICATE)->first()->data--}}
                        {{--                                                            ?? $businessDetail->getSpecificTemplateData(\Modules\BusinessRegistration\Enums\TemplateTypeEnum::CERTIFICATE)--}}
                        {{--                                                            ?? ''!!}--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
        <script src="{{asset('assets/backend/editor/ckEditor/js/ckeditor.js')}}"></script>
        <script src="{{asset('assets/backend/editor/ckEditor/js/print.js')}}"></script>


        <script>
            function print(editorName) {
                const editor = CKEDITOR.instances[editorName];
                editor.execCommand('print');
            }
        </script>
    @endpush

@endsection
