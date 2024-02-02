@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('identity.admin.dashboard')}}">
                                <i class="fa fa-home"></i> गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">प्रिन्ट परिचय पत्र</li>
                        <li class="breadcrumb-item active">प्रिन्ट परिचय पत्र</li>
                    </ol>
                </div>
                <h4 class="page-title"> प्रिन्ट परिचय पत्र </h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                        @foreach($governmentalDisabilityTypes as $governmentalDisabilityType)
                            <li class="nav-item" role="presentation">
                                <a href="#home-b2{{$loop->iteration}}" data-bs-toggle="tab" aria-expanded="false"
                                   class="nav-link {{$loop->first ? 'active':''}}" aria-selected="true" role="tab">
                                    {{$governmentalDisabilityType->category?->label()??''}}

                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($governmentalDisabilityTypes as $data)
                            <div class="tab-pane {{$loop->first ? 'active show':''}}" id="home-b2{{$loop->iteration}}"
                                 role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>क्र.स</th>
                                            <th> फोटो</th>
                                            <th>नाम</th>
                                            <th>लिङ्ग</th>
                                            <th>नागरिकता नं.</th>
                                            <th>#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data->disabilityIdentityCards as $disabilityIdentityCard)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    <img src="{{$disabilityIdentityCard->photo_url}}"
                                                         alt="{{$disabilityIdentityCard->name}}" height="60">
                                                </td>
                                                <td>{{$disabilityIdentityCard->name}}</td>
                                                <td>{{$disabilityIdentityCard->gender?->label() ??''}}</td>
                                                <td>{{$disabilityIdentityCard->citizenship_no}}</td>
                                                <td class="d-flex gap-1">
                                                    <a href="javascript:void(0)"
                                                       route_action="{{route('identity.admin.disabilityIdentityCard.printCard',$disabilityIdentityCard)}}"
                                                       class="btn btn-xs btn-outline-warning printDetail">
                                                        <i class="fa fa-print"></i>

                                                    </a>
                                                     <a data-bs-type="edit"
                                                    href="{{ route('identity.admin.identityPrint.edit', $disabilityIdentityCard) }}"
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
            $(".printDetail").on("click", function (e) {
                $.ajax({
                    method: "GET",
                    url: $(this).attr("route_action"),
                    success: function (resp) {
                        var print_area = window.open();
                        print_area.document.write(resp.view);
                        print_area.document.close();
                        print_area.focus();
                        print_area.print();
                        print_area.close();
                    }, error: function () {
                        alert("Something Went Wrong");
                    }
                });
            });
        </script>
    @endpush
@endsection
