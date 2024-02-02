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
                            <a href="{{route('admin.circular.registration.index')}}">ई-नक्सा </a>
                        </li>
                        <li class="breadcrumb-item active">नक्सा विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">ई-नक्सा</h4>
            </div>
        </div>
    </div>
    <div>
        @error('file')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="row mb-2">
        <div class="col-sm-4">
            <h3> {{\Modules\EMap\Enums\NoticeTypeEnum::REGARDING_SENDING_DETAILS->label()}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::REGARDING_SENDING_DETAILS"
                        url="{{route('emap.admin.map.map-apply.notice.upload.notice',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <x-print-button title="{{$mapApply->client->name}}विवरण पठाएको सम्बन्धमा"/>
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb_30">
                <div class="card-body p-3">
                    <div class="font-black" id="printData">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                पत्र सं: <div class="underline-dotted custom-width"></div><br>
                                चलानी नं: <div class="underline-dotted custom-width"></div>
                            </div>
                            <div class="col-md-6 text-end">मिति: <div class="underline-dotted custom-width"></div></div>
                        </div>
                        <p>श्री राजस्व शाखा<br>
                            {{config('applicationDetail.to_office.office_name')}} कार्यालय
                        </p>
                        <h5 class="text-center my-1"><b>विषय :- विवरण पठाएको सम्बन्धमा ।</b></h5>
                        <p>
                            &emsp;&emsp;&emsp;उपर्युक्त सम्बन्धमा {{config('applicationDetail.to_office.office_name')}} वडा
                            नं.<span class="underline-dotted">{{$mapApply->houseOwner->ward_no??''}}</span> बस्ने
                            श्री/श्रीमती<span
                                class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span> लाई मिति<span
                                class="underline-dotted custom-width"></span> मा स्वीकृत दिएको नयाँ
                            घर/थपघर/थपतला निर्माण/नामसारी भएको हुँदा तपसिलमा उलेखित विवरण अनुसार रेकर्ड मिलान
                            गर्नु हुन अनुरोध छ ।
                        </p>
                        <div class="detail">वडा नं.<span class="underline-dotted">{{$mapApply->landDetail->ward_no??''}}</span> घर
                            नं.<span
                                class="underline-dotted custom-width"></span> सडकको नाम<span
                                class="underline-dotted">{{$mapApply->landDetail->street_code_no??''}}</span> टोलको
                            नाम<span
                                class="underline-dotted custom-width">{{$mapApply->landDetail->tole??''}}</span></div>
                        <table class="table table-sm table-bordered my-2 text-center">
                            <thead>
                            <tr>
                                <th scope="col">घर सि.नं.</th>
                                <th scope="col">तला नं.</th>
                                <th scope="col">लम्बाई</th>
                                <th scope="col">चौडाई</th>
                                <th scope="col">उचाई</th>
                                <th scope="col">क्षेत्रफल</th>
                                <th scope="col">घरको किसिम</th>
                                <th scope="col">निर्माण भएको</th>
                                <th scope="col">बाँकि</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mapApply->storeyDetails as $storeDetail)
                                <tr>
                                    <td></td>
                                    <td>{{$storeDetail->mapFee->storey??''}}</td>
                                    <td>{{$mapApply->length}}</td>
                                    <td>{{$mapApply->breadth}}</td>
                                    <td>{{$storeDetail->height}}</td>
                                    <td>{{$storeDetail->total_area}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <div><b>जग्गाको विवरण :</b></div>
                        <table class="table table-sm table-bordered mb-1 text-center">
                            <thead>
                            <tr>
                                <th scope="col">ठेली/मोठ नं.</th>
                                <th scope="col">क्षेत्र</th>
                                <th scope="col">साविक वडा</th>
                                <th scope="col">हालको वडा</th>
                                <th scope="col">कि.नं.</th>
                                <th scope="col">क्षेत्रफल</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{$mapApply->landDetail->former_ward_no??''}}</td>
                                <td>{{$mapApply->landDetail->ward_no??''}}</td>
                                <td>{{$mapApply->landDetail->plot_no??''}}</td>
                                <td>{{$mapApply->landDetail->unit_value??''}} {{$mapApply->landDetail->unit->title??''}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <p><b>विषय : नाम सरि प्रयोजन</b></p>
                        <p class="mb-1">मिति<span class="underline-dotted custom-width"></span> को निर्णय बमोजिम
                            श्री/श्रीमती/सुश्री<span class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span>
                            को नामबाट श्री/श्रीमती/सुश्री<span
                                class="underline-dotted">{{$mapApply->landOwner->name??''}}</span> को
                            नाममा नामसारी भएको जानकारी गराईन्छ |</p>
                        <div class="detail"><b>जग्गाको विवरण :</b></div>
                        <table class="table table-sm table-bordered text-center">
                            <thead>
                            <tr>
                                <th scope="col">ठेली/मोठ नं.</th>
                                <th scope="col">क्षेत्र</th>
                                <th scope="col">साविक वडा</th>
                                <th scope="col">हालको वडा</th>
                                <th scope="col">कि.नं.</th>
                                <th scope="col">क्षेत्रफल</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{$mapApply->landDetail->former_ward_no??''}}</td>
                                <td>{{$mapApply->landDetail->ward_no??''}}</td>
                                <td>{{$mapApply->landDetail->plot_no??''}}</td>
                                <td>{{$mapApply->landDetail->unit_value??''}} {{$mapApply->landDetail->unit->title??''}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <p>कित्ता काट भई आएको भएमा :<br>
                            साविक कि.नं.<span class="underline-dotted custom-width"></span>
                            क्षेत्रफल<span class="underline-dotted custom-width"></span> हाल कायम कि.नं.<span
                                class="underline-dotted custom-width"></span>क्षेत्रफल<span
                                class="underline-dotted custom-width"></span></p>
                        <div class="d-flex justify-content-end my-5">
                            <p class="text-center"><span class="underline-dotted custom-width"></span><br>
                                नक्सापास शाखा </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
