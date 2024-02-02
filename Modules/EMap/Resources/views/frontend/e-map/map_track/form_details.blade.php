@extends('frontend.layouts.master')
@section('content')
    <section class="inner-section mt-lg-5 ">
        <div class="container">
            <div class="row d-flex mt-5 ">
                <div class="breadcrumb d-flex">
                    <div class="breadcrumb-item">
                        <a class="whitespace-nowrap text-primary-500" href="{{url('e-map')}}">ई-नक्सा</a>
                        <i class="fa fa-angle-double-right text-white text-light"></i>
                        <a href="{{route('mapTrack')}}" class=" text-primary-500 text-center">नक्सा ट्रयाक</a>
                        <i class="fa fa-angle-double-right text-white text-light"></i>
                        <a class=" text-primary-500 text-center">नक्सा विवरण</a>
                    </div>
                </div>
                <h4 class="fw-semibold text-center">नक्सा विवरण</h4>
            </div>
            <div class="card-body p-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>क्र.स</th>
                        <th>निवेदन/प्रतिवेदन किसिम</th>
                        <th>स्थिति</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\Modules\EMap\Enums\NoticeTypeEnum::cases() as $noticeTypeEnum)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$noticeTypeEnum->label()}}</td>
                            <td class="text-center">
                                @if($mapApply->applyMapNotices->where('file_type',$noticeTypeEnum)->count() >0)
                                    <i class="fas fa-check"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($noticeTypeEnum->type() === \Modules\EMap\Enums\EMapFormFillerTypeEnum::OWNER)
                                   @if(!$mapApply->applyMapNotices->pluck('file_type')->unique()->contains($noticeTypeEnum))
                                    <a href="{{route('load-template-data',[$mapApply,$noticeTypeEnum])}}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus"></i>
                                        <span>फार्म भर्नुहोस्</span>
                                    </a>
                                    @else
                                        <a href="{{route('load-template-data',[$mapApply,$noticeTypeEnum])}}"
                                           class="btn btn-info text-white btn-sm">
                                            <i class="fa fa-pen"></i>
                                            <span>फार्म सम्पादन गर्नुहोस</span>
                                        </a>
                                    @endif

                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

