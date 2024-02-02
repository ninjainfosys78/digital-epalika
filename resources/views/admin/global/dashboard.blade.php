@extends('admin.layouts.master')
@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm {{officeSetting()->fiscal_year_id ? 'bg-success' : 'bg-danger'}} rounded-circle">
                                    <i class="fas {{officeSetting()->fiscal_year_id ? 'fa-check-circle' : 'fa-times-circle'}} avatar-title font-18 text-white"></i>
                                </div>
                                <p class="text-muted font-15 mb-0 mt-2">आर्थिक वर्ष सेटअप भयो?</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm {{get_office_header()->count() > 0 ? 'bg-success' : 'bg-danger'}} rounded-circle">
                                    <i class="fas {{get_office_header()->count() > 0 ? 'fa-check-circle' : 'fa-times-circle'}} avatar-title font-18 text-white"></i>
                                </div>
                                <p class="text-muted font-15 mb-0 mt-2">कार्यालय सेटअप भयो?</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm {{$sms_setup ? 'bg-success' : 'bg-danger'}} rounded-circle">
                                    <i class="fas {{$sms_setup ? 'fa-check-circle' : 'fa-times-circle'}} avatar-title font-18 text-white"></i>
                                </div>
                                <p class="text-muted font-15 mb-0 mt-2">एस.एम.एस सेटअप भयो?</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xl-3">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm {{$email_setup ? 'bg-success' : 'bg-danger'}} rounded-circle">
                                    <i class="fas {{$email_setup ? 'fa-check-circle' : 'fa-times-circle'}} avatar-title font-18 text-white"></i>
                                </div>
                                <p class="text-muted font-15 mb-0 mt-2">मेल सेटअप भयो?</p>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
@endsection
