<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($services as $key=>$service)
            <div class="carousel-item {{$key==0 ? 'active':''}}">
                <div class="section-header">
                    <h3 class="section-title text-info">सेवाहरु</h3>
                </div>
                <div class="d-flex bg-info align-items-center gap-2 rounded">
                        <img class="p-2 rounded bg-main" src="{{ asset('assets/frontend/image/help-desk1.png') }}" width="40" height="40"/>
                        <h4 class="text-white pt-1">{{$service->service_name}}</h4>
                </div>
                <div class="scroll">
                    <div class="doc pt-2">
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-clock fa-xl title"></i>
                            <div class="title">
                                अनुमति लग्ने समय <h6 class="mt-1">{{$service->time_taken}}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-user fa-xl title"></i>
                            <div class="title">
                                जिम्मेवार अधिकारी <h6 class="mt-1">{{$service->responsible_officer}}</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex gap-3 align-items-center">
                            <i class="fa fa-file-contract fa-xl title"></i>
                            <div class="title">
                                आवश्यक कागजातहरु
                                @foreach($service->serviceDocuments as $document)
                                <h6 class="mt-1"> {{$loop->iteration}}. {{$document->description}} {{ !$loop->last ? ',':''}}</h6>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
{{--    <style>--}}
{{--        .doc {--}}
{{--            top: 45vh;--}}
{{--            position: relative;--}}
{{--            box-sizing: border-box;--}}
{{--            animation: marquee 50s linear infinite;--}}
{{--            margin: 0 auto;--}}
{{--            text-align: left !important;--}}
{{--            color: var(--mainColor);--}}
{{--        }--}}

{{--        .scroll {--}}
{{--            border-radius: 5px;--}}
{{--            width: 100%;--}}
{{--            height: 38vh;--}}

{{--            overflow: hidden;--}}
{{--            position: relative;--}}
{{--            box-sizing: border-box;--}}
{{--        }--}}
{{--        }--}}
{{--    </style>--}}
@endpush

