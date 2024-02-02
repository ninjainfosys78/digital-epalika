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
    </div>`
    <div>
        @error('file')
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="row mb-2">
        <div class="col-sm-4">
            <h3> {{\Modules\EMap\Enums\NoticeTypeEnum::HOUSE_MAP_NAMSARI->label()}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::HOUSE_MAP_NAMSARI"
                        url="{{route('emap.admin.map.map-apply.notice.upload.order',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <x-print-button title="{{$mapApply->client->name}}घरनक्सा नामसारी सम्बन्धमा "/>
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
                            </div>
                            <div class="col-md-6 text-end">मिति: <div class="underline-dotted custom-width"></div></div>
                        </div>
                        <h3 class="text-center">
                            <b>टिप्पणी र आदेश </b>
                        </h3>
                        <p class="text-center"><b>विषय :- घरनक्सा नामसारी सम्बन्धमा |</b></p>
                        <span>श्रीमान,</span><br>
                        <span class="my-3">
                            यस {{config('applicationDetail.office_type')}} वडा नं.<span
                                class="underline-dotted">{{$mapApply->landDetail->ward_no??''}}</span>साविक<span
                                class="underline-dotted">{{$mapApply->landDetail->former_ward_no??''}}</span>
                            कि.नं.<span class="underline-dotted">{{$mapApply->landDetail->plot_no??''}}</span> ज.वि<span
                                class="underline-dotted custom-width"></span>
                            मा श्री<span class="underline-dotted">{{$mapApply->houseOwner->name??''}}</span> ले
                            मिति<span
                                class="underline-dotted custom-width"></span>
                            मा घर निर्माणको लागि लम्बाई <span
                                class="underline-dotted custom-width">{{$mapApply->length}}</span>
                            चौडाई<span class="underline-dotted custom-width">{{$mapApply->breadth}}</span>
                            उचाई<span class="underline-dotted custom-width">{{$mapApply->height}}</span> प्लिन्थ
                            क्षेत्रफल<span
                                class="underline-dotted custom-width">{{$mapApply->area_of_plinth}}</span>
                            रहेको घर नक्सा पास गरी लैजानु भएकोमा मिति<span
                                class="underline-dotted custom-width"></span> मा
                            जिल्ला {{config('applicationDetail.office_district')}}को मालपोत
                            कार्यालयको निर्णय
                            अनुसार रजिस्ट्रेसन/अंशवण्डा/नामसारी/कित्ता काट बाट श्री <span
                                class="underline-dotted custom-width">{{$mapApply->houseOwner->name??''}}</span> ले लिनु
                            भएको प्रमाण सहित घर
                            नक्सा नामसारीको लागि दरखास्त पर्न आएकोले यस कार्यालयबाट मिति<span
                                class="underline-dotted custom-width"></span> मा
                            श्री<span class="underline-dotted custom-width">{{$mapApply->landOwner->name??''}}</span> को
                            नाममा पास भै गएको घरनक्सा
                            श्री<span class="underline-dotted custom-width">{{$mapApply->houseOwner->name??''}}</span>
                            को नाममा आएको कागज प्रमाण बमोजिम हाल कायम रहन आएको कि.नं.<span
                                class="underline-dotted custom-width">{{$mapApply->landDetail->plot_no??''}}</span>
                            जग्गा क्षेत्रफल<span
                                class="underline-dotted custom-width">{{$mapApply->landDetail->unit_value??''}} {{$mapApply->landDetail->unit->title??''}}</span>
                            रहने गरी नक्सा
                            नामसारीको लागि मनासिब देखि पेश गरेको छु |
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
