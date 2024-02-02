@extends('frontend.layouts.master')
@section('content')
    <div class="container mt-3">
        <div class="breadcrumb d-flex">
            <div class="breadcrumb-item">
                <a class="whitespace-nowrap text-primary-500" href="{{route('welcome')}}">ई-पालिका</a>
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500">अनुदान</a>
                <i class="fa fa-angle-double-right text-light"></i>
                <a class="ml-1 text-primary-500">नयाँ दर्ता</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="notice_no">सूचना नं.</label>
                            <input type="text" class="form-control" id="notice_no" placeholder="सूचना नं.">
                        </div>
                        <div class="col-md-6">
                            <label for="application_name">आवेदन नाम</label>
                            <input type="text" class="form-control" id="application_name" placeholder="आवेदन नाम">
                        </div>
                    </div>
                    <h5 class="text-decoration-underline my-3">ठेगाना</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="province">प्रदेश</label>
                            <select id="province" class="form-control">
                                <option>--प्रदेश छानुहोस्--</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="district">जिल्ला</label>
                            <select id="district" class="form-control">
                                <option>--जिल्ला छानुहोस्--</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="local_body">पालिका</label>
                            <select id="local_body" class="form-control">
                                <option>--पालिका छानुहोस्--</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="ward_no">वडा नं</label>
                            <select id="ward_no" class="form-control">
                                <option>--वडा नं छानुहोस्--</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label for="person_code">आवेदकको कोड नं.</label>
                            <input type="text" class="form-control" id="person_code" placeholder="आवेदकको कोड नं.">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="grant_type">आवेदकको प्रकार</label>
                            <select id="grant_type" class="form-control">
                                <option>----आवेदकको प्रकार छानुहोस्----</option>
                                <option>सहकारी</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="grant_address">माग गरेको अनुदान क्षेत्र</label>
                            <input type="text" class="form-control" id="grant_address" placeholder="माग गरेको अनुदान क्षेत्र">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="main_demand">
                                माग गरेका मुख्य कृयाकलापहरु</label>
                            <input type="text" class="form-control" id="main_demand" placeholder="माग गरेका मुख्य कृयाकलापहरु">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="est_total_cost">जम्मा लागत अनुमान</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">रु</span>
                                </div>
                                <input type="text"  id="est_total_cost" class="form-control" placeholder="जम्मा लागत अनुमान">
                            </div>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="demand_grant_amount">माग अनुदान रकम</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">रु</span>
                                </div>
                                <input type="text"  id="demand_grant_amount" class="form-control" placeholder="माग अनुदान रकम">
                            </div>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="self_invest_amount">स्वलगानी रकम</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">रु</span>
                                </div>
                                <input type="text"  id="self_invest_amount" class="form-control" placeholder="स्वलगानी रकम">
                            </div>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="contact_person_name">
                                सम्पर्क ब्यक्तिको नाम</label>
                            <input type="text" class="form-control" id="contact_person_name" placeholder="सम्पर्क ब्यक्तिको नाम">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="contact_number">
                                सम्पर्क नम्बरहरु</label>
                            <input type="text" class="form-control" id="contact_number" placeholder="सम्पर्क नम्बरहरु">
                        </div>
                    </div>
                    <h5 class="text-decoration-underline mt-2">बैंक खाताको विवरण</h5>
                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <label for="account_holders_name">
                                खातावालहरुको नामु</label>
                            <input type="text" class="form-control" id="account_holders_name" placeholder="खातावालहरुको नाम">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="bank_account_no">
                                बैंक खाता नं.</label>
                            <input type="text" class="form-control" id="bank_account_no" placeholder="बैंक खाता नं.">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="bank_name">
                                बैंकको नाम</label>
                            <input type="text" class="form-control" id="bank_name" placeholder="बैंकको नाम">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="bank_address">
                                बैंकको ठेगाना</label>
                            <input type="text" class="form-control" id="bank_address" placeholder="बैंकको ठेगाना">
                        </div>
                    </div>
                    <h5 class="text-decoration-underline mt-2">पहिले अनुदान प्राप्त गरे नगरेको</h5>
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label for="grant_receive_before">पाएको नपाएको</label>
                            <select id="grant_receive_before" class="form-control">
                                <option>----पाएको नपाएको छानुहोस्----</option>
                                <option value="">नपाएको</option>
                                <option value="1">पाएको</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="grant_year">पाएको वर्ष</label>
                            <select id="grant_year" class="form-control">
                                <option>----पाएको वर्ष छानुहोस्----</option>
                                <option value="">078/079</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="grant_place">पाएको विषयगत क्षेत्र</label>
                            <select id="grant_place" class="form-control">
                                <option>---- पाएको विषयगत क्षेत्र छानुहोस्----</option>
                                <option value="">078/079</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="grant_office">
                                अनुदान दिने निकाय</label>
                            <input type="text" class="form-control" id="grant_office" placeholder="अनुदान दिने निकाय">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="grant_amount">अनुदान रकम</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">रु</span>
                                </div>
                                <input type="text"  id="grant_amount" class="form-control" placeholder="अनुदान रकम">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="beneficiary_families">
                                लाभान्वित परिवार</label>
                            <input type="text" class="form-control" id="beneficiary_families" placeholder="लाभान्वित परिवार">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="beneficial_area">
                                लाभ पुग्ने क्षेत्रफल</label>
                            <input type="text" class="form-control" id="beneficial_area" placeholder="लाभ पुग्ने क्षेत्रफल">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="exampleFormControlSelect2">सम्बधित पूर्बाधारहरु</label>
                            <select multiple class="form-control" id="exampleFormControlSelect2">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="remarks">कैफियत</label>
                                <textarea id="remarks" class="form-control" cols="30" rows="3" placeholder="कैफियत"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-2">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
