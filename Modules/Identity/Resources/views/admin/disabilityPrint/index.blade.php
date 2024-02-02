@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('identity.admin.dashboard') }}">
                                <img class="icon me-1" src="{{ asset('assets/backend/images/home.svg') }}" alt="document-icon">
                                गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">प्रिन्ट परिचय पत्र</li>
                        <li class="breadcrumb-item active">प्रिन्ट परिचय पत्र</li>
                    </ol>
                </div>
                <h4 class="page-title">प्रिन्ट परिचय पत्र </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card p-0">
                <div class="card-body card-background">
                    <ul class="nav nav-pills mb-3 nav-bordered nav-justified" role="tablist">
                        @foreach ($governmentalDisabilityTypes as $governmentalDisabilityType)
                            <li class="nav-item" role="presentation">
                                <button href="#home-b2{{ $loop->iteration }}"
                                    class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-home-tab"
                                    data-bs-toggle="pill" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">{{ $governmentalDisabilityType->category?->label() ?? '' }}</button>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($governmentalDisabilityTypes as $data)
                            <div class="tab-pane {{ $loop->first ? 'active show' : '' }}" id="home-b2{{ $loop->iteration }}"
                                role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>क्र.स</th>
                                                <th> फोटो</th>
                                                <th>नाम</th>
                                                <th>लिङ्ग</th>
                                                <th>नागरिकता नं./जन्मदर्ता नं</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->disabilityIdentityCards as $disabilityIdentityCard)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="{{ $disabilityIdentityCard->photo_url }}"
                                                            alt="{{ $disabilityIdentityCard->name }}" height="60">
                                                    </td>
                                                    <td>{{ $disabilityIdentityCard->name }}</td>
                                                    <td>{{ $disabilityIdentityCard->gender?->label() ?? '' }}</td>
                                                    <td>{{ $disabilityIdentityCard->citizenship_no }}</td>
                                                    <td class="d-flex gap-1">
                                                        <button type="button" class="btn btn-xs btn-outline-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#print{{ $disabilityIdentityCard->id }}">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                        @include('identity::admin.disabilityPrint.inc.print_modal')
                                                        </a>

                                                        <a href="{{ route('identity.admin.disabilityFullDetail.show', $disabilityIdentityCard) }}"
                                                            class="btn btn-xs btn-outline-primary" title="विवरण हेर्नुहोस">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a data-bs-type="edit"
                                                            href="{{ route('identity.admin.disabilityPrint.edit', $disabilityIdentityCard) }}"
                                                            class="btn btn-xs btn-outline-info {{ get_setting('Pin') ? 'confirm_pin' : '' }}"
                                                            title="सम्पादन गर्नुहोस्">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    @push('scripts')
        <script>
            $(".printData").on("click", function(e) {
                e.preventDefault();
                var button = e.target;
                var form = button.closest('form');
                var modal = button.closest('.modal');
                var formId = form.id;
                var modalId = modal.id;
                var printButton = $(this);
                var data = $("#" + formId).serialize();
                var url = $("#" + formId).attr("action");
                printButton.prop("disabled", true);
                printButton.html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...'
                );
                $.ajax({
                    method: "POST",
                    url: url,
                    data: data,
                    success: function(resp) {
                        $("#" + formId)[0].reset();
                        $("#" + modalId).modal("hide");
                        swal.fire({
                            title: 'Data Updated Successfully',
                            toast: true,
                            position: 'top-right',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            width: 400,
                            icon: 'success',
                        });
                        location.replace(window.location.href);
                        printButton.prop("disabled", false);
                        printButton.html('Save & Print  <i class="fa fa-print"></i>');
                        const print_area = window.open();
                        print_area.document.write(resp.view);
                        print_area.document.close();
                        print_area.focus();
                        print_area.print();
                        print_area.close();
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        $("#error_message").html(XMLHttpRequest.responseJSON.message);
                        printButton.prop("disabled", false);
                        printButton.html('Save & Print  <i class="fa fa-print"></i>');
                    },
                });
            });
        </script>
    @endpush
@endsection
