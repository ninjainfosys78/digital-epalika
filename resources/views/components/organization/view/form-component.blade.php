@props(['form-data-type', 'map-apply', 'form'])
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="header-title">
                    {{ $mapApply->model?->title }} विवरण
                </h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>क्र.स</th>
                        <th>डाटा</th>
                        <th>मिति</th>
                        <th>स्थिति</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($mapApply->formStores?->where('form_id', $form->id)?->where('form_data_id', $formDataType->id) as $formStore)
                        <tr>
                            <td>{{ get_nepali_number($loop->iteration) }}</td>
                            <td>
                                @foreach ($formStore->data as $key => $data)
                                    @if(is_array($data))
                                        <x-form-array-data :formdata="$data"/>
                                    @else
                                        {{ $key . ': ' . $data }} @if (!$loop->last)
                                            <br>
                                        @endif

                                    @endif
                                @endforeach
                            </td>
                            <td>{{ get_nepali_number($formStore->created_at->toDateString()) }}</td>
                            <td>{{ $formStore->status->label()??'' }}</td>

                        </tr>

                        <!-- reject model -->
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
