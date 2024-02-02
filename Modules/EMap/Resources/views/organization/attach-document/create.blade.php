@extends('emap::organization.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="#">
                               <img class="icon me-1" src="{{asset('assets/backend/images/home.svg')}}" alt="document-icon">
                            गृहपृष्ठ
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ $form->title }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $form->title }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ $form->title }}</h4>
            </div>
        </div>
    </div>
    @foreach ($form->formDataTypes as $formDataType)

        @if ($formDataType->type == Modules\EMap\Enums\FormTypeEnum::FILE)
            <x-file-component :form-data-type="$formDataType" :map-apply="$mapApply" :form="$form"/>
        @elseif ($formDataType->type == Modules\EMap\Enums\FormTypeEnum::FORM)
            <x-form-component :form-data-type="$formDataType" :map-apply="$mapApply" :form="$form"/>
        @elseif ($formDataType->type == Modules\EMap\Enums\FormTypeEnum::PAYMENT)
            <x-bill-component :form-data-type="$formDataType" :map-apply="$mapApply" :form="$form"/>
        @endif
    @endforeach
    @push('scripts')
        <script>
            $(".printDetail").on("click", function (e) {
                // alert('dd');
                $.ajax({
                    method: "GET",
                    url: $(this).attr("route_action"),
                    success: function (resp) {
                        const print_area = window.open();
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

   {{-- @push('style')
        <link rel="stylesheet" href="{{ asset('assets/backend/form/css/formio.builder.min.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('assets/backend/form/js/cash.min.js') }}"></script>
        <script src="{{ asset('assets/backend/form/js/collect.min.js') }}"></script>
        <script src="{{ asset('assets/backend/form/js/formio.full.min.js') }}"></script>
        <script>
            function decodeHtmlEntities(input) {
                const doc = new DOMParser().parseFromString(input, "text/html");
                return doc.documentElement.textContent;
            }
            const component = decodeHtmlEntities('{{ $formDataType->model->fields ?? '' }}');

            Formio.createForm(document.getElementById('formData'), JSON.parse(component));
        </script>
         <script>
            $(".printDetail").on("click", function (e) {
                // alert('dd');
                $.ajax({
                    method: "GET",
                    url: $(this).attr("route_action"),
                    success: function (resp) {
                        const print_area = window.open();
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
    @endpush--}}
@endsection
