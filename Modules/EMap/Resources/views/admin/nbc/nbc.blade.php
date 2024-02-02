@extends('emap::organization.layouts.master')

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
                        <li class="breadcrumb-item active">भवन डिजाईन</li>
                    </ol>
                </div>
                <h4 class="page-title mt-2">भवन डिजाईन</h4>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-4">
            <h3></h3>
        </div>
        <div class="col-sm-8">
            <div class="text-sm-end">
                <div class="btn-group mb-3">
                    <button class="bg-success text-white" onclick=" printJS({
                printable: 'printData',
                type: 'html',
                documentTitle: 'ufjgjufgjh',
                showModal: true,
                css: '{{asset('assets/backend/css/print.css')}}',
                honorMarginPadding: false,
                modalMessage: 'तपाईंको कागजात छाप्नको लागि तयार हुँदैछ।'})"><i class="fa fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div><!-- end col-->
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card mb_30">
                <div class="card-body p-3">
                    <div class="font-black" id="printData">
                        <p class="fw-bold text-center">भवन डिजाईनको विवरण</p>
                        <p class="fw-bold text-center">(क) आर्किटेक्चरल डिजाइन सम्बन्धी (NBCCode 206:2003)</p>
                        <p class="text-center">(सम्बन्धित प्राविधिक र परामर्शदाताले भर्नुपर्ने)</p>
                        <span>House Owner Name :<span class="underline-dotted custom-width"></span><span
                                class="underline-dotted custom-width"></span></span><br>
                        <span>Note : If some section are not applicable write NA in the remarks</span>
                        <table class="table-xs table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">Building Element</th>
                                <th scope="col">At per Submitted Design</th>
                                <th scope="col">Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="fw-bold">1.0 Staircase</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.1 Min tread width of staircase excluding nosing</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.2 Riser height of staircase</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.3 Clear width of staircase</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.4 Height of Handrail</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.5 Max. no of riser in one single flight</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.6 Min. head room under staircase from the nosing of the tread</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>


                            <tr>
                                <td class="fw-bold">2.0 Exit</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2.1 Max travel distance to exit point in each floor</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2.2 Min. width of exit door including frame</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2.2 Min. height of exit door including frame</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2.3 Shutter opening of exit door to staircase & public passage</td>
                                <td class="text-end">Inside/Outside</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2.4 Total width of exit door</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="fw-bold">3.0 Light and Ventilation</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3.1 Min. opening area of window for lighting largest habitable room from external
                                    wall
                                </td>
                                <td class="text-end">sq.m.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3.2 Min. opening area of natural ventilator for lighting largest habitable room from external wall
                                </td>
                                <td class="text-end">sq.m.</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3.3 Min. size of ventilator for water closets and bathroom</td>
                                <td class="text-end">sq.m.</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="fw-bold">4.0 lift</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4.1 Total height of building</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4.2 Provision of lift</td>
                                <td class="text-end">Yes/No</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4.3 No.of lift per unit</td>
                                <td class="text-end">Nos.</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="fw-bold">5.0 Requirement for the physical disabled in public building</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5.1 Is there a provision of separate entrance for disabled people next to the primary entrance of a building
                                </td>
                                <td class="text-end">Yes/No</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5.2 Max. gradient for wheel chair ramp at entrance of building</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5.3 Min. width of wheel chair ramp at entrance of building</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td class="fw-bold">6.0 Parapet heights</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6.1 The height of parapet wall & balcony handrail</td>
                                <td class="text-end">mm</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="text-end pt-5">
                                <span>नक्सा बनाउने प्राबिधिकको सही : <span class="underline-dotted"></span>
                                    <span class="underline-dotted"></span></span>
                        </div>
                        <div class="page-break">
                            <p class="fw-bold text-center">(ख) स्ट्रक्चरल डिजाईन सम्बन्धी विवरण फाराम</p>
                            <p class="text-center">(सम्बन्धित प्राविधिक र परामर्शदाताले भर्नुपर्ने)</p>
                            <span>House Owner Name :<span class="underline-dotted custom-width"></span><span
                                    class="underline-dotted custom-width"></span></span><br>
                            <span>Note : If some section are not applicable write NA in the remarks</span>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">A</th>
                                    <th colspan="4">General Information</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="text-center">A.1</th>
                                    <td><span class="fw-bold">Types of Occupancy</span><br>
                                        &emsp;<input class="form-check-input form-check-inline" type="checkbox"
                                                     name="inlineRadioOptions" id="inlineRadio1"
                                                     value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Residential</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio2"
                                               value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Apartment</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio3"
                                               value="option3">
                                        <label class="form-check-label" for="inlineRadio3">Hospital</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio4"
                                               value="option4">
                                        <label class="form-check-label" for="inlineRadio4">Industrial</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio5"
                                               value="option5">
                                        <label class="form-check-label"
                                               for="inlineRadio5">
                                            Educational</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio6"
                                               value="option6">
                                        <label class="form-check-label" for="inlineRadio6">Cinema</label>&emsp;<br>

                                        &emsp;<input class="form-check-input form-check-inline" type="checkbox"
                                                     name="inlineRadioOptions" id="inlineRadio7"
                                                     value="option7">
                                        <label class="form-check-label" for="inlineRadio7">Auditorium above 500</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio8"
                                               value="option8">
                                        <label class="form-check-label" for="inlineRadio8">Auditorium below 500</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio9"
                                               value="option9">
                                        <label class="form-check-label" for="inlineRadio9">Public Assembly</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio10"
                                               value="option10">
                                        <label class="form-check-label" for="inlineRadio10">Commercial</label>&emsp;<br>

                                        &emsp;<input class="form-check-input form-check-inline" type="checkbox"
                                                     name="inlineRadioOptions" id="inlineRadio11"
                                                     value="option11">
                                        <label class="form-check-label" for="inlineRadio11">Cold Storage and Ware
                                            House</label>&emsp;<br>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">A.2</th>
                                    <td><span class="fw-bold">Building Category :</span>
                                        &emsp;<input class="form-check-input form-check-inline" type="checkbox"
                                                     name="inlineRadioOptions" id="inlineRadio1"
                                                     value="option1">
                                        <label class="form-check-label" for="inlineRadio1">A</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio2"
                                               value="option2">
                                        <label class="form-check-label" for="inlineRadio2">B</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio3"
                                               value="option3">
                                        <label class="form-check-label" for="inlineRadio3">C</label>&emsp;

                                        <input class="form-check-input form-check-inline" type="checkbox"
                                               name="inlineRadioOptions" id="inlineRadio4"
                                               value="option4">
                                        <label class="form-check-label" for="inlineRadio4">D</label>&emsp;
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">A.3</th>
                                    <th rowspan="1">Designed By</th>
                                    <th width="600" rowspan="3">Name</th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('style')
        <style>
            .font-black p {
                color: black;
            }

            .underline-dotted {
                border-bottom: dotted 2px !important;
                padding: 0 20px;
            }

            .custom-width {
                padding: 0 80px !important;
            }

            .table-xs td, .table-xs th {
                padding: 0 !important;
            }

            .table-xs > :not(caption) > * > * {
                padding: 4px !important;
                background-color: var(--bs-table-bg);
                border-bottom-width: 1px;
                box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
            }


        </style>
    @endpush
    @push('scripts')
        <script src="{{asset('assets/backend/js/printAjaxScript.js')}}"></script>
    @endpush
@endsection

