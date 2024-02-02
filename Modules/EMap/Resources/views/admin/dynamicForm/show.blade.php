@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item active">नक्शा पास फारम</li>
                        <li class="breadcrumb-item active">नक्शा पास फारम</li>
                    </ol>
                </div>
                <h4 class="page-title"> नक्शा पास फारम</h4>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नक्शा पास फारम</h4>
                        <a href="{{ route('emap.admin.dynamicForm.index') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> नक्शा पास फारम सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">

                    <div id="form"></div>
                </div>

            </div>

        </div>
    </div>
    @push('style')
        {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">--}}
        {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}
        <link rel="stylesheet" href="{{asset('assets/backend/form/css/formio.builder.min.css')}}">
    @endpush

    @push('scripts')
        <script src="{{asset('assets/backend/form/js/cash.min.js')}}"></script>
        <script src="{{asset('assets/backend/form/js/collect.min.js')}}"></script>
        <script src="{{asset('assets/backend/form/js/formio.full.min.js')}}"></script>
        <script>
            function decodeHtmlEntities(input) {
                const doc = new DOMParser().parseFromString(input, "text/html");
                return doc.documentElement.textContent;
            }
            const component = decodeHtmlEntities('{{$dynamicForm->fields}}');

            Formio.createForm(document.getElementById('form'), JSON.parse(component));
        </script>
    @endpush
@endsection

