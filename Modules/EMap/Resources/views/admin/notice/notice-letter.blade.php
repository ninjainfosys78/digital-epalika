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
            <h3> {{\Modules\EMap\Enums\NoticeTypeEnum::FIFTEEN_DAYS_NOTICE_ADJOURNED->label()}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                </div>
                <div class="btn-group mb-3">
                    <x-print-button title="१५ दिने सूचना टास सम्बन्धमा"/>
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
                                पत्र सं:
                                <div class="underline-dotted custom-width"></div>
                                <br>
                                चलानी नं:
                                <div class="underline-dotted custom-width"></div>
                            </div>
                            <div class="col-md-6 text-end">मिति:
                                <div class="underline-dotted custom-width"></div>
                            </div>
                        </div>

                        <div class="res my-4">
                            <p>श्री वडा समितिको कार्यालय <br>
                                {{config('applicationDetail.to_office.office_name')}} <br>
                                वडा नं:<span class="underline-dotted custom-width"></span></p>
                        </div>
                        <p class="text-center my-3"><b>बिषय:- १५ दिने सूचना टास सम्बन्धमा
                                ।</b></p>
                        <p class="mb-3">
                            &emsp;&emsp;&emsp;यस {{config('applicationDetail.to_office.office_name')}} वडा नं. <span
                                class="underline-dotted">{{$mapApply->landDetail->ward_no ?? ''}}</span> बस्ने
                            श्री <span class="underline-dotted">{{$mapApply->houseOwner->name ?? ''}}</span> ले ऐ. वडा
                            नं.<span
                                class="underline-dotted">{{$mapApply->landDetail->ward_no ?? ''}}</span> साविक <span
                                class="underline-dotted">{{$mapApply->landDetail->former_ward_no ?? ''}}</span>
                            कि.नं.<span class="underline-dotted">{{$mapApply->landDetail->plot_no ?? ''}}</span> मा भवन
                            बनाउन नक्सा पास
                            स्वीकृतिका लागि दरखास्त पर्न आएकोले सो सम्बन्धी प्रकाशित १५ दिने सूचना यसै साथ
                            संलग्न सूचना त्यस वडा समितिको कार्यालय र घर निर्माण स्थल<span
                                class="underline-dotted custom-width"></span> मा टास गरी सो को टास मुचुल्का
                            पठाईदिनुहुन अनुरोध छ |
                        </p>

                        <div class="d-flex justify-content-end mt-5"><span
                                class="underline-dotted custom-width"></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
