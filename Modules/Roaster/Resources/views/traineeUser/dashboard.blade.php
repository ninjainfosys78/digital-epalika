@extends('roaster::traineeUser.layouts.master')
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
                                <h3 class="mt-1 mb-0"><span data-plugin="counterup">20</span></h3>
                                <p class="text-muted font-15 mb-0">कुल तालिम</p>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>


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
