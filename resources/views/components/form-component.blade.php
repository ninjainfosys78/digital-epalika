@props(['form-data-type','map-apply','form'])
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="header-title">{{$formDataType ->model?->title}}
                        थप्नुहोस्</h4>
                </div>
            </div>
            <div class="card-body">
                @if(count($mapApply->formStores->where('form_id', $form->id)?->where('form_data_id', $formDataType->id)) == 0)
                    <form
                        action="{{ route('organization.admin.appliedDocument.store', [$mapApply, $form, $formDataType]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        <div id="form{{$unique = \Illuminate\Support\Str::random(10)}}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            save
                        </button>
                    </form>
                @else
                    <form
                        action="{{ route('organization.admin.appliedDocument.update', [$mapApply, $form, $formDataType,$mapApply->formStores->where('form_id', $form->id)->sortByDesc('created_at')->first()->id]) }}"
                        enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div id="form{{$unique = \Illuminate\Support\Str::random(10)}}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">
                            save
                        </button>
                    </form>
                @endif

            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h4 class="header-title">
                        {{$formDataType->model?->title}} विवरण
                    </h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead>
                        <tr>
                            <th>क्र.स</th>
                            <th>डाटा</th>
                            <th>स्थिति</th>
                            <th>मिति</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mapApply->formStores?->load('formStoreStatuses')?->where('form_id', $form->id)?->where('form_data_id', $formDataType->id) as $formStore)
                            <tr>
                                <td>{{ get_nepali_number($loop->iteration) }}</td>
                                <td>


                                            @if(!empty($formStore->document))
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#view_form{{ $formStore->id }}">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                    @endif
                                            <!-- view file model pass url dynamically in the model-->
                                            <div class="modal fade" id="view_form{{ $formStore->id }}" tabindex="-1" aria-labelledby="fileLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <iframe src="{{$formStore->document_url}}"></iframe>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">बन्द</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                </td>
                                <td>{{$formStore->status->label()}}</td>
                                <td>{{$formStore->created_at->toDateString()}}</td>
                                <td>


                                    <a href="{{ route('organization.admin.formStorePrint',[$formDataType,$formStore]) }}">
                                        <i class="fa fa-print"></i>
                                    </a>
                                </td>
                            </tr>
                            @foreach ($formStore->formStoreStatuses as $formStoreStatus)
                            <tr style="background-color: #e8e5e5;">
                                <td style="font-weight: bold;">{{ get_nepali_number($loop->iteration) }}</td>
                                <td>


                                    @if(!empty($formStoreStatus->document))
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#view_form_status{{ $formStoreStatus->id }}">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    @endif
                                    <!-- view file model pass url dynamically in the model-->
                                    <div class="modal fade" id="view_form_status{{ $formStoreStatus->id }}" tabindex="-1" aria-labelledby="fileLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <iframe src="{{$formStoreStatus->document_url}}"></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">बन्द</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $formStoreStatus->status->label() }}</td>
                                <td>{{$formStoreStatus->created_at->toDateString()}}</td>
                                <td>

{{--                                    <a href="{{ route('organization.admin.formStoreStatusPrint',[$formDataType,$formStore,$formStoreStatus]) }}">--}}
{{--                                        <i class="fa fa-print"></i>--}}
{{--                                    </a>--}}
                                </td>
                            </tr>
                            @endforeach
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@once
    @push('style')
        {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"> --}}
        {{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
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
        </script>
    @endpush
@endonce

@push('scripts')
    <script>
        const component{{$unique}} = decodeHtmlEntities('{{ $formDataType->model->fields ?? null }}');
        @if(count($mapApply->formStores->where('form_id', $form->id)) == 0)
        Formio.createForm(document.getElementById('form{{$unique}}'), JSON.parse(component{{$unique}}));
        @else
        Formio.createForm(document.getElementById('form{{$unique}}'), JSON.parse(component{{$unique}}))
            .then((form) => {
                form.submission = {
                    data: decodeHtmlEntities('{{ htmlspecialchars_decode(json_encode($mapApply->formStores->where('form_id', $form->id)->sortByDesc('created_at')->first()->data)) ?? null }}')

                };
            });
        @endif
    </script>
@endpush
