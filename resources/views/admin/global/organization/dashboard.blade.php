@extends('emap::organization.layouts.master')
@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-xl-3 border-end">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar-sm bg-blue rounded-circle">
                                    <i class="fas fa-map avatar-title font-18 text-white"></i>
                                </div>
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">{{$mapApplyCount}}</span></h3>
                                <p class="text-muted font-15 mb-0">कुल नक्सा</p>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <a href="{{$mapSetting?->document}}" download="{{$mapSetting?->document}}" class="btn btn-primary btn-sm">
        <i class="fa fa-download"></i> DWG Catalog format डाउनलोड गर्नुहोस
    </a>
    @if(!empty($mapSetting?->thumbnail))
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{$mapSetting->thumbnail}}" alt="" width="100%">
                    </div>
                </div>
            </div>
        </div>
    @endif

   @push('scripts')
       <script>
           $(document).ready(function() {
               $('#staticBackdrop').modal('show');
               setTimeout(function () {
                   $('#staticBackdrop').modal('hide');
               }, 10000);
           });
       </script>
   @endpush

@endsection
