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
            <h3> {{\Modules\EMap\Enums\NoticeTypeEnum::PERMISSION->label()}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <x-application-component
                        :application-type="\Modules\EMap\Enums\NoticeTypeEnum::PERMISSION"
                        url="{{route('emap.admin.map.map-apply.notice.upload.permission',$mapApply)}}"/>
                </div>
                <div class="btn-group mb-3">
                    <button class="bg-success text-white" onclick=" printJS({
                printable: 'printData',
                type: 'html',
                documentTitle: 'मन्जुरीनामा',
                showModal: true,
                css: '{{asset('assets/backend/css/print.css')}}',
                honorMarginPadding: false,
                modalMessage: 'तपाईंको कागजात छाप्नको लागि तयार हुँदैछ।'})"><i class="fa fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <h3 style="text-align:center"><span style="font-size:22px"><strong>मन्जुरीनामा</strong></span></h3>

    <div class="vertical" style="color:black; margin-bottom:0; margin-left:15px; margin-right:15px; margin-top:0; padding:0 150px; text-orientation:upright; transform-origin:left top 0; transform:rotate(90deg)"><strong><span style="font-size:16px">दस्तखत : .................................</span></strong></div>

    <div class="text" style="margin-left:80px; text-align:justify"><strong><span style="font-size:16px">लिखितम ...................................................... जिल्ला ...................................... उ.न.पा./गा.वि.स. वडा नं. ..................................... बस्ने वर्ष ....................... को आगे ...................................................मेरो/हाम्रो नाउँमा दर्ता भएको साविक ....................................... हाल .............................................. उ.न.पा. वडा नं. .......................... स्थित कि.नं. ........................................ क्षेत्रफल ....................................... भएको जग्गामा घरटहरा, पर्वत, बाटो बनाउनको लागि ................................ उ.न.पा. कार्यालयमा नक्सा संहितको दस्तखत दिई नक्सा पास तथा निर्माण इजाजत लिनका लागि&nbsp;............................................. उ.न.पा. वडा नं.&nbsp;.............. बस्ने वर्ष ...............को श्री&nbsp;......................................................... ले मन्जुरीनामा लेखिदिनु भनी मलाई भन्दा मेरो चित्त बुझ्यो | उक्त जग्गामा घर, टहरा, पर्खाल, बाटो निर्माण गरेमा मेरो मन्जुरी छ | पछि उक्त मेरो नाउँको जग्गामा बनाउन पाउने होइन भनी कुनै कुराको उजुरी गर्ने छैन | गरे यसै कागजबाट बदर गरिदिनु भनी मेरो मनोमान खुशीराजीसँग&nbsp;........................................................... बनाउन मन्जुरीनामाको कागज लेखिदिएँ साक्षी किनारको सदर |<br />
इति सम्वत् साल महिना गते रोज शुभम</span></strong></div>

    <div class="flex-container" style="display:flex; margin-bottom:50px; margin-left:0; margin-right:0; margin-top:20px">
        <div class="auto item" style="flex:1 1 auto; margin-bottom:30px; margin-left:80px; margin-right:0; margin-top:30px; text-align:justify"><strong><span style="font-size:16px">दस्तखत: ............................</span></strong></div>

        <div class="initial item my-4" style="border:1px solid black; flex:initial; height:7rem; margin-bottom:1em; margin-left:80px; margin-right:1em; margin-top:1em; text-align:center; width:6rem"><strong><span style="font-size:16px">दायाँ</span></strong></div>

        <div class="initial item my-4" style="border:1px solid black; flex:initial; height:7rem; margin-bottom:1em; margin-left:80px; margin-right:1em; margin-top:1em; text-align:center; width:6rem"><strong><span style="font-size:16px">वायाँ</span></strong></div>
    </div>

    <div class="person">
        <h5 style="margin-left:80px; text-align:justify"><strong><span style="font-size:16px">सक्षीहरु</span></strong></h5>

        <p style="margin-left:80px; text-align:justify"><strong><span style="font-size:16px">१. श्री ..................................................... दरखास्त ................................................</span></strong></p>

        <p style="margin-left:80px; text-align:justify"><strong><span style="font-size:16px">२. श्री ....................................................&nbsp; दरखास्त ............................................</span></strong>....</p>
    </div>


    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush

@endsection
