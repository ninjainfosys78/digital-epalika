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
            <x-organization.view.file-component :form-data-type="$formDataType" :map-apply="$mapApply" :form="$form" />
        @elseif ($formDataType->type == Modules\EMap\Enums\FormTypeEnum::FORM)
            <x-organization.view.form-component :form-data-type="$formDataType" :map-apply="$mapApply" :form="$form"/>
        @elseif ($formDataType->type == Modules\EMap\Enums\FormTypeEnum::PAYMENT)
            <x-organization.view.bill-component :form-data-type="$formDataType" :map-apply="$mapApply" :form="$form"/>
        @endif
    @endforeach

    @push('scripts')
        <script>
            $(".printDetail").on("click", function(e) {
                // alert('dd');
                $.ajax({
                    method: "GET",
                    url: $(this).attr("route_action"),
                    success: function(resp) {
                        const print_area = window.open();
                        print_area.document.write(resp.view);
                        print_area.document.close();
                        print_area.focus();
                        print_area.print();
                        print_area.close();
                    },
                    error: function() {
                        alert("Something Went Wrong");
                    }
                });
            });
        </script>
    @endpush
@endsection
