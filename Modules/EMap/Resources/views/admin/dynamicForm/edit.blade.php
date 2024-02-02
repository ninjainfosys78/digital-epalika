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
                        <li class="breadcrumb-item active">नयाँ नक्शा पास फारम</li>
                    </ol>
                </div>
                <h4 class="page-title">नयाँ नक्शा पास फारम</h4>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">नयाँ नक्शा पास फारम दर्ता गर्नुहोस</h4>
                        <a href="{{ route('emap.admin.dynamicForm.index','') }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fa fa-list"></i> नक्शा पास फारम सुची
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('emap.admin.dynamicForm.update', $dynamicForm)}}"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <legend>
                                <h4 class="text-info">नक्शा पास फाराम</h4>
                            </legend>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="title" class="form-label">शीर्षक</label>
                                    <div class="d-flex justify-content-between gap-1">
                                        <input type="text" id="title" class="form-control"
                                               value="{{old('title', $dynamicForm->title)}}"
                                               name="title"/>
                                    </div>
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-ms-12 md-2">
                                    <label for="fields" class="form-label">फारम</label>
                                    <div class="d-flex justify-content-between gap-1">
                                        <textarea name="fields" id="fields" class="form-control" cols="30"
                                                  rows="10" readonly>{{old('fields', $dynamicForm->fields)}}</textarea>
                                    </div>
                                    @error('fields')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div id="builder"></div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary mt-2">
                            पेश गर्नुहोस्
                        </button>
                    </form>

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

            const fieldsInput = document.getElementById('fields');
            const builderElement = document.getElementById('builder');
            const initialValue = fieldsInput.value;

            let component = {};

            // Check if the input is not empty and is valid JSON
            if (initialValue) {
                try {
                    component = JSON.parse(decodeHtmlEntities(initialValue));
                } catch (error) {
                    console.error('Invalid JSON:', error);
                }
            }

            // const component = document.getElementById('fields').value != null ? JSON.parse(decodeHtmlEntities(document.getElementById('fields').value)) : {};
            Formio.builder(document.getElementById('builder'), component).then((instance) => {
                instance.on('change', function (changed) {
                    fieldsInput.value = JSON.stringify(changed);
                });
            });
        </script>
    @endpush
@endsection

