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
                        <li class="breadcrumb-item ">नक्सा</li>
                        <li class="breadcrumb-item active">नक्सा विवरण</li>
                    </ol>
                </div>
                <h4 class="page-title">{{$noticeTypeEnum->label()}}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card border {{$mapApply
                                             ->applyMapNotices
                                             ->pluck('file_type')
                                             ->unique()
                                             ->contains($noticeTypeEnum) ? 'border-primary':'border-danger'}}">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h4 class="header-title mb-0">{{$noticeTypeEnum->label()}}</h4>
                    <div class="d-flex gap-1">
                        @if($mapApply->applyMapNotices->pluck('file_type')->unique()->contains($noticeTypeEnum))
                            @can('mapApplyNotice_access')
                                <a href="{{route('emap.admin.map.map-apply.notice.upload.get-template-data',[$mapApply, $applicationFormTypeEnum,$noticeTypeEnum->value])}}"
                                   class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-edit"></i> सम्पादन
                                </a>
                            @endcan
                            @can('mapApplyNotice_print')
                                <x-print-button
                                    target-element="print"
                                    title="{{$noticeTypeEnum->label()}}"
                                />
                            @endcan
                            @if($noticeTypeEnum->type() !== \Modules\EMap\Enums\EMapFormFillerTypeEnum::MUNICIPAL)
                                <form
                                    action="{{route('emap.admin.map.map-apply.notice.upload.reject',[$mapApply,$noticeTypeEnum])}}"
                                    method="POST"
                                    class="show_reject_confirm">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" class="reject_remarks"
                                           name="remarks">
                                    @if($mapApply->applyMapNotices->where('file_type',$noticeTypeEnum)->first()?->type!== 'Accept')
                                        @can('mapApplyNoticeReject_access')
                                            <button type="button" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-times-circle"></i> अस्वीकार
                                            </button>
                                        @endcan
                                    @endif

                                </form>
                                <form
                                    action="{{route('emap.admin.map.map-apply.notice.upload.reject',[$mapApply,$noticeTypeEnum])}}"
                                    method="POST"
                                    class="show_accept_confirm">
                                    @csrf
                                    @method('PUT')

                                    <input type="hidden" class="reject_remarks"
                                           name="remarks">

                                    @if($mapApply->applyMapNotices->where('file_type',$noticeTypeEnum)->first()?->type!== 'Accept')
                                        @can('mapApplyNoticeReject_access')
                                            <button type="button"
                                                    class="btn btn-outline-success btn-sm">
                                                <i class="fas fa-check-circle"></i> स्वीकार
                                            </button>
                                        @endcan
                                    @endif
                                </form>
                            @endif
                        @else
                            @can('mapApplyNotice_access')
                                <a href="{{route('emap.admin.map.map-apply.notice.upload.get-template-data',[$mapApply,$applicationFormTypeEnum,$noticeTypeEnum->value])}}"
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-plus"></i> डाटा थप्नुहोस्
                                </a>
                            @endcan
                        @endif
                        <a href="{{route('emap.admin.map.mapApply.index',$applicationFormTypeEnum)}}"
                           class="btn btn-outline-success btn-sm">
                            <i class="fas fa-list"></i> निबेदन/प्रतिबेदन सुची
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="print" class="p-1">
                    {!! $data !!}
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $('.show_reject_confirm').click(function (event) {
                const form = $(this).closest("form");
                event.preventDefault();

                swal.fire({

                    title: "Are You Sure to reject this application ? ",
                    input: 'text',
                    inputLabel: 'Reject Reason',
                    inputPlaceholder: 'Reject Reason',
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: 'red',
                    confirmButtonText: "Reject",
                    dangerMode: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Please enter reject reason !'
                        }
                    }
                })
                    .then((data) => {
                        if (data.value) {
                            $(".reject_remarks").val(data.value)
                            form.submit();
                        }
                    });
            });
            $('.show_accept_confirm').click(function (event) {
                const form = $(this).closest("form");
                event.preventDefault();
                swal.fire({
                    title: "Are You Sure to accept this application ? ",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    confirmButtonText: "Accept",
                    dangerMode: true,

                })
                    .then((willDelete) => {
                        if (willDelete.isConfirmed) {
                            form.submit();
                        }
                    });
            });
        </script>
    @endpush
@endsection

