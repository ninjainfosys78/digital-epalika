@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.listRegistrations.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.listRegistrations.listRegistration.index') }}">सुची दर्ता
                                प्रणालि</a>
                        </li>
                        <li class="breadcrumb-item active">मौजुदा सुची दर्ता</li>
                    </ol>
                </div>
                <h4 class="page-title">मौजुदा सुची दर्ता</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="header-title">मौजुदा सुची दर्ताहरु</h4>
                    <a href="{{ route('admin.listRegistrations.listRegistration.index') }}"
                       class="btn btn-sm btn-outline-primary">
                        <i class="fa fa-list"></i> मौजुदा सूची
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0 table-striped table-hover table-bordered">

                                    <tbody>
                                    <tr>
                                        <th>दर्ता न.</th>
                                        <td>{{ $listRegistration->registration_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>प्रकार</th>
                                        <td>{{ $listRegistration->applicant_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>नाम.</th>
                                        <td>{{ $listRegistration->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>ठेगाना.</th>
                                        <td>{{ $listRegistration->address }}</td>
                                    </tr>
                                    <tr>
                                        <th>पत्राचार गर्ने ठेगाना.</th>
                                        <td>{{ $listRegistration->mailing_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>मुख्य व्यक्तिको नाम.</th>
                                        <td>{{ $listRegistration->main_person }}</td>
                                    </tr>
                                    <tr>
                                        <th>टेलिफोन नम्बर.</th>
                                        <td>{{ $listRegistration->telephone }}</td>
                                    </tr>
                                    <tr>
                                        <th>मोबाइल नम्बर</th>
                                        <td>{{ $listRegistration->mobile_no }}</td>
                                    </tr>
                                    <tr>
                                        <th>मिति</th>
                                        <td>
                                            {{ $listRegistration->date }}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">आवश्यक कागजातहरु</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-md-row flex-sm-column mt-3 gap-2">
                        <div class="col mb-3 position-relative">
                            <img src="{{ $listRegistration->application_photo }}" class="img-fluid img-thumbnail"
                                 alt="">
                            <div class="position-absolute end-0 top-0 m-1">
                                <a href="{{ route('admin.file-url-download', ['file_url' => $listRegistration->getRawOriginal('application_photo')]) }}"
                                   class="btn btn-xs btn-outline-primary bg-primary">
                                    <i class="fa fa-download text-white"></i>
                                </a>
                            </div>
                            <div class="position-absolute bottom-0 w-100 p-2 bg-soft-secondary text-center">
                                <p class="fw-bold">निवेदक /अनुसूची</p>
                            </div>
                        </div>
                        <div class="col mb-3 position-relative">
                            <img src="{{ $listRegistration->registration_certificate }}" class="img-fluid img-thumbnail"
                                 alt="">
                            <div class="position-absolute end-0 top-0 m-1">
                                <a href="{{ route('admin.file-url-download', ['file_url' => $listRegistration->getRawOriginal('registration_certificate')]) }}"
                                   class="btn btn-xs btn-outline-primary bg-primary">
                                    <i class="fa fa-download text-white"></i>
                                </a>
                            </div>
                            <div class="position-absolute bottom-0 w-100 p-2 bg-soft-secondary text-center">
                                <p class="fw-bold">संस्था वा फार्म दर्ताको प्रमाण पत्र</p>
                            </div>
                        </div>
                        <div class="col mb-3 position-relative">
                            <img src="{{ $listRegistration->pan_photo }}" class="img-fluid img-thumbnail"
                                 alt="">
                            <div class="position-absolute end-0 top-0 m-1">
                                <a href="{{ route('admin.file-url-download', ['file_url' => $listRegistration->getRawOriginal('pan_photo')]) }}"
                                   class="btn btn-xs btn-outline-primary bg-primary">
                                    <i class="fa fa-download text-white"></i>
                                </a>
                            </div>
                            <div class="position-absolute bottom-0 w-100 p-2 bg-soft-secondary text-center">
                                <p class="fw-bold">स्थायी लेखा नम्बर(PAN)</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-md-row flex-sm-column mt-3 gap-2">
                        <div class="col-4 mb-3 position-relative">
                            <img src="{{ $listRegistration->tax_payment_certificate }}" class="img-fluid img-thumbnail"
                                 alt="">
                            <div class="position-absolute end-0 top-0 m-1">
                                <a href="{{ route('admin.file-url-download', ['file_url' => $listRegistration->getRawOriginal('tax_payment_certificate')]) }}"
                                   class="btn btn-xs btn-outline-primary bg-primary">
                                    <i class="fa fa-download text-white"></i>
                                </a>
                            </div>
                            <div class="position-absolute bottom-0 w-100 p-2 bg-soft-secondary text-center">
                                <p class="fw-bold">कर चुक्ता प्रमाण पत्र</p>
                            </div>
                        </div>
                        <div class="col-4 mb-3 position-relative">
                            <img src="{{ $listRegistration->license_photo }}" class="img-fluid img-thumbnail"
                                 alt="">
                            <div class="position-absolute end-0 top-0 m-1">
                                <a href="{{ route('admin.file-url-download', ['file_url' => $listRegistration->getRawOriginal('license_photo')]) }}"
                                   class="btn btn-xs btn-outline-primary bg-primary">
                                    <i class="fa fa-download text-white"></i>
                                </a>
                            </div>
                            <div class="position-absolute bottom-0 w-100 p-2 bg-soft-secondary text-center">
                                <p class="fw-bold">कुन खरिद को लागि सूची दर्ता हुन निबेदन दिने हो, सो को लागि इजाजत
                                    पत्र </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title mb-0">अन्य फाइलहरु</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($listRegistration->files as $document)
                            <div class="col-xl-4 col-lg-6">
                                <div class="card shadow-none border">
                                    <div class="p-2">
                                        <div class="row align-items-center">
                                            <div class="col-2 pe-0">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title bg-light text-secondary rounded">
                                                          <i class="fa {{getFileIconClass($document->extension)}} font-18"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <a href="javascript:void(0);"
                                                   onclick="openFileModal('{{$document->file_name}}', '{{ $document->extension }}', '{{ $document->file_url }}')"
                                                   class="text-muted fw-medium">{{$document->file_name}}
                                                    .{{$document->extension}}</a>
                                                <p class="mb-0 font-13">{{convert_to_highest_unit($document->file_size)}}</p>
                                            </div>
                                            <div class="col-2">
                                                <a href="{{route('admin.file.download', $document)}}"
                                                   class="btn btn-xs btn-outline-primary">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                        </div> <!-- end row -->
                                    </div> <!-- end .p-2-->
                                </div> <!-- end col -->
                            </div>
                        @empty
                            <p class="text-center">तालिकामा कुनै डाटा उपलब्ध छैन !!!</p>
                        @endforelse
                    </div> <!-- end row-->
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="header-title mb-0">मौजुदा सुची दर्ता</h4>
                    <x-print-button
                        target-element="print-data"
                        title="मौजुदा सुची दर्ता"
                    />
                </div>
                <div id="print-data">
                    <div class="card-body">
                        <p class="text-center">अनुसूची - २ क.</p>
                        <p class="text-center">(नियम १८ को उपनियम (१) सँग सम्बन्धित)</p>
                        <p class="text-center"> मौजुदा सूचीमा दर्ता हुनका लागी दिईने निवेदनको ढांच</p>
                        <div class="d-flex justify-content-between">
                            <p>
                                श्रीमान प्रमुख प्रशासकीय ज्यु, <br>
                                {{$officeSetting->localBody->local_body??''}} <br>
                                {{$officeSetting->district->district??''}} , {{$officeSetting->province->province??''}}
                                , नेपाल
                            </p>
                            <p>
                                मिति : {{$listRegistration->to_day_date}}
                            </p>
                        </div>
                        <h5 class="text-center">बिषय : मौजुदा सूचीमा दर्ता गरी पाऊँ  ।</h5>
                        <p>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;सार्वजनिक खरिद नियमावली , २०६४ को नियम १८ को उपनियम (१) बमोजिम तपसिलमा उल्लेखित विवरण
                            अनुसारको पुष्ट्याई गर्ने कागजात गरी मौजुदा सूचीमा दर्ता हुन योनिवेदन पेस गरेको छु ।
                        </p>
                        <h5 class="text-center mt-2 font-weight-bold">तपसिल</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td colspan="4"> १. मौजुदा सूचीको लागि निवेदन दिने व्यक्ति,सस्था,आपूर्तिकर्ता, निर्माण
                                    व्यवसायी, परामर्शदाता वा सेवा प्रदायकको विवरण
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">क. नाम : {{$listRegistration->name}}</td>
                                <td colspan="2">ख. ठेगाना : {{$listRegistration->address}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">ग. पत्रचार गर्ने ठेगाना : {{$listRegistration->mailing_address}}</td>
                                <td colspan="2">घ. मुख्य व्यक्तिको नाम : {{$listRegistration->main_person}}</td>
                            </tr>
                            <tr>
                                <td colspan="2">ङ. टेलिफोन नं: {{$listRegistration->telephone}}</td>
                                <td colspan="2">च. मोवाईल नं : {{$listRegistration->mobile_no}}</td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    २. मौजुदा सुचिमा दर्ता हुनेको लागि निम्नबमोजिमको प्रमाणपत्र संगलग्न गर्नुहोस । <br>
                                    क . संस्था वा फर्म दर्ताको प्रमाणपत्र
                                    । @if(!empty($listRegistration->registration_certificate)) छ <input type="checkbox" checked> @else छैन <input type="checkbox" checked> @endif<br>
                                    ख . नवीकरण गरिएको ।<br>
                                    ग . मूल्य अभिवृद्धि कर वा स्थायी लेखा नम्बर दर्ताको प्रमाण
                                    । @if(!empty($listRegistration->pan_photo)) छ <input type="checkbox" checked> @else छैन <input type="checkbox" checked> @endif<br>
                                    घ . कर चुक्ताको प्रमाणपत्र
                                    । @if(!empty($listRegistration->tax_payment_certificate)) छ <input type="checkbox" checked> @else छैन <input type="checkbox" checked> @endif<br>
                                    ङ . कुल खरिदको लागी मौजुदा सुचिमा दर्ता हुन् निवेदन दिने हो सो कामको लागी इजाजत्
                                    पत्र आवश्यक पर्ने भएमा सोको प्रतिलिपि
                                    । @if(!empty($listRegistration->license_photo)) छ <input type="checkbox" checked> @else छैन <input type="checkbox" checked> @endif<br>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4">
                                    ३. सार्वजनिक निकायबाट हुने खरिदको लागि दर्ता हुन चाहिको खरिदको प्रकृतिको विवरण :
                                </td>
                            </tr>
                            <tr>

                                <td>क. मालसमान आपूर्ति : (मालसमानको प्रकृति समेत उल्लेख गर्ने)</td>

                                <td>
                                    {{$listRegistration->business_nature->value =='goods_supply' ? $listRegistration->business_nature_description :''}}
                                </td>

                                <td>ख. निर्माण कार्य :</td>
                                <td>{{$listRegistration->business_nature->value =='construction_work' ? $listRegistration->business_nature_description :''}}</td>
                            </tr>
                            <tr>
                                <td>ग. परामर्श सेवा : (परामर्श सेवाको प्रकृति समेत उल्लेख गर्ने)</td>
                                <td>{{$listRegistration->business_nature->value =='consulting_service' ? $listRegistration->business_nature_description :''}}</td>
                                <td>घ. अन्य सेवा : (अन्य सेवाको प्रकृति उल्लेख गर्ने)</td>
                                <td>{{$listRegistration->business_nature->value =='other_service' ? $listRegistration->business_nature_description :''}}</td>
                            </tr>
                            <tr>
                                <td>निवेदन दिएको मिति : {{$listRegistration->date}}<br>
                                    आ. व. : {{$listRegistration->fiscalYear->title??''}}
                                </td>
                                <td colspan="2">
                                    फर्मको छाप :
                                </td>
                                <td>
                                    निवेदकको नाम : {{$listRegistration->main_person}}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.inc.file-view');
    </div>
@endsection
