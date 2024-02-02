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
                            <th>फाइल</th>
                            <th>मिति</th>
                            <th>स्थिति</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapApply->appliedDocuments?->where('form_id', $form->id)?->where('form_data_id', $formDataType->id)->load('appliedMapFiles') as $appliedDocument)
                            <tr>
                                <td>{{ get_nepali_number($loop->iteration) }}</td>
                                <td>
                                    @foreach ($appliedDocument->appliedMapFiles as $appliedMapFile)
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                            data-bs-target="#view_file{{ $appliedMapFile->id }}">
                                            <i class="fa fa-eye"></i>
                                        </button>

                                            <!-- view file model pass url dynamically in the model-->
                                    <div class="modal fade" id="view_file{{ $appliedMapFile->id }}" tabindex="-1" aria-labelledby="fileLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <iframe src="{{ $appliedMapFile->document_url }}" class="img-fluid"></iframe>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">बन्द</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </td>
                                <td>{{ $appliedDocument->created_at->toDateString() }}</td>
                                <td>{{ $appliedDocument->status->label()??'' }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
