@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('identity.admin.dashboard')}}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">अपाङ्गता परिचय पत्र</li>
                    </ol>
                </div>
                <h4 class="page-title"> अपाङ्गता परिचय पत्र</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ प्रतिलिपि थप्नुहोस्</h4>
                        <div>
                            <a href="{{route('identity.admin.disabilityIdentityCard.index')}}" class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-list"></i> अपाङ्गता परिचय पत्र सुची
                            </a>
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                नयाँ प्रतिलिपि थप्नुहोस्
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered" id="dataTable">
                            <thead>
                            <tr>
                                <th>क्र.स</th>
                                <th>मिति</th>
                                <th>प्रतिलिपि</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody id="tableData">
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <form action="{{route('identity.admin.disabilityIdentityCard.disabilityPrint.store',$disabilityIdentityCard)}}" method="POST" id="printForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label for="title" class="form-label">प्रतिलिपि *</label>
                                            <input
                                                type="text"
                                                name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                id="title"
                                                placeholder="प्रतिलिपि"
                                                required
                                            />
                                            <p class="text-danger" id="error_message"></p>
                                        </div>

                                    </div>
                                    <button type="submit"   class="btn btn-xs btn-outline-primary print" id="printButton">
                                        Save & Print  <i class="fa fa-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-outline-danger" data-bs-dismiss="modal">Close</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            var tableData = $('#tableData');
            var loadingSpinner = '<tr><td colspan="4" class="text-center"><span class="spinner-border spinner-border-sm" style="width: 2.5rem; height: 2.5rem;"  role="status" aria-hidden="true"></span></td></tr>';
            tableData.html(loadingSpinner);
            var disabilityIdentityCard  = "{{$disabilityIdentityCard->id}}";

            function loadData() {
                $.ajax({
                    method: "GET",
                    url: window.location.origin +"/admin/identity/disability/disabilityIdentityCard/"+ disabilityIdentityCard +"/printAll",
                    success: function(response) {
                        var tableBody = $('#dataTable tbody');
                        tableBody.empty();
                        if (response.length > 0) {
                            response.forEach(function(item) {
                                var row = '<tr>' +
                                    '<td>' + item.id + '</td>' +
                                    '<td>' + item.date + " ( "+item.time+" ) " + '</td>' +
                                    '<td>' + item.title + '</td>' +
                                    '<td>'  + '</td>' +
                                    '</tr>';
                                tableData.append(row)
                            });
                        } else {
                            var emptyRow = '<tr>' +
                                '<td colspan="4" class="text-center">No data available</td>' +
                                '</tr>';
                            tableData.append(emptyRow);
                        }
                    },
                    error: function() {
                        alert("Failed to load data");
                    }
                });
            }
            $(".print").on("click", function(e) {
                e.preventDefault();
                var printButton = $(this);
                var data = $("#printForm").serialize();
                var url = $("#printForm").attr("action");
                printButton.prop("disabled", true);
                printButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
                $.ajax({
                    method: "POST",
                    url: url,
                    data: data,
                    success: function(resp) {
                        $("#printForm")[0].reset();
                        $("#staticBackdrop").modal("hide");
                        tableData.html(loadingSpinner);
                        loadData();
                        printButton.prop("disabled", false);
                        printButton.html('Save & Print  <i class="fa fa-print"></i>');
                        const print_area = window.open();
                        print_area.document.write(resp.view);
                        print_area.document.close();
                        print_area.focus();
                        print_area.print();
                        print_area.close();
                    },
                    error:  function (XMLHttpRequest, textStatus, errorThrown) {
                           $("#error_message").html(XMLHttpRequest.responseJSON.message);
                            printButton.prop("disabled", false);
                            printButton.html('Save & Print  <i class="fa fa-print"></i>');
                    },
                });
            });
            loadData();
        </script>
    @endpush
@endsection
