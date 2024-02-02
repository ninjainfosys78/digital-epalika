@extends('frontend.layouts.master')
@section('content')
    <section class="inner-section">
        <div class="breadcrumb d-flex pt-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="breadcrumb-item">
                            <a class="whitespace-nowrap text-primary-500" href="{{ url('e-map') }}">ई-नक्सा</a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                                <path fill-rule="evenodd"
                                    d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                            <a class="ml-1 text-primary-500" href="{{ route('mapTrack') }}">नक्सा ट्रयाक</a>
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                                <path fill-rule="evenodd"
                                    d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                            <a class="ml-1 text-primary-500" href="{{ route('formDetails') }}">नक्सा विवरण</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row d-flex mt-5 ">
                {{-- <div class="breadcrumb d-flex">
                    <div class="breadcrumb-item">
                        <a class="whitespace-nowrap text-primary-500" href="{{url('e-map')}}">ई-नक्सा</a>
                        <i class="fa fa-angle-double-right text-white text-light"></i>
                        <a href="{{route('mapTrack')}}" class=" text-primary-500 text-center">नक्सा ट्रयाक</a>
                        <i class="fa fa-angle-double-right text-white text-light"></i>
                        <a href="{{route('formDetails')}}" class=" text-primary-500 text-center">नक्सा विवरण</a>
                        <i class="fa fa-angle-double-right text-white text-light"></i>
                        <a class=" text-primary-500 text-center">विवरण भर्नुहोस्</a>
                    </div>
                </div> --}}
                <h4 class="fw-semibold text-center">विवरण भर्नुहोस्</h4>
            </div>
            <div class="card-body p-3">
                <form id="show_pohypup">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="data">डाटा</label>
                            <textarea class="form-control ckEditor" placeholder="डाटा" name="data" id="data" cols="50" rows="10">{{ old('data', $mapApply->applyMapNotices->first()?->data ?? ($mapApply->getSpecificTemplateData($noticeTypeEnum) ?? '')) }}</textarea>
                        </div>
                    </div>
                    <div class=" d-flex justify-content-end pt-3">
                        <button type="button" id="show_popup" class="btn btn-sm btn-primary ">पेश गर्नुहोस्</button>
                    </div>
                </form>
            </div>
            <!-- Modal -->
            <div class=" fade otpModal" id="otpVerificationModal" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">OTP कोड राख्नुहोस्</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-danger" id="error_message"></p>
                            <form id="otp_form">
                                <div class="form-group">
                                    <label for="otp">ओ.टि.पी.</label>
                                    <input type="text" class="form-control" name="otp" id="otp"
                                        placeholder="६ अंकको ओ.टि.पी. कोड राख्नुहोस्">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">रद्द
                                        गर्नुहोस्</button>
                                    <button type="submit" class="btn btn-primary">पेश गर्नुहोस्</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#show_popup').on('click', function(event) {
                    event.preventDefault();
                    $.ajax({
                        type: "get",
                        url: "{{ route('send-otp', $mapApply) }}",
                        success: function(resp) {
                            $("#otpVerificationModal").modal('toggle');

                        },
                        error: function() {
                            alert("Something Went Wrong");
                        },
                        timeout: 10000
                    });
                });

                $(document.body).delegate('#otp_form', 'submit', function(event) {
                    event.preventDefault();

                    $.ajax({
                        type: "post",
                        data: {
                            otp: $("#otp").val(),
                            data: CKEDITOR.instances.data.getData()
                        },
                        url: "{{ route('store-emap-template-data', [$mapApply, $noticeTypeEnum]) }}",
                        success: function(resp) {
                            $("#otpVerificationModal").modal('toggle');
                            $("#otp").val('');
                            swal.fire({
                                title: 'Data Submitted Successfully',
                                toast: true,
                                position: 'top-right',
                                timer: 3000,
                                showConfirmButton: false,
                                timerProgressBar: true,
                                width: 400,
                                icon: 'success',
                            });
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            $("#error_message").html(XMLHttpRequest.responseJSON.message);
                        },
                        timeout: 10000
                    });
                });
            });
        </script>
        <script src="{{ asset('assets/backend/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/backend/ckeditor/editor.js') }}"></script>
    @endpush
@endsection
