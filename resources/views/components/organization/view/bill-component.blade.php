@props(['form-data-type', 'map-apply', 'form'])
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="header-title">
                    {{ $formDataType->model?->title }} विवरण
                </h4>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>क्र.स</th>
                            <th>बिल</th>
                            <th>रकम</th>
                            <th>मिति</th>
                            <th class="w-25">स्थिति</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapApply->paymentStores->where('form_id', $form->id)?->where('form_data_id', $formDataType->id) as $paymentStore)
                            <tr>
                                <td>{{ get_nepali_number($loop->iteration) }}</td>
                                <td>
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#view_file">
                                    <i class="fa fa-eye"></i>
                                </button>
                                </td>
                                <td>{{ $paymentStore->amount }}</td>
                                <td>{{ get_nepali_number($paymentStore->created_at->toDateString()) }}</td>
                                <td>{{ $paymentStore->status->label()??'' }}</td>
                            </tr>
                              <!-- reject model -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
